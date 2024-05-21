<?php

namespace App\Repositories;

use App\Models\User;
use App\Contracts\IUserRepository;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Validator;

class UserRepository extends BaseRepository implements IUserRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getUser(array $data)
    {
        return $this->model::where("email", $data["email"])->first();
    }

    public function signInValidation($data)
    {
        return Validator::make($data, [
            'email' => 'required',
            'password' => 'required',
        ]);
    }

    public function signUpValidation($data)
    {
        return Validator::make($data, [
            'email' => ['required', 'unique:users,email'],
            'password' => 'required',
        ]);
    }
}
