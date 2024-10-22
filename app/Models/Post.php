<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class Post extends Model
{
    protected $table = "posts";

    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];

    // Define la relación con el modelo NewUser
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
