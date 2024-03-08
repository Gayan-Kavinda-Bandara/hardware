<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Livewire\WithPagination;

class UserManagement extends Component
{
    public $showingRegModal = false;
    public $isEditMode = false;

    public $name;
    public $email;
    public $designation;
    public $employeeId;
    public $contNo;
    public $password;
    public $password_confirmation;
    public $user;
    public $section;
    public $user_level_id;

    public $search = '';
    use WithPagination;

    public function render()
    {
        return view('livewire.user-management',[
            'users' => User::paginate(10)
        ])->layout('layouts.app');
    }

    public function showRegModal(){
        $this->reset();
        $this->showingRegModal = true;
    }

    public function storeUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'section' => 'required',
            'designation' => 'required|string|max:30',
            'employeeId' => 'required|string|max:10|unique:users',
            'contNo' => 'required|string|min:10|max:10|unique:users',
            'user_level_id' => 'required',
            'password' => 'required|min:10|max:10|',
            'password_confirmation' => 'required|same:password'
        ]);

        User::create([
        'name' => $this->name,
        'email' => $this->email,
        'section_id' => $this->section,
        'designation' => $this->designation,
        'employeeId' => $this->employeeId,
        'contNo' => $this->contNo,
        'user_level' => $this->user_level_id,
        'password' => Hash::make($this->password),
        ]);

        $this->reset();
    }

    public function showEditUserModal($id){
        $this->user = User::findOrFail($id);
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->section = $this->user->section_id;
        $this->designation = $this->user->designation;
        $this->employeeId = $this->user->employeeId;
        $this->contNo = $this->user->contNo;
        $this->user_level_id = $this->user->user_level;
        $this->isEditMode = true;
        $this->showingRegModal = true;
    }

    public function updateUser(){

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'section' => 'required',
            'designation' => 'required|string|max:30',
            'employeeId' => 'required|string|max:10',
            'contNo' => 'required|string|min:10|max:10',
            'user_level_id' => 'required'
        ]);

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'section_id' => $this->section,
            'designation' => $this->designation,
            'employeeId' => $this->employeeId,
            'contNo' => $this->contNo,
            'user_level' => $this->user_level_id,
        ]);

        $this->reset();

    }

    public function deleteUser($id){
        try{
            $user = User::findOrFail($id);
            $user->delete();
        }catch(\Illuminate\Database\QueryException $ex){

            if(true)
        {
            $this->dispatch('alert',[
                'title' => 'Attention!',
                'message' => 'This user is linked with device.',
                'type' => 'danger'
            ]);
        }
        }
        $this->reset();
    }

}
