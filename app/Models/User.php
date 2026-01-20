<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Devuelve los grupos de los cuales es administrador
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function admingrupos() {
        return $this->hasMany(Grupo::class, "propietario_id", "id");
    }

   /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
   public function grupos() {
       return $this->belongsToMany(Grupo::class, "grupo_user", "user_id", "grupo_id")->withPivot("amigo_id")->withTimestamps();
   }
}

/**
 * Ahora usamos attach, detach y sync para tratar con la tabla pivote
 */
