<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    // Mass assignable attributes
    protected $fillable = [
        'name',
        'user_id'
    ];

    // A tag belongs to many quotes
    public function quotes()
    {
        return $this->belongsToMany(Quote::class);
    }

    // A tag belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
