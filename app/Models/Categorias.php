<?php

namespace App\Models;

use App\Models\Categorias;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorias extends Model
{
    use HasFactory;
    protected $table = 'categorias';
    protected $fillable= [
        'nombre',
        'imagen',
        'estado',
        'usuario_id',
    ];

    //obtener la imagen
    public function getImagenURl(){
        if ($this->imagen && $this->imagen != 'default.png' && $this->imagen != null) {
            return asset('imagenes/categorias/'.$this->imagen);
        } else{
            return asset('default.png');
        }
    }
    //-Relacion con USUARIOS
    public function usuario(){
        return $this->belongsTo(User::class, 'usuario_id');
    }
    //
    //relacion con POSTS
    public function posts(){
        return $this->hasMany(Posts::class, 'categoria_id');
    }

}
