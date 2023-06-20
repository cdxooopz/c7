<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userList = User::all();
        return response()->json(['data' => $userList]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        # And make sure to use the plainTextToken property
        # Since this will return us the plain text token and then store the hashed value in the database
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            "user"  => $user,
            "token"  => $token
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (Cache::has('product-'.$id)) {
            $productEntity = Cache::get('product-'.$id);
        } else {
            $productEntity = Product::join('product_types','products.product_type', 'product_types.id')->find($id);
            Cache::put('product-'.$id, $productEntity);
        }
        return response()->json($productEntity);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password')))

        return response()->json([
            'message' => 'Invalid login details',
            401
        ]);

        $user = User::where('email',  $request->email)->firstOrFail();

        # Delete the existing tokens from the database and create a new one
        auth()->user()->tokens()->delete();

        $token = $user->createToken('auth_token')->plainTextToken;
        Auth::login($user);

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);

    }
}
