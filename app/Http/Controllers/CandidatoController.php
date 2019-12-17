<?php

namespace App\Http\Controllers;

use App\Experiencia;
use App\Candidato;
use App\Formacion;
use App\Telefono;
use App\Tipo_empleo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CandidatoController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos = Candidato::where('id',Auth::id())->first();
        $telefonos = Telefono::where('candidatos_id',Auth::id())->get();
        $formacion = Formacion::where('candidatos_id',Auth::id())->get();
        $experiencia = Experiencia::where('candidatos_id',Auth::id())->get();
        $tipoEmpleos = Tipo_empleo::all();
//        $datos = Candidato::hasMany('App\Telefonos');;
//        $datos = Candidato::contactos();
//        $datos = Candidato::all();

        // devolvemos una vista a la que le pasamos un parametro (array de registros)
        return view('candidatos/perfil' , ['datos'=>$datos, 'contactos'=>$telefonos, 'formacion'=>$formacion, 'tipoEmpleos'=>$tipoEmpleos, 'experiencia'=>$experiencia]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // obtener el usuario identificado
        $user   = Auth::user();

        // validar datos
        $this->validate($request, [
            'nombre'    => 'required|string|max:30',
            'email'     => ['required','string','max:30',
                Rule::unique('candidatos')->ignore($user->id)
            ],
            'dni'     => ['required','string','max:9',
                Rule::unique('candidatos')->ignore($user->id)
            ],
        ]);


        if(!Auth::user()->imagen)
            $user->imagen =  '';
        else
            $user->imagen =  Auth::user()->imagen;

        $user->name =  $request->input('nombre');
        $user->apellidos =  $request->input('apellidos');
        $user->direccion =  $request->input('direccion');
        $user->localidad =  $request->input('localidad');
        $user->dni =  $request->input('dni');
        $user->cp =  $request->input('cp');
        $user->provincia =  $request->input('provincia');
        $user->pais =  $request->input('pais');

        // escribir el registro en la bbdd
        $user->update();

        return redirect()->route('perfil')->with(['message-perfil'=>'Datos actualizados correctamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function show(Candidato $candidato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidato $candidato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidato $candidato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidato $candidato)
    {
        //
    }

    public function salvar_telefonos(Request $request){
        $prefijo =  $request->input('prefijo');
        $numero =  $request->input('tel');

        // obtener un recurso de la tabla
        $datos = new Telefono;

        // validar datos
        try {
            $this->validate($request, [
                'prefijo' => 'required|integer|max:4',
                'tel' => 'required|integer|max:9'
            ]);
        } catch (ValidationException $e) {
        }

        $user   = Auth::user();

        $datos->prefijo =   (string)$prefijo;
        $datos->numero  =   (string)$numero;
        $datos->candidatos_id =   (int)$user->id;
        $datos->save();
        return redirect()->route('perfil')->with(['message-tel'=>'Teléfono agregado correctamente']);

    }


    public function subir_avatar(Request $request){

        $ruta_imagen = $request->file('imagen');

        if($ruta_imagen){
            $renombrada = Auth::id()."_".time()."_".$ruta_imagen->getClientOriginalName();
            Storage::disk('avatares')->put($renombrada, File::get($ruta_imagen));

            // obtener el usuario identificado
            $user   = Auth::user();

            // setear el valor del campo imagen
            $user->imagen =  $renombrada;

            // escribir el registro en la bbdd
            if($user->update()){
                return redirect()->route('perfil')->with(['message_img'=>'Imagen cargada correctamente']);

            }

        }

    }

    public function getAvatar($filename){
        $fichero = Storage::disk('avatares')->get($filename);
        return new Response($fichero, 200);
    }
}



