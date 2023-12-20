<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    //

    public function index(Request $request)
    {
        $id_role=$request->id_role;
        $roles=Role::where('id',(int) $id_role);
        if($roles->exists())
        {
            $role=$roles->first();
        }
        else
        {
            return redirect()->route('roles.index');
        }
        
        $data= $role->permissions();
           
       

        return view('rolepermissions.index',['data'=> $data->paginate(20),'id_role'=>$id_role,'role_name'=>$role->name])
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    public function create(Request $request)
    {
        $id_role=$request->id_role;
        $roles=Role::where('id',(int) $id_role);
        if($roles->exists())
        {
            $role=$roles->first();
        }
        else
        {
            return redirect()->route('roles.index');
        }
        $rolepermissions=$role->getPermissionNames();
        
        $permissions = Permission::whereNotIn('name',$rolepermissions)->get();
        

        return view('rolepermissions.create',['id_role'=>$id_role,'permissions'=>$permissions]);
    }

    public function allow(Request $request,$id_role)
    {

        $request->validate([
            'name' => ['required'],
        ]);

        $roles=Role::where('id',(int) $id_role);
        if($roles->exists())
        {
            $role=$roles->first();
        }
        else
        {
            return redirect()->back();
        }
        $permissions=Permission::where('name',$request->name);
        if($permissions->exists())
        {
            $permission=$permissions->first();
        }
        else
        {
            return redirect()->back();
        }
       // dd($permission);
       
        $role->givePermissionTo($permission);

        return redirect()->back()
                        ->with('success','');
    }

    public function revoke($id_role,$id_permission)
    {

        $roles=Role::where('id',(int) $id_role);
        if($roles->exists())
        {
            $role=$roles->first();
        }
        else
        {
            return redirect()->back();
        }
        $permissions=Permission::where('id',(int) $id_permission);
        if($permissions->exists())
        {
            $permission=$permissions->first();
        }
        else
        {
            return redirect()->back();
        }
       // dd($permission);
       
        $role->revokePermissionTo($permission);

        return redirect()->back()
                        ->with('success','');
    }

    public function revokeall($id_role)
    {
        $roles=Role::where('id',(int) $id_role);
        if($roles->exists())
        {
            $role=$roles->first();
        }
        else
        {
            return redirect()->back();
        }
        $role->syncPermissions();
        return redirect()->back()
        ->with('success','');
    }

}
