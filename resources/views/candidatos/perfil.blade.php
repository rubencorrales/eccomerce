@extends('layouts.app')
@section('content')

    <div class="container">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                   aria-controls="nav-home" aria-selected="true">Mi Perfil</a>
                <a class="nav-item nav-link" id="nav-formacion-tab" data-toggle="tab" href="#nav-formacion" role="tab"
                   aria-controls="nav-formacion" aria-selected="false">Formación</a>
                <a class="nav-item nav-link" id="nav-experiencia-tab" data-toggle="tab" href="#nav-experiencia"
                   role="tab"
                   aria-controls="nav-experiencia" aria-selected="false">Experiencia</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">

            {{-- Tab Datos PErsonales--}}

            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <br>

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">{{ 'Datos Personales'  }}</div>

                                <div class="card-body">

                                    <form method="POST" enctype="multipart/form-data"
                                          action="{{ action('CandidatoController@store') }}">

                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <label for="nombre">  {{ __('Nombre') }}</label>
                                            <input type="text" class="form-control" required name="nombre"
                                                   value="{{$datos->name ?? ''}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="apellidos">Apellidos</label>
                                            <input type="text" class="form-control" required name="apellidos"
                                                   value="{{$datos->apellidos ?? ''}}">
                                        </div>


                                        <div class="form-group">
                                            <label for="dni">Dni</label>
                                            <input type="text" class="form-control @error('dni') is-invalid @enderror"
                                                   required
                                                   name="dni" value="{{$datos->dni ?? ''}}">
                                        </div>

                                        @if($errors->has('dni'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{$errors->first('dni')}}</strong>
                                        </span>
                                        @endif

                                        <div class="form-group">
                                            <label for="direccion">Dirección</label>
                                            <input type="text" class="form-control" required name="direccion"
                                                   value="{{$datos->direccion ?? ''}}">
                                        </div>


                                        <div class="form-group">
                                            <label for="cp">Código Postal</label>
                                            <input type="text" class="form-control" required name="cp"
                                                   value="{{$datos->cp ?? ''}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="localidad">Localidad</label>
                                            <input type="text" class="form-control" required name="localidad"
                                                   value="{{$datos->localidad ?? ''}}">
                                        </div>


                                        <div class="form-group">
                                            <label for="provincia">Provincia</label>
                                            <input type="text" class="form-control" required name="provincia"
                                                   value="{{$datos->provincia ?? ''}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="pais">Pais</label>
                                            <input type="text" class="form-control" required name="pais"
                                                   value="{{$datos->pais ?? ''}}">
                                        </div>


                                        <div class="form-group">
                                            <label for="pais">Email</label>
                                            <input type="email"
                                                   class="form-control @error('email') is-invalid @enderror" required
                                                   name="email" value="{{$datos->email ?? ''}}">
                                        </div>

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @elseif(session('message-perfil'))
                                            <div class="alert alert-success">
                                                <strong>{{session('message-perfil')}}</strong>
                                            </div>
                                        @endif

                                        <input type="submit" value="Guardar Cambios"
                                               class="btn btn-warning float-lg-right  btn-salvar">
                                    </form>


                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="card">
                                <div class="card-header">{{ 'Imagen del perfil'  }}</div>

                                <div class="card-body">

                                    <form method="POST" enctype="multipart/form-data"
                                          action="{{ action('CandidatoController@subir_avatar') }}">

                                        {{ csrf_field() }}
                                        <center>
                                            @if($datos->imagen)
                                                <img class="avatar_perfil"
                                                     src="{{ url('/candidatos/avatar/'.$datos->imagen) }}">
                                            @endif()
                                        </center>
                                        <div class="form-group">
                                            <label for="foto">Cargar nueva imagen</label>
                                            <input type="file" class="form-control" required name="imagen" value="">
                                        </div>

                                        @if(session('message-img'))
                                            <div class="alert alert-success">
                                                <strong>{{session('message-img')}}</strong>
                                            </div>
                                        @endif

                                        <input type="submit" value="Guardar" class="btn btn-dark float-lg-right">
                                    </form>


                                </div>
                            </div>
                            <br> <br>
                            <div class="card">
                                <div class="card-header">{{ 'Telefonos de contacto'  }}</div>

                                <div class="card-body">

                                    <form method="POST" enctype="multipart/form-data"
                                          action="{{ action('CandidatoController@salvar_telefonos') }}">

                                        {{ csrf_field() }}

                                        <div class="row align-content-center">
                                            <img src="">
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="prefijo">Prefijo Pais</label>
                                                    <input type="number" class="form-control" required name="prefijo"
                                                           id="prefijo"
                                                           value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <label for="tel">Teléfono</label>
                                                    <input type="tel" class="form-control" required name="tel" id="tel"
                                                           value="">
                                                </div>
                                            </div>
                                        </div>


                                        @if(session('message-tel'))
                                            <div class="alert alert-success">
                                                <strong>{{session('message-tel')}}</strong>
                                            </div>
                                        @endif

                                        @foreach($contactos as $tel)
                                            <div class="row">
                                                <div class="col-1">
                                                    <i class="fa fa-phone"></i>
                                                </div>
                                                <div class="col-6">
                                                    {{ $tel->prefijo}} {{ $tel->numero }}
                                                </div>
                                                <div class="col-4 text-right">
                                                    <i class="fa fa-trash"></i>
                                                    <i class="fa fa-edit"></i>
                                                </div>
                                            </div>

                                        @endforeach
                                        <br>
                                        <input type="submit" value="Guardar" class="btn btn-dark float-lg-right">
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{--Tab Formación Academica--}}
            <div class="tab-pane fade" id="nav-formacion" role="tabpanel" aria-labelledby="nav-formacion-tab">
                <br>

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">{{ 'Gestiona tu educación'  }}</div>

                                <div class="card-body">

                                    <form method="POST" enctype="multipart/form-data"
                                          action="{{ action('FormacionController@store') }}">

                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="titulacion">  {{ __('Titulación') }}</label>
                                                    <input type="text" class="form-control"
                                                           value="{{ old('titulacion') }}" required name="titulacion">
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="centro">  {{ __('Centro de estudios') }}</label>
                                                    <input type="text" class="form-control" name="centro"
                                                           value="{{ old('centro') }}">
                                                </div>
                                            </div>

                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label for="nota">  {{ __('Nota') }}</label>
                                                    <input type="text" class="form-control" name="nota"
                                                           value="{{ old('nota') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label for="anio_inicio">  {{ __('Año Comienzo') }}</label>
                                                    <select class="form-control" required name="anio_inicio">
                                                        <option value="0" selected disabled>Seleccione</option>

                                                        @for($n=Date('Y'); $n>1940; $n--)
                                                            <option
                                                                {{ $n== old('anio_inicio')? 'selected' :'' }} value="{{$n}}">{{$n}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label for="anio_fin">  {{ __('Año Finalización') }}</label>
                                                    <select class="form-control" required name="anio_fin">
                                                        <option value="0" selected disabled>Seleccione</option>
                                                        <option value="0">En Curso</option>
                                                        @for($n=Date('Y'); $n>1940; $n--)
                                                            <option
                                                                {{ $n== old('anio_fin')? 'selected' :'' }} value="{{$n}}">{{$n}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-8">
                                                <div class="form-group">
                                                    <label for="actividades">  {{ __('Grupos y Actividades') }}</label>
                                                    <input type="text" class="form-control" name="actividades"
                                                           value="{{ old('actividades') }}">
                                                    <p class="subtitulo">Ejemplo: Equipo de baloncesto, teatro,
                                                        coro...</p>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label
                                                        for="descripcion">  {{ __('Descripción de la formación') }}</label>
                                                    <textarea class="form-control" rows="5"
                                                              name="descripcion">{{ old('descripcion') }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="col-12">
                                                <span class="subtitulo_grupo">Contenido Multimedia</span>
                                                <br>
                                                <span class="subtitulo">Agrega documentos o enlaza a fotos, sitios, videos, presentaciones, etc.</span>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-3">
                                                <span class="btn btn-info btn_cargar_documentos"
                                                      onclick="muestraFile();">Cargar Documento
                                                </span>
                                            </div>

                                            <div class="col-6"></div>

                                            <div class="col-3 text-right">
                                                <span class="btn btn-info btn_cargar_url" onclick="muestraUrl();">Especificar Url</span>

                                            </div>
                                        </div>

                                        <input type="hidden" name="url">
                                        <input type="hidden" name="fichero">

                                        <div class="row cargaUrlFiles" id="divUrl"
                                             style="display:none; padding-top: 20px; padding-bottom: 15px">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="url">  {{ __('Url documento') }}</label>
                                                    <input type="text" class="form-control" name="url"
                                                           value="{{ old('url') }}">
                                                    <p class="subtitulo">Especifique una url hacia un documento pdf,
                                                        jpg, doc, etc. acreditativo de esta formación</p>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row cargaUrlFiles" id="divFile"
                                             style="display:none; padding-top: 20px; padding-bottom: 15px">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="fichero">  {{ __('Cargar fichero local') }}</label>
                                                    <input type="file" class="form-control" name="fichero">
                                                    <p class="subtitulo">Cargue un documento pdf, jpg, doc, etc.
                                                        acreditativo de esta formación</p>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row publicar_formacion">
                                            <div class="col-1 text-left">
                                                <label class="switch ">
                                                    <input type="checkbox" name="mostrado" value="1" class="info"
                                                           checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>

                                            <div class="col-10">
                                                <span class="subtitulo_grupo compartir">Mostrado</span>
                                                <br>
                                                <span class="subtitulo compartir">
                                                    Si no deseas que se muestre esta titulación en tu curriculum, desactiva el botón
                                                </span>
                                            </div>
                                        </div>

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @elseif(session('message-formacion'))
                                            <div class="alert alert-success">
                                                <strong>{{session('message-formacion')}}</strong>
                                            </div>
                                        @endif

                                        <input type="submit" value="Guardar y Otro"
                                               class="btn btn-warning float-lg-right btn-salvar">
                                    </form>
                                    <br><br>
                                    <hr>
                                    <p>Tu formación actual</p>
                                    <br>
                                    <table class="table table-sm">
                                        @foreach($formacion as $form)
                                            <tr>
                                                <td width="10%"></td>
                                                <td width="70%">
                                                    <span class="tabla_titulacion">{{ $form->titulacion}}</span><br>
                                                    <span class="tabla_centro">{{ $form->centro}}</span><br>
                                                    <span
                                                        class="subtitulo">{{ $form->anio_inicio}} - {{ $form->anio_fin}}</span>
                                                </td>
                                                <td width="20%" class="text-right">
                                                    @if($form->fichero!='')
                                                        <a target="_blank"
                                                           href="{{url('candidatos/documentos/'.$form->fichero)}}"><i
                                                                class="far fa-file iconos_edicion"></i></a>
                                                    @endif
                                                    <i class="far fa-eye iconos_edicion"></i>

                                                    <a href="{{ route('borrarformacion', ['id'=>$form->id]) }}">
                                                        <i class="far fa-edit iconos_edicion"></i>
                                                    </a>
                                                    <a href="{{ route('borrarformacion', ['id'=>$form->id]) }}"
                                                       onclick="return confirm('¿ Seguro/a que quieres eliminarlo ?')">
                                                        <i class="far fa-trash iconos_edicion"></i>
                                                    </a>

                                                </td>

                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{--Tab Experiencia Laboral--}}
            <div class="tab-pane fade" id="nav-experiencia" role="tabpanel" aria-labelledby="nav-experiencia-tab">
                <br>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">{{ 'Gestiona tu experiencia'  }}</div>

                                <div class="card-body">
                                    <form method="POST" enctype="multipart/form-data"
                                          action="{{ action('ExperienciaController@store') }}">

                                        {{ csrf_field() }}
                                        <input type="hidden" name="editando" value="false" id="editando">
                                        <input type="hidden" name="id_experiencia" value="" id="id_experiencia">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="cargo">  {{ __('Cargo') }}</label>
                                                    <input type="text" class="form-control" required name="cargo"
                                                           id="cargo"
                                                           value="{{ old('cargo')}}"
                                                           placeholder="Ejemplo: Director comercial">
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="empresa">  {{ __('Empresa') }}</label>
                                                    <input type="text" class="form-control" name="empresa"
                                                           value="{{ old('empresa')}}"
                                                           placeholder="Ejemplo: El Corte Inglés">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="ubicacion">  {{ __('Ubicación') }}</label>
                                                    <input type="text" class="form-control" name="ubicacion"
                                                           value="{{ old('ubicacion')}}"
                                                           placeholder="Ejemplo: Barcelona, España">
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="tipocontrato">  {{ __('Tipo de contrato') }}</label>
                                                    <select class="form-control" required name="tipo_contrato"
                                                            id="tipo_contrato">
                                                        <option value="0" selected disabled>Seleccione</option>
                                                        @foreach ($tipoEmpleos as $tipo)
                                                            <option value="{{ $tipo->id }}">{{ $tipo->tipo }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">

                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label for="mes_inicio">  {{ __('Fecha inicio') }}</label>
                                                    <select class="form-control" required name="mes_inicio_exp"
                                                            id="mes_inicio_exp">
                                                        <option value="0"
                                                                {{ old('mes_inicio_exp')==0 ? 'selected' :'' }} disabled>
                                                            Mes
                                                        </option>
                                                        <option
                                                            value="1" {{ old('mes_inicio_exp')==1 ? 'selected' :'' }} >
                                                            Enero
                                                        </option>
                                                        <option
                                                            value="2" {{ old('mes_inicio_exp')==2 ? 'selected' :'' }} >
                                                            Febrero
                                                        </option>
                                                        <option
                                                            value="3" {{ old('mes_inicio_exp')==3 ? 'selected' :'' }} >
                                                            Marzo
                                                        </option>
                                                        <option
                                                            value="4" {{ old('mes_inicio_exp')==4 ? 'selected' :'' }} >
                                                            Abril
                                                        </option>
                                                        <option
                                                            value="5" {{ old('mes_inicio_exp')==5 ? 'selected' :'' }} >
                                                            Mayo
                                                        </option>
                                                        <option
                                                            value="6" {{ old('mes_inicio_exp')==6 ? 'selected' :'' }} >
                                                            Junio
                                                        </option>
                                                        <option
                                                            value="7" {{ old('mes_inicio_exp')==7 ? 'selected' :'' }} >
                                                            Julio
                                                        </option>
                                                        <option
                                                            value="8" {{ old('mes_inicio_exp')==8 ? 'selected' :'' }} >
                                                            Agosto
                                                        </option>
                                                        <option
                                                            value="9" {{ old('mes_inicio_exp')==9 ? 'selected' :'' }} >
                                                            Septiembre
                                                        </option>
                                                        <option
                                                            value="10" {{ old('mes_inicio_exp')==10 ? 'selected' :'' }} >
                                                            Octubre
                                                        </option>
                                                        <option
                                                            value="11" {{ old('mes_inicio_exp')==11 ? 'selected' :'' }} >
                                                            Noviembre
                                                        </option>
                                                        <option
                                                            value="12" {{ old('mes_inicio_exp')==12 ? 'selected' :'' }} >
                                                            Diciembre
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label for="anio_inicio_exp"><br></label>
                                                    <select class="form-control" required name="anio_inicio_exp"
                                                            id="anio_inicio_exp">
                                                        <option value="0" selected disabled>Año</option>
                                                        @for($n=Date('Y'); $n>1940; $n--)
                                                            <option value="{{$n}}">{{$n}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label for="mes_fin">  {{ __('Fecha finalización') }}</label>
                                                    <select class="form-control" required name="mes_fin_exp"
                                                            id="mes_fin_exp">
                                                        <option value="0" selected disabled>Mes</option>
                                                        <option value="1">Enero</option>
                                                        <option value="2">Febrero</option>
                                                        <option value="3">Marzo</option>
                                                        <option value="4">Abril</option>
                                                        <option value="5">Mayo</option>
                                                        <option value="6">Junio</option>
                                                        <option value="7">Julio</option>
                                                        <option value="8">Agosto</option>
                                                        <option value="9">Septiembre</option>
                                                        <option value="10">Octubre</option>
                                                        <option value="11">Noviembre</option>
                                                        <option value="12">Diciembre</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label for="anio_fin_exp"> <br></label>
                                                    <select class="form-control" required name="anio_fin_exp"
                                                            id="anio_fin_exp">
                                                        <option value="0" selected disabled>Año</option>
                                                        @for($n=Date('Y'); $n>1940; $n--)
                                                            <option value="{{$n}}">{{$n}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-1 text-left">
                                                <div class="form-group text-left">
                                                    <br>
                                                    <label class="switch ">
                                                        <input type="checkbox" name="actualidad" id="actualidad" onchange="puesto_actual(this)"
                                                               value="1" class="info">
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-3 text-left">
                                                <div class="form-group text-left">
                                                    <br><br>
                                                    En la actualidad trabajo aqui
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label
                                                        for="descripcion_puesto">  {{ __('Descripción del puesto') }}</label>
                                                    <textarea class="form-control" rows="5" id="descripcion"
                                                              name="descripcion_puesto"> {{ old('descripcion_puesto')}}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="col-12">
                                                <span class="subtitulo_grupo">Contenido Multimedia</span>
                                                <br>
                                                <span class="subtitulo">Agrega documentos o enlaza a fotos, sitios, videos, presentaciones, etc.</span>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-3">
                                                <span class="btn btn-info btn_cargar_documentos"
                                                      onclick="muestraFile(2);">Cargar Documento
                                                </span>
                                            </div>

                                            <div class="col-6"></div>

                                            <div class="col-3 text-right">
                                                <span class="btn btn-info btn_cargar_url" onclick="muestraUrl(2);">Especificar Url</span>

                                            </div>
                                        </div>


                                        <div class="row cargaUrlFiles" id="divUrl2"
                                             style="display:none; padding-top: 20px; padding-bottom: 15px">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="url">  {{ __('Url documento') }}</label>
                                                    <input type="text" class="form-control" name="url_experiencia"
                                                           value="{{ old('url_experiencia')}}">
                                                    <p class="subtitulo">Especifique una url hacia un documento pdf,
                                                        jpg, doc, etc. acreditativo de esta formación</p>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row cargaUrlFiles" id="divFile2"
                                             style="display:none; padding-top: 20px; padding-bottom: 15px">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="fichero">  {{ __('Cargar fichero local') }}</label>
                                                    <input type="file" class="form-control" name="fichero_experiencia">
                                                    <p class="subtitulo">Cargue un documento pdf, jpg, doc, etc.
                                                        acreditativo de esta formación</p>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row publicar_formacion">
                                            <div class="col-1 text-left">
                                                <label class="switch ">
                                                    <input type="checkbox" name="mostrado_exp" value="1" class="info"
                                                           checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>

                                            <div class="col-10">
                                                <span class="subtitulo_grupo compartir">Mostrado</span>
                                                <br>
                                                <span class="subtitulo compartir">
                                                    Si no deseas que se muestre esta titulación en tu curriculum, desactiva el botón
                                                </span>
                                            </div>
                                        </div>

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @elseif(session('message-experiencia'))
                                            <div class="alert alert-success">
                                                <strong>{{session('message-experiencia')}}</strong>
                                            </div>
                                        @endif

                                        <input type="submit" value="Guardar y Otro"
                                               class="btn btn-warning float-lg-right btn-salvar">
                                    </form>
                                    <br><br>
                                    <hr>
                                    <p>Tu experiencia</p>
                                    <br>
                                    <meta name="csrf-token" content="{{ csrf_token() }}"/>

                                    @foreach($experiencia as $form)
                                        <div class="row">
                                            <div class="col-1"></div>
                                            <div class="col-9">
                                                <span class="tabla_titulacion">{{ $form->puesto}}</span><br>
                                                <span class="tabla_centro">{{ $form->empresa}}</span><br>

                                                <span class="subtitulo">{{ $form->mes_comienza}}/{{ $form->anio_comienza}} - {{ $form->mes_termina}}/{{ $form->anio_termina}}</span>
                                            </div>
                                            <div class="col-2 text-right">
                                                @if($form->fichero!='')
                                                    <a target="_blank"
                                                       href="{{url('candidatos/documentos/'.$form->fichero)}}"><i
                                                            class="far fa-file iconos_edicion "></i></a>
                                                @endif
                                                <span onclick="mostrarInfo({{ $form->id }});">
                                                        <i class="far fa-eye iconos_edicion"></i>
                                                    </span>
                                                <i class="far fa-edit iconos_edicion"
                                                   onclick="editarExperiencia({{ $form->id }});"></i>
                                                <a href="{{ route('borrarexperiencia', ['id'=>$form->id]) }}"
                                                   onclick="return confirm('¿ Seguro/a que quieres eliminarlo ?')">
                                                    <i class="far fa-trash iconos_edicion"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row margen-u-d-20">
                                            <div class="col-1"></div>
                                            <div class="col-11">
                                                <div class="collapse multi-collapse" id="divInfo{{$form->id}}">
                                                    <div class="card card-body">
                                                        <h4>{{$form->ubicacion}}</h4>
                                                        <span>{{$form->tipo_contrato}}</span>
                                                        <span>{{$form->titular}}</span>
                                                        <span>{{$form->descripcion}}</span>
                                                        <span>{{$form->url}}</span>
                                                        <span>{{$form->created_at}} / {{$form->updated_at}}</span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection

@include('candidatos/modal')

