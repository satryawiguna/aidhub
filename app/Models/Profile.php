<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'dob',
        'avatar'
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
