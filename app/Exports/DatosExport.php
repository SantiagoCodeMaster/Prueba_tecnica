<?php

namespace App\Exports;

use Maatwebsite\Excel\Exporter;
use Maatwebsite\Excel\Files\NewExcelFile;
use App\Models\BaseCliente;

class DatosExport extends NewExcelFile
{
    public function getFilename()
    {
        return 'clientes-exportados';
    }

    public function getExporter()
    {
        return Exporter::xlsx;
    }

    public function getData()
    {
        // Excel Headers
        $headers = [
            'Nombre',
            'Apellido',
            'Cédula',
            'Celular',
            'Correo',
            'Departamento',
            'Ciudad'
        ];

        // Get data from the BaseCliente table
        $clientes = BaseCliente::all();

        // Map data to an array
        $rows = $clientes->map(function ($cliente) {
            return [
                $cliente->Nombre,       
                $cliente->Apellido,     
                $cliente->Cédula,
                $cliente->Celular,
                $cliente->Correo,
                $cliente->Departamento,
                $cliente->Ciudad
            ];
        })->toArray();

        return array_merge([$headers], $rows);
    }
}