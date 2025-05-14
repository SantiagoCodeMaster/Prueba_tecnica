<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BaseCliente extends Model
{
    use HasFactory;
    protected $table = 'clientes';
    protected $fillable = [
    'Nombre',
    'Apellido',
    'Cedula',
    'departamento_id',
    'ciudad_id',
    'Celular',
    'Correo_Electrónico'
];

    // A client belongs to a department
    public function departamento(): BelongsTo
    {
        return $this->belongsTo(Departamento::class);
    }

    // A client belongs to a city
    public function ciudad(): BelongsTo
    {
        return $this->belongsTo(Ciudad::class);
    }

    

}
