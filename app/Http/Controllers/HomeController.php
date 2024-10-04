<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class HomeController extends Controller
{
    public function ShowForm(){
        return view('index');
    }


    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'phonenumber' => 'required|string|max:15',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'product_name.*' => 'required|string|max:255',
            'product_price.*' => 'required|numeric|min:0',
            'product_quantity.*' => 'required|integer|min:1',
            'product_type.*' => 'required|string',
            'discount.*' => 'nullable|numeric|min:0|max:100',
        ]);

        
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->phonenumber = $request->phonenumber;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

       
        foreach ($request->product_name as $index => $productName) {
           
            $product = new Product();
            $product->product_name = $productName;
            $product->product_price = $request->product_price[$index];
            $product->product_quantity = $request->product_quantity[$index];
            $product->product_type = $request->product_type[$index];
            $product->discount = $request->discount[$index] ?? 0;
            $product->save();
        }

        return response()->json([
            'message' => 'User and products added successfully!',

        ]);
    }
}

    

    
    

