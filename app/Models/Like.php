<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
        protected $fillable = [
            'user_id',
            'post_id',
        ];

    // Relaciones
    // Con user.- Un usuario puede dar uno o muchos likes, un like pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Con post.- Un post puede tener uno o muchos likes. Un like pertenece a un post
    public function post(){
        return $this->belongsTo(Post::class);
    }

}
