<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillables = [
        'user_id',
        'follower_id'
    ];

    // Relación con user
    // Un usuario puede seguir a uno o muchos usuarios. Un Follower puede seguir
    // a uno o muchos usuarios
    public function users()
    {
        $this->hasMany(User::class);
    }
}
