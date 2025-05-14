<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
    public function run()
    {
        $departamentos = [
            'Amazonas', 'Antioquia', 'Arauca', 'Atlántico', 'Bolívar',
            'Boyacá', 'Bogotá','Caldas', 'Caquetá', 'Casanare', 'Cauca', 'Cesar',
            'Chocó', 'Córdoba', 'Cundinamarca', 'Guainía', 'Guaviare',
            'Huila', 'La Guajira', 'Magdalena', 'Meta', 'Nariño',
            'Norte de Santander', 'Putumayo', 'Quindío', 'Risaralda',
            'San Andrés', 'Santander', 'Sucre', 'Tolima',
            'Valle del Cauca', 'Vaupés', 'Vichada'
        ];

        foreach ($departamentos as $nombre) {
            Departamento::firstOrCreate(['nombre' => $nombre]);
        }
    }
}