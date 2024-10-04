<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('crud.index');
    }

    public function getData(Request $request)
    {
        $query = User::query();

       
        if ($request->has('name') && $request->name != '') {
            $query->where('name', $request->name);
        }

        $users = $query->get(); 
        return response()->json($users); 
    }

    public function getNames()
    {
        $names = User::select('name')->distinct()->get(); 
        return response()->json($names);
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
        return redirect()->route('user.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index');
    }

}
