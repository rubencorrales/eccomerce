<?php

namespace App\Http\Controllers;

use App\Formacion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FormacionController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {

        $ruta_fichero = $request->file('fichero');

        if ($ruta_fichero) {
            $renombrada = Auth::id() . "_" . time() . "_" . $ruta_fichero->getClientOriginalName();
            Storage::disk('documentos')->put($renombrada, File::get($ruta_fichero));

        }

        // obtener el usuario identificado
        $user_id = Auth::user()->id;

        $campos = $request->all();
        $anio = Date('Y');
        // validar datos
        $validator = Validator::make($request->all(), [
            'titulacion' => 'required|string|max:256',
            'centro' => 'required|string|max:256',
            'anio_inicio' => 'numeric|integer|min:1900|max:' . $anio,
            'anio_fin' => 'required|integer|min:1900|max:' . (intval($anio) + 5) . '|min:' . $request->input('anio_inicio'),
            'nota' => 'string|max:30',
            'actividades' => 'string|max:256',
            'descripcion' => 'string|max:256',

        ]);

        if ($validator->fails()) {
            return redirect('/candidatos/perfil#nav-formacion')
                ->withErrors($validator)
                ->withInput();
        }

        $datos = new Formacion;

        $datos->candidatos_id = $user_id;
        $datos->titulacion = $request->input('titulacion');
        $datos->centro = $request->input('centro');
        $datos->anio_inicio = $request->input('anio_inicio');
        $datos->anio_fin = $request->input('anio_fin');
        $datos->nota = $request->input('nota');
        $datos->actividades = $request->input('actividades');
        $datos->descripcion = $request->input('descripcion');
        $datos->fichero = $renombrada ?? '';
        $datos->url = $request->input('url') ?? '';
        $datos->mostrado = $request->input('mostrado') ?? 0;

        // escribir el registro en la bbdd
        $datos->save();

        return redirect()->route('formacion')->with(['message' => 'Datos actualizados correctamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Formacion $formacion
     * @return \Illuminate\Http\Response
     */
    public function show(Formacion $formacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Formacion $formacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Formacion $formacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Formacion $formacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Formacion $formacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Formacion $formacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Formacion $formacion)
    {
        //
    }

    public function getDocumento($filename)
    {
        $fichero = storage_path('documentos') . '/' . $filename;
        return response()->download($fichero);
    }

    public function delete($idToDelete){
        // obtener el usuario identificado
        $user_id = Auth::user()->id;

        $idBorrar = Formacion::find($idToDelete);

        if(Auth::user() && $idBorrar->candidatos_id == $user_id && $idBorrar->id == $idToDelete){
            $idBorrar->delete();
            return redirect()->route('formacion')->with(['message-formacion' => 'Datos borrados correctamente']);
        } else {
            echo "No estas autorizado para eso";
        }

    }
}
