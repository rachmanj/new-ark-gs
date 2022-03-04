<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $projects = ['000H', '001H', '011C', '017C', '021C', '022C', '023C', 'APS'];

        return view('users.index', compact('projects'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validatedData = $this->validate($request, [
            'name'          => 'required|min:3|max:255',
            'username'      => 'required|min:3|max:20|unique:users',
            'email'         => 'required|email:dns|unique:users',
            'project_code'  => 'required',
            'password'      => 'min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('users.index')->with('success', 'New User successfuly created!!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::find($id);
        $projects = ['000H', '001H', '011C', '017C', '021C', '022C', '023C', 'APS'];

        return view('users.edit', compact('user', 'projects'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'          => 'required|min:3|max:255',
            'username'      => 'required|min:3|max:20|unique:users,username,'.$id,
            'email'         => 'required|email:dns|unique:users,email,'.$id,
            'project_code'  => 'required',
        ]);

        if ($request->password) {
            $this->validate($request, [
                'password'      => 'min:6',
                'password_confirmation' => 'required_with:password|same:password|min:6'
            ]);

            $request->merge(['password' => Hash::make($request->password)]);
        } else {
            $request->request->remove('password');
        }

        $user = User::find($id);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->project_code = $request->project_code;

        $user->save();

        return redirect()->route('users.index')->with('success', 'User successfuly updated!!');

    }

    public function destroy($id)
    {
        $user = User::find($id);

        if ($user->username === 'superadmin') {
            return redirect()->route('users.index')->with('error', 'You cannot delete this user');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted');
    }

    public function data()
    {
        $users = User::all();

        return datatables()->of($users)
                ->editColumn('created_at', function ($users) {
                    return date('d-m-Y', strtotime($users->created_at));
                })
                ->addIndexColumn()
                ->addColumn('action', 'users.action')
                ->rawColumns(['action'])
                ->toJson();
    }
}
