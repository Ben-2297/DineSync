<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'fname',
        'lname',
        'mobile',
        'address',
        'bio',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'customer_id');
    }
}
