<?php

namespace App\Http\Controllers;

use App\Experiencia;
use App\Formacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Clases\Utiles as Util;

class ExperienciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

//    public function __construct()
//    {
//        $this->middleware('auth');
//    }



//    public function __construct($resource)
//    {
//        $this->resource = $resource;
//        $this->util= new Util;
//    }

    public function index()
    {
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ruta_fichero = $request->file('fichero_experiencia');

        if($ruta_fichero){
            $renombrada = Auth::id()."_".time()."_".$ruta_fichero->getClientOriginalName();
            Storage::disk('experiencias')->put($renombrada, File::get($ruta_fichero));

        }

        // obtener el usuario identificado
        $user_id   = Auth::user()->id;


        $anio = Date('Y');
        // validar datos
        $validator = Validator::make($request->all(), [
            'cargo'    => 'required|string|max:128',
            'empresa'        => 'required|string|max:128',
            'ubicacion'        => 'required|string|max:128',
            'tipo_contrato'   => 'numeric|integer|min:1|max:10',
            'mes_inicio'   => 'numeric|integer|min:1|max:12',
            'mes_fin'   => 'numeric|integer|min:1|max:12',
            'anio_inicio_exp'      => 'required|integer|min:1900|max:'.(intval($anio)+5),
            'anio_fin_exp'      => 'required|integer|min:1900|max:'.(intval($anio)+5).'|min:'.$request->input('anio_inicio_exp'),
            'fichero_experiencia'       => 'mimes:jpg,png,pdf,doc|required_if:url,!=,null',

        ]);

        // si la validación es erronea se regresa a la vista anterior, justo al tab de experiencia, retornando los valores de request para poder
        // presentarlos de nuevo en cada campo con value="{{ old('campo')}}"

        if ($validator->fails()) {
            return redirect('/candidatos/perfil#nav-experiencia')
                ->withErrors($validator)
                ->withInput();
        }

        $actualizar = false;

        // si el campo editando es true actualizamos en vez de añadir registro
        // teniendo en cuenta que el ususario esta logueado
        // leemos el registro de la tabla cuyo id = al campo oculto id y el user_id sea igual al usuario logueado

        if(Auth::user() && $request->input('editando')=='true'){
            $actualizar = true;

            $datos = Experiencia::find($request->input('id_experiencia'));

        } else {
            $datos = new Experiencia;
        }

        $datos->candidatos_id =  $user_id;
        $datos->empresa =  $request->input('empresa');
        $datos->ubicacion =  $request->input('ubicacion');
        $datos->puesto =  $request->input('cargo');
        $datos->tipo_contrato =  $request->input('tipo_contrato');
        $datos->mes_comienza =  $request->input('mes_inicio_exp');
        $datos->mes_termina =  $request->input('mes_fin_exp');
        $datos->anio_comienza =  $request->input('anio_inicio_exp');
        $datos->anio_termina =  $request->input('anio_fin_exp');
        $datos->titular =  '';
        $datos->descripcion =  $request->input('descripcion_puesto');
        $datos->fichero =  $renombrada ?? '';
        $datos->url =  $request->input('url_experiencia') ?? '';
        $datos->mostrado =  $request->input('mostrado_exp') ?? 0;
        $datos->puesto_actual =  $request->input('actualidad') ?? 0;

        // escribir el registro en la bbdd
        if($actualizar)
            $this->update($request, $datos);
        else
            $datos->save();

        return redirect()->route('experiencia')->with(['message'=>'Datos actualizados correctamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Experiencia  $experiencia
     * @return \Illuminate\Http\Response
     */
    public function show(Experiencia $experiencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Experiencia  $experiencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Experiencia $experiencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Experiencia  $experiencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Experiencia $experiencia)
    {
        $experiencia->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Experiencia  $experiencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Experiencia $experiencia)
    {
        //
    }

    public function delete($idToDelete){
        // obtener el usuario identificado
        $user_id = Auth::user()->id;

        $idBorrar = Experiencia::find($idToDelete);

        if(Auth::user() && $idBorrar->candidatos_id == $user_id && $idBorrar->id == $idToDelete){
            $idBorrar->delete();
            return redirect()->route('experiencia')->with(['message-experiencia' => 'Datos borrados correctamente']);
        } else {
            echo "No estas autorizado para eso";
        }

    }

    public function mostrar($idToview){
        // obtener el usuario identificado
        $user_id = Auth::user()->id;

        $idMostrar = Experiencia::where('id', $idToview)->first();
        $idMostrar = $idMostrar->fresh();

        if(Auth::user() && $idMostrar->candidatos_id == $user_id && $idMostrar->id == $idToview){

            $r= new Util($idMostrar);
            return view('candidatos.modal', compact('r'));

        } else {
            echo "No estas autorizado para eso";
        }

    }


    public function leerUnRegistro($id){
        // obtener el usuario identificado
        $user_id = Auth::user()->id;

        $registro = Experiencia::where('id',$id)->where('candidatos_id', $user_id)->get();

        if(count($registro) > 0)
            return response()->json([
                'registro'  =>  $registro
            ]);
        else
            return response()->json([
                'registro'  =>  "error"
            ]);

    }




}
