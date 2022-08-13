<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
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
        'comment',
    ];

    // Relaciones

    // Con user. Un usuario puede tener uno o varios comentarios, un comentario
    // es de un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Con post. Un post puede tener uno o varios comentarios, un comentario
    // es de un post
}
