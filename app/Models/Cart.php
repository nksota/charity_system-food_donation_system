<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable = ['user_id', 'donation_id'];

    // Define the user relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the donation relationship
    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }
}
