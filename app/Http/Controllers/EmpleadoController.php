<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Empleado;
use App\Models\Cargo;
use App\Models\Aumento;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Mostrar un listado de los empleados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Paginar empleados con máximo 10 por página
        $empleados = Empleado::with('cargo')->paginate(5); 
        $cargos = Cargo::all(); // Trae todos los cargos
        return view('empleados.index', compact('empleados', 'cargos')); 
    }

    /**
     * Mostrar el formulario para crear un nuevo empleado.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cargos = Cargo::all(); // Obtener todos los cargos para el selector en la vista
        return view('empleados.create', compact('cargos')); // Retornar la vista de creación con los cargos
    }

    /**
     * Almacenar un nuevo empleado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'sexo' => 'required',
            'fecha_ingreso' => 'required',
            'cargo_id' => 'required'
        ]);

        Empleado::create($data);

        return redirect()->route('empleados.index')->with('success', 'Empleado creado exitosamente'); // Redirigir al index con mensaje
    }

    /**
     * Mostrar el formulario para editar un empleado específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id); // Obtener el empleado por ID
        $cargos = Cargo::all(); // Obtener los cargos para el selector
        return view('empleados.create', compact('empleado', 'cargos')); // Retornar la vista de edición
    }

    /**
     * Actualizar un empleado existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $empleado = Empleado::findOrFail($id); // Encontrar el empleado por ID
        $data = $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'sexo' => 'required',
            'fecha_ingreso' => 'required',
            'cargo_id' => 'required'
        ]);

        $empleado->update($data);

        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado exitosamente'); // Redirigir al index con mensaje
    }

    /**
     * Eliminar un empleado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Empleado::findOrFail($id)->delete(); // Eliminar el empleado

        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado exitosamente'); // Redirigir al index con mensaje
    }

    // public function historial($id)
    // {
    //     $empleado = Empleado::with('aumentos')->findOrFail($id);
    //     return view('empleados.historial', compact('empleado'));
    // }

    public function historial($id)
    {
        // Obtener los aumentos del empleado con paginación
        $aumentos = DB::table('aumentos')
            ->join('empleados', 'aumentos.empleado_id', '=', 'empleados.id')
            ->join('cargos', 'aumentos.cargo_id', '=', 'cargos.id')
            ->select('aumentos.*', 'empleados.nombres as nombre_empleado', 'empleados.apellidos as apellidos_empleado', 'cargos.cargo as nombre_cargo')
            ->where('empleados.id', $id)
            ->paginate(10);  // Paginar con 10 resultados por página
            
        // Obtener los detalles del empleado para pasarlos a la vista
        $empleado = Empleado::find($id);
    
        // Pasar los datos a la vista
        return view('empleados.historial', compact('aumentos', 'empleado'));
    }

    public function createAumento($id)
    {
        $empleado = Empleado::findOrFail($id);
        $cargos = Cargo::all(); // Asegúrate de obtener los cargos para mostrarlos en el formulario.
        return view('empleados.aumento_create', compact('empleado', 'cargos'));
    }

    public function storeAumento(Request $request, $id)
    {
        $data = $request->validate([
            'fecha' => 'required|date',
            'valor' => 'required|numeric',
            'cargo_id' => 'required|exists:cargos,id',
        ]);

        Aumento::create([
            'fecha' => $data['fecha'],
            'valor' => $data['valor'],
            'empleado_id' => $id,
            'cargo_id' => $data['cargo_id'],
        ]);

        return redirect()->route('empleados.historial', $id)->with('success', 'Aumento registrado exitosamente.');
    }

        public function aumentos()
            {
                return $this->hasMany(Aumento::class);
            }

            

}
