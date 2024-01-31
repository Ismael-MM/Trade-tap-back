<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Trabajadore extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'apellido1',
        'apellido2',
        'direccion',
        'provincia',
        'localidad',
        'cp',
        'cif',
        'email',
        'descripcion',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function horarioTrabajador(): HasOne
    {
        return $this->hasOne(HorarioTrabajador::class);
    }

    public function profesions(): BelongsToMany
    {
        return $this->belongsToMany(Profesion::class);
    }
}
