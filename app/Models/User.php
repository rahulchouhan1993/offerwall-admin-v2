<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'affiseId',
        'affise_api_key',
        'affise_postback_key',
        'unique_id',
        'name',
        'last_name',
        'address_1',
        'address_2',
        'city',
        'country',
        'zip_code',
        'api_key',
        'postback_key',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function apps()
    {
        return $this->hasMany(App::class,'affiliateId','id');
    }

    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }

    public function trackings()
    {
        return $this->hasMany(Tracking::class,'user_id','id');
    }
}
