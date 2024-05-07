<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
{
    use HasFactory;

    protected $table = 'comentarios';

    protected $fillable = [
        'post_id',
        'comentario',
        'estado',
        'fecha',
        'usuario_id',
    ];

    // RELACION CON USUARIOS
    public function post(){
        return $this->belongsTo(Posts::class, 'post_id');
    }

    // RELACION CON USUARIOS
    public function usuario(){
        return $this->belongsTo(User::class, 'usuario_id');
    }


}
