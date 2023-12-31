<?php

namespace UserModule\app\Models;

use App\Filters\FilterFactory;
use App\Models\Address;
use App\Models\PurchaseOrder;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Validation\Rule;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, \Illuminate\Auth\Passwords\CanResetPassword;

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

    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable')
            ->withDefault([
                'city_id' => '-',
                'street' => '-',
                'district' => '-',
                'phone' => '-'
            ]);
    }

    public function orders()
    {
        return $this->hasMany(PurchaseOrder::class, 'user_id', 'id');
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->first_name . ' ' . $this->last_name,
        );
    }
}
