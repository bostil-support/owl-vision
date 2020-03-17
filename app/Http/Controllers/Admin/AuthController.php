<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    /**
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $request->merge(['password' => bcrypt($request->password)]);

        /** @var User $user */
        $user = User::query()->create($request->all());

        return response()->json(['user' => $user], 201);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function login(Request $request)
    {
        $data = $request->validate([
            'email'    => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if(auth()->attempt($data)) {
            return response()->json(['user' => auth()->user()]);
        } else {
            throw new \Exception("Email or password is incorrect.", 400);
        }
    }

    public function logout()
    {
        auth()->guard('web')->logout();

        return response()->json(['message' => 'You are logged out.']);
    }

    public function getUser()
    {
        return response()->json(['user' => auth()->user()]);
    }

}
