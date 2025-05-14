<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DatosExport;


class ExportController extends Controller
{
    public function exportarClientes()
    {
        return Excel::download(new DatosExport, 'clientes.xlsx');
    }
}