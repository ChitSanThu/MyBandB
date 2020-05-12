<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
// use Spatie\Permission\Models\Role;

// use Spatie\Permission\Models\Permission;
class UserController extends Controller
{
    public function index(){
        $users=User::all();

        return view('backend.users.index',compact('users'));
    }
    public function edit($id){
        $user=User::whereId($id)->firstOrFail();
        $role=Role::all();
        $selectedRoles=$user->role()->pluck('name')->toArray();
        return view('backend.users.edit',compact('user','role','selectedRoles'));
    }
    public function update(Request $request,$id){

        $user=User::whereId($id)->firstOrFail();
        $roles=$request->get('role');
        // return $roles;      
        // $user->hasAllRoles(Role::all());syncRoles
        return redirect('/admin/'.$id.'/edit')->with('status','Successfully');
    
    }
}
