<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\ModelTraits\Attributes\UserAttribute;
use App\Models\ModelTraits\Relations\UserRelation;
use App\Models\ModelTraits\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,
        HasFactory,
        Notifiable,
        UserScope,
        UserRelation,
        UserAttribute;

    protected $fillable = [
        "name",
        "user_name",
        "email",
        "password",
    ];

    protected $hidden = [
        "password",
    ];

    protected $casts = [
        "password" => "hashed",
    ];
}
