<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $num_page = 2;

    public function index()
    {
        $datos['empleados'] = Empleado::Paginate($this->num_page);
        return view('empleado.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required | unique:empleados',
            'photo' => 'required'
        ];
        $messages = [
            'required' => 'El(La) :attribute es requerido(a).',
            'unique' => 'El :attribute esta duplicado.'
        ];

        $this->validate($request, $rules, $messages);

        $path = Storage::putFile('public/photos', $request->file('photo'));
        $data = $request->except('photo', '_token');
        $data['photo'] = $path;

        Empleado::create($data);

        return redirect()->route('empleado.index')->with('status', 'Nuevo empleado creado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado)
    {
        return view('empleado.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required | unique:empleados,email,'.$empleado->id,
        ];
        $messages = [
            'required' => 'El(La) :attribute es requerido(a).',
            'unique' => 'El :attribute esta duplicado.'
        ];

        $this->validate($request, $rules, $messages);

        $data = $request->except('photo', '_token', '_method');
        if ($request->hasFile('photo')){
            //eliminar foto
            Storage::delete([$empleado->photo]);
            //almacenar nueva foto
            $path = Storage::putFile('public/photos', $request->file('photo'));
            $data['photo'] = $path;
        }

        Empleado::where('id', $empleado->id)->update($data);
        return redirect()->route('empleado.index')->with('status', 'Empleado Actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        //Eliminar foto de la carpeta public
        Storage::delete([$empleado->photo]);
        Empleado::destroy($empleado->id);
        return redirect()->route('empleado.index')->with('status', 'Empleado eliminado.');
    }
}
