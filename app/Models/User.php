<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements CanResetPassword //MustVerifyEmail,
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, \Illuminate\Auth\Passwords\CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
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

    /**
     * User has photo
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function photo():HasOne
    {
        return $this->hasOne(\App\Models\Photo::class);
    }

    /**
     * User is applicant
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function applicant():HasOne
    {
        return $this->hasOne(\App\Models\Applicant::class);
    }

    public function hr():HasOne
    {
        return $this->hasOne(HeadHunter::class);
    }

    public function employer():HasOne
    {
        return $this->hasOne(Employer::class);
    }


}
