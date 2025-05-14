<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ciudad extends Model
{
    use HasFactory;

    protected $table = 'ciudad';
    protected $fillable = ['nombre', 'departamento_id']; 

    // A city belongs to a department
    public function departamento(): BelongsTo
    {
        return $this->belongsTo(Departamento::class);
    }

    // A city has many customers
    public function clientes(): HasMany
    {
        return $this->hasMany(BaseCliente::class);
    }
}