<?php

namespace App\Models;

use App\Filters\User\FilterFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Validation\Rule;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'created_at',
        'updated_at',
        'first_name',
        'last_name',
        'is_admin',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function rules($id = 0)
    {
        return [
            'username' => [
                'required',
                'string',
                'min:5',

                Rule::unique('users', 'username')->ignore($id)
            ],
            'first_name' => [
                'string',
                'min:3',
                'max:15'
            ],
            'last_name' => [
                'string',
                'min:3',
                'max:15'
            ],
            'is_admin' => [
                Rule::in(['user' => 0, 'admin' => 1])
            ],
            'is_active' => [
                Rule::in(['inactive' => 0, 'active' => 1])
            ],
            'password' => [
                'required',
                'min:9',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/',
            ],
            'password_conf' => [
                'required',
                'min:9',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/',
                'same:password'
            ],
            'email' => [
                'required',
                'string',
                Rule::unique('users', 'email')->ignore($id),
                'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'
            ]
        ];
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        $filterable = new FilterFactory();
        $filterable->baseFilter($builder, $filters);
    }

}
