<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;



class UserController extends Controller
{
    
    public function index()
    {
        $user = new User;
        $user->setConnection('mysql');

        $data = User::latest()->paginate(20);

        return view('users.index',compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        $roles=Role::all()->pluck('name');
        return view('users.create',compact('roles'));
    }


    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required',
            'email' => ['required','email','unique:users'],
            'role'=> ['required'],
            'password' => 'required'
        ]);

        $role=Role::where('name',request('role'))->first();

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'id'

            ]);
        
        $user->syncRoles($role);
        return redirect()->route('users.index')
                        ->with('success','');
    }


    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }


    public function edit(User $user)
    {
        $roles=Role::all()->pluck('name');
        return view('users.edit',compact('user','roles'));
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => ['required','email'],//Rule::unique('users')->ignore($user->id)
            'role' =>['required'],
            'password' => 'required'

        ]);

        $role=Role::where('name',request('role'))->first();
        $user->update([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),]);
        $user->syncRoles($role);
        return redirect()->route('users.index')
                        ->with('success','');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
                        ->with('success','');
    }

    public function deleteall(Request $request){
        $ids = $request->get('ids');
        User::whereIn('id',$ids)->delete();
        return redirect('users');
    }
    public function searchuser(Request $request)
    {
        $search = $request->get('search');
        $data= DB::connection('mysql')->table('users')->where('name','LIKE','%'.$search.'%')->paginate(5);
        return view('users.index',['users'=>$data]);
    }
}
