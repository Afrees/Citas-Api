<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // GET /users
    public function index()
    {
        return User::with('fichaMedica', 'citas')->get();
    }

    // POST /users
    public function store(Request $request)
    {
        $user = User::create($request->only(['nombre','last_name','email']));
        return response()->json($user, 201);
    }

    // GET /users/{id}
    public function show(User $user)
    {
        return $user->load('fichaMedica', 'citas');
    }

    // PUT /users/{id}
    public function update(Request $request, User $user)
    {
        $user->update($request->only(['nombre','last_name','email']));
        return response()->json($user);
    }

    // DELETE /users/{id}
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Usuario eliminado correctamente.',
        ]);
    }
}
