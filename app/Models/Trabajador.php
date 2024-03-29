<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Trabajador extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cif',
        'descripcion',
        'situacion',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function horarioTrabajador(): HasOne
    {
        return $this->hasOne(HorarioTrabajador::class);
    }

    public function horarioInhabilitado(): HasOne
    {
        return $this->hasOne(HorarioInhabilitado::class);
    }

    public function profesions(): BelongsToMany
    {
        return $this->belongsToMany(Profesion::class);
    }

    public function clientes(): BelongsToMany
    {
        return $this->belongsToMany(Cliente::class);
    }

    public function solicituds(): HasMany
    {
        return $this->hasMany(Solicitud::class);
    }

    public function propuestas(): HasMany
    {
        return $this->hasMany(Propuesta::class);
    }

    public function reservas(): HasMany
    {
        return $this->hasMany(Reserva::class);
    }

    public function encargos(): HasMany
    {
        return $this->hasMany(Encargo::class);
    }

    public function valoracions(): HasMany
    {
        return $this->hasMany(Valoracion::class);
    }

    public function publicacions(): HasMany
    {
        return $this->hasMany(Publicacion::class);
    }
}
