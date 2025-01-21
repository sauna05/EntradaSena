<?php

namespace App\Models\DbEntrada;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    use HasFactory;

    #Nombre de la base de datos
    protected $connection = 'db_entrada';

    #Nombre de la tabla - los modelos se crean en singular y las tablas en plural
    protected $table =  'users';

    #Campos que pueden ser llenados desde el software
    protected $fillable = [
        'user_name',
        'password'
    ];


    //Un usuario pertece a una persona
    public function people(){
        return $this->belongsTo(Person::class);
    }

}
