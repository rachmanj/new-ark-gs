<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
    public function index()
    {
        $projects = Http::get('http://localhost:5000/projects')->json()['data'];
        // return $projects;
        // die;
        return view('register.index', compact('projects'));
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

        return redirect()->route('login')->with('success', 'Register success!!');
    }
}
