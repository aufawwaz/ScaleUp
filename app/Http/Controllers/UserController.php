<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //ambil data user
    public function index()
    {
        return response()->json([User::all()]);
    }

    //tambah data user
    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return response()->json($user, 201);
    }

    //ambil data user berdasarkan id
    public function show($id)
    {
        $user = User::findOrFail($id);
        return $user ? response()->json($user) : response()->json(['message' => 'User not found'], 404);
    }

    //update data user
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['message' => 'User not found'], 404);

        $user->update($request->all());
        return response()->json($user);
    }

    //hapus data user
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['message' => 'User not found'], 404);

        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
}
