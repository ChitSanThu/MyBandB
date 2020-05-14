<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DeveloperController extends Controller
{
    public function index(){
        $roles = DB::table('roles')->select('id', 'name')->get();
        $users=User::all();
        return (view('developer.register',compact("roles","users")));
    }
    public function create(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);
        $id=DB::table('users')->insertGetId([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt( $request->get('password')),
        ]);
        DB::table('user_has_roles')->insert([
            'role_id'=>$request->get('role'),
            'user_id'=>$id,
        ]);
        return redirect('developer')->with('status',"Successfully inserted sir !");
    }
    public function edit($id)
    {
        $user=User::whereId($id)->firstOrFail();
        $roles=Role::all();
        $selectedRoles=$user->roles()->pluck('name')->toArray();

        return view('backend.users.edit',compact('user','roles','selectedRoles'));
    }
    public function update(Request $request,$id){
        $user=User::whereId($id)->firstOrFail();
        $roles=Role::all();
        $selectedRoles=$user->roles()->pluck('name')->toArray();

        foreach($selectedRoles as $role){
            $user->removeRole($role);
        }
        foreach($request->get('role') as $role){
            $user->assignRole($role);
        }
        return redirect('developer/user/'.$id.'/edit');
    }
    public function deleteUser($id){
        $user=User::find($id);
        $user->delete();
        return redirect('developer');
    }
}
