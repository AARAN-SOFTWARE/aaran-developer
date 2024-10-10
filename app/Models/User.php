<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isSundar(): bool
    {
        return in_array($this->email, [
            'sundar@sundar.com',
            'sundar@codexsun.com',
        ]);
    }


    public function isAdmin(): bool
    {
        return in_array($this->email, [
            'sundar@sundar.com',
            'sundar@codexsun.com',
            'developer@aaran.com',
        ]);
    }

    public static function getName($id)
    {
        if($id){
            return self::find($id)->name;
        }
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new TenantScope);
    }
}
