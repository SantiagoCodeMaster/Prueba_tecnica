<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaseCliente;
use App\Models\Departamento;


class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //return all departamentos
        $departamentos = Departamento::all();
        return view('clientes', compact('departamentos'));
    }


     public function store(Request $request){
      // Validate the form data
      $validatedData = $request->validate([
        'Nombre' => 'required|regex:/^[A-Za-záéíóúÁÉÍÓÚñÑ ]+$/|max:255',
        'Apellido' => 'required|regex:/^[A-Za-záéíóúÁÉÍÓÚñÑ ]+$/|max:255',
        'Cedula' => 'required|string|max:20|unique:clientes,Cedula',
        'departamento_id' => 'required|exists:departamentos,id',
        'ciudad_id' => 'required|exists:ciudad,id',
        'Celular' => 'required|string|max:20',
        'Correo_Electrónico' => 'required|email|max:255|unique:clientes,Correo_Electrónico',
      ]);

      // Save the data to the database
      BaseCliente::create($validatedData);

      // Redirect or return a response
      return redirect()->route('encuesta.show')->with('success', 'Cliente creado correctamente.');
    }


    public function show(){
      // Get all departamentos
      $clientes = BaseCliente::with(['departamento', 'ciudad'])->get();
      return view('clientesdatos', compact('clientes'));
    }

    public function seleccionarGanador(){
       // validate the form data the minimum number of participants
       $minimoParticipantes = 5;
       $totalClientes = BaseCliente::count();
 
        // Check if the number of participants is less than the minimum required
       if ($totalClientes < $minimoParticipantes) {
          return response()->json([
            'error' => "Se requieren mínimo $minimoParticipantes participantes"
          ], 422);
        }
 
        // Select a random winner from the clients
        $ganador = BaseCliente::inRandomOrder()->first();
    
        return response()->json([
          'ganador' => $ganador,
          'ciudad' => $ganador->ciudad->nombre,
          'departamento' => $ganador->departamento->nombre
       ]);
    }



}