<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Admin;
use App\Models\Donor;
use App\Models\Orphanage;
use App\Models\Volunteer;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type'
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
        'password' => 'hashed',
    ];

    protected function type(): Attribute

    {

        return new Attribute(

            get: fn ($value) =>  ["volunteer", "admin", "donor", "orphanage"][$value],

        );

    }

    public function admins()
    {
        return $this->hasMany(Admin::class);
    }

    public function donors()
    {
        return $this->hasMany(Donor::class);
    }

    public function volunteers()
    {
        return $this->hasMany(Volunteer::class);
    }

    public function orphanages()
    {
        return $this->hasMany(Orphanage::class);
    }

}
