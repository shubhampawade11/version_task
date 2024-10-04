<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
    $user = User::where('name', 'LIKE', "%{$query}%")->get();

    return view('crud.index', compact('user'));
    }

    public function edit(User $user)
    {
        return view('crud.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'phonenumber' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        $user->update($request->all());
        return redirect()->route('search');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('search');
    }

}
