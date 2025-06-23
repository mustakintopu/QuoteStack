<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'bio',
        'profile_picture',
        'settings', // ✅ Enables saving settings via mass assignment
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'settings' => 'array', // ✅ Decodes settings JSON into PHP array
    ];

    /**
     * User's created quotes.
     */
    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

    /**
     * User's created tags.
     */
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    /**
     * User's favorite quotes.
     */
    public function favorites()
    {
        return $this->belongsToMany(Quote::class, 'quote_favorites', 'user_id', 'quote_id');
    }
}
