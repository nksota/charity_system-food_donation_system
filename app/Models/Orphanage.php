<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orphanage extends Model
{
    use HasFactory;
    protected $table = 'orphanages';

    protected $fillable  = [
        'dor',
        'phone',
        'address',
        'profile',
        'city'
    ];

          // Define the relationship with the User model
          public function user()
          {
              return $this->belongsTo(User::class, 'user_id', 'id');
          }
}
