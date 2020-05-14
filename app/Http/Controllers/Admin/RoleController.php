<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleController extends Controller
{
    public function index(){
        $roles=Role::all();
        return view('backend.role.index',compact('roles'));
    }
    public function show(){
        return view('backend.role.create_row');
    }
    public function store(Request $request){
        Role::create(['name'=>$request->get('name')]);
        return redirect('admin/create/roles')->with('status','Successful role inserted sir!');
    }

    
}