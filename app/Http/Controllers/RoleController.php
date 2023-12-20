<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    //
    public function addDummy()
    {
        $role = Role::create(['name' => 'Dev']);
        $role = Role::create(['name' => 'Admin']);    
        return redirect()->route('home');
    }

    public function setUserRoleDummy()
    {
        
        $email1 = 'harenait.lalachante@gmail.com';
        $email2 = 'mohammedpm.lalachante@gmail.com';
        $email3 = 'zakariait.lalachante@gmail.com';
        $email4 = 'aa@llc.fr';
        $email5 = 'mady@llc.fr';
        $emailtest= 'la@llc.fr';
        $user= User::where('email', $email1)->first(); 
        $user->assignRole('Admin');
        $user= User::where('email', $email2)->first(); 
        $user->assignRole('Admin');
        $user= User::where('email', $email3)->first(); 
        $user->assignRole('Admin');
        $user= User::where('email', $email4)->first(); 
        $user->assignRole('Admin');
        $user= User::where('email', $email5)->first(); 
        $user->assignRole('Admin');
        //$user2=bcrypt('pass');   "$2y$10$OS4yWnfsLROy6oh5Z8QwQ.Y0wuLhwNeZ8a3iHrHAVzTsL57R12.Zy" I created a test account in local db
        $user2= User::where('email',$emailtest)->first();
        $user2->assignRole('Dev');
        

        return redirect()->route('home');
    }
    
    public function index()
    {
        $role = new Role;
        $role->setConnection('mysql');

        $data = Role::latest()->paginate(20);

        return view('roles.index',compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
       
        return view('roles.create');
    }

    public function store(Request $request)
    {
         $request->validate([
            'name' => ['required','unique:roles'],
        ]);


        $role = Role::create([
            'name' => request('name'),
            ]);
        
        return redirect()->route('roles.index')
                        ->with('success','');
    }

    public function show(Role $role)
    {
        return view('roles.show',compact('role'));
    }

    public function edit(Role $role)
    {
        return view('roles.edit',compact('role'));
    }
   
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => ['required',Rule::unique('roles')->ignore($role->id)],
        ]);

        $role->update([
            'name' => request('name'),
        ]);

        return redirect()->route('roles.index')
                        ->with('success','');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')
                        ->with('success','');
    }

    public function deleteall(Request $request){
        $ids = $request->get('ids');
        Role::whereIn('id',$ids)->delete();
        return redirect('roles');
    }

}
