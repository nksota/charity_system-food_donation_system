<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $table = 'donations';

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'image',
        'quantity',
        'status',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class, 'volunteer_id');
    }


}
