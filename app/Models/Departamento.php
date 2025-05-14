<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'departamentos';
    protected $fillable = ['nombre'];

    // A department has many cities
    public function ciudades(): HasMany
    {
        return $this->hasMany(Ciudad::class);
    }

    // A department has many clients
    public function clientes(): HasMany
    {
        return $this->hasMany(BaseCliente::class);
    }
}