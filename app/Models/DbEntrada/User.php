<?php

namespace App\Models\DbEntrada;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Spatie\Permission\Traits\HasRoles;

class User  extends Authenticatable
{
    //HasRoles para identificar que usará roles de la manera en que se usan en la dependencia spatie-permissions
    use HasRoles, HasFactory; 
   

    protected $guard_name = 'web';
    
    #Nombre de la base de datos
    protected $connection = 'db_entrada';

    #Nombre de la tabla - los modelos se crean en singular y las tablas en plural
    protected $table =  'users';

    #Campos que pueden ser llenados desde el software
    protected $fillable = [
        'id_person',
        'user_name',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        'password' => 'hashed'
    ];



    public function person()
    {
        return $this->hasOne(Person::class, 'document_number', 'name'); 
    }




    //Un usuario pertece a una persona
    public function people(){
        return $this->belongsTo(Person::class);
    }

}
