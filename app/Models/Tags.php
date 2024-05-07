<?php

namespace App\Models;

use App\Models\Tags;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tags extends Model
{
    use HasFactory;
    protected $table = 'tags';
    protected $fillable= [
        'nombre',
        'estado',
        'usuario_id',
    ];


    //-Relacion con USUARIOS
    public function usuario(){
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
