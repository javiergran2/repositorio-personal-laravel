<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grupo extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'importe',
        'fechasorteo',
        'fechaentregaregalos',
        'comentario',
        'codigoacceso',
        'propietario_id',
        'estado'
    ];

    public function propietario()
    {
        return $this->belongsTo(User::class, "propietario_id", "id");
    }

   /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
   public function participantes() {
       return $this->belongsToMany(User::class, "grupo_user", "grupo_id", "user_id")->withPivot('amigo_id')->withTimestamps();
   }

   public function nparticipantes() {

   }
}
