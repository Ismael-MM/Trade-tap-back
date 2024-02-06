<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Cliente extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function trabajadors(): BelongsToMany
    {
        return $this->belongsToMany(Trabajador::class);
    }

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
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
}
