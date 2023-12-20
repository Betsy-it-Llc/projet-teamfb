<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    //
    public function addDummy()
    {
        $permission = Permission::create(['name' => 'access Activité']);
        $permission = Permission::create(['name' => 'access Analyse et stratégie']);   
        $permission = Permission::create(['name' => 'access Administration']);    
        $permission = Permission::create(['name' => 'access Infrastructure']);   
        return redirect()->route('home');
    }

    public function setRolePermissionDummy()
    {
        $roles=Role::all();
        foreach($roles as $role)
        {
            $role->givePermissionTo('access Activité');
            $role->givePermissionTo('access Analyse et stratégie');
            $role->givePermissionTo('access Infrastructure');
            if ($role->name == 'Admin') 
            {
                $role->givePermissionTo('access Administration');
            }
            //dump($role->permissions()->get()->pluck('name'));
            
        }
        return redirect()->route('home'); 
    }

    public function index()
    {
        $permission = new Permission;
        $permission->setConnection('mysql');

        $data = Permission::latest()->paginate(20);

        return view('permissions.index',compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
       
        return view('permissions.create');
    }

    public function store(Request $request)
    {
         $request->validate([
            'name' => ['required','unique:permissions'],
        ]);


        $permission = Permission::create([
            'name' => request('name'),
            ]);
        
        return redirect()->route('permissions.index')
                        ->with('success','');
    }

    public function show(Permission $permission)
    {
        return view('permissions.show',compact('permission'));
    }

    public function edit(Permission $permission)
    {
        return view('permissions.edit',compact('permission'));
    }
   
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => ['required',Rule::unique('permissions')->ignore($permission->id)],
        ]);

        $permission->update([
            'name' => request('name'),
        ]);

        return redirect()->route('permissions.index')
                        ->with('success','');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permissions.index')
                        ->with('success','');
    }

    public function deleteall(Request $request){
        $ids = $request->get('ids');
        Permission::whereIn('id',$ids)->delete();
        return redirect('permissions');
    }
}
