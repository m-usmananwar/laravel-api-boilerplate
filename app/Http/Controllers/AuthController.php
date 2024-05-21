<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\IUserRepository;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $repository;

    public function __construct(IUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function signIn(Request $request)
    {
        try {
            $data = $request->input();

            $this->repository->signInValidation($data)->validate();

            $user = $this->repository->getUser($data);
            throw_if(!$user, 'User not found against this email', 404);

            if(Hash::check($data['password'], $user->password)) {
                $token = $user->createToken('api-token')->plainTextToken;
                return response()->success("User authenticated successfully", compact("user", "token"));
            } else {
                return response()->error("Invalid credentials", 401);
            }
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    public function signUp(Request $request)
    {
        try {
            $data = $request->input();
            $this->repository->signUpValidation($data)->validate();

            $user = $this->repository->store($data);

            $token = $user->createToken('api-token')->plainTextToken;
            return response()->success("User authenticated successfully", compact("user", "token"));
        } catch(\Exception $e){
            return $this->handleException($e);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->success("User logged out successfully");
    }
}
