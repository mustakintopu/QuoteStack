<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Tag;
use App\Models\User;

class Quote extends Model
{
    use HasFactory;

    // Fields that can be mass-assigned
    protected $fillable = [
        'content',
        'author',
        'user_id',
    ];

    // A quote can belong to many tags
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    // A quote is added by a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
