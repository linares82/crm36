@extends('layouts.master1')

@section('content')
	<div class="breadcrumbs ace-save-state" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<a href="{{route('home')}}">
				<i class="ace-icon fa fa-home home-icon"></i>
				</a>
			</li>

			<li>
				<a href="{{ route('oportunities.oportunity.index') }}">{{ trans('oportunities.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Oportunity' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('oportunities.oportunity.destroy', $oportunity->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('oportunities.oportunity.index')
                    <a href="{{ route('oportunities.oportunity.index') }}" class="btn btn-primary" title="{{ trans('oportunities.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('oportunities.oportunity.create')
                    <a href="{{ route('oportunities.oportunity.create') }}" class="btn btn-success" title="{{ trans('oportunities.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('oportunities.oportunity.edit')
                    <a href="{{ route('oportunities.oportunity.edit', $oportunity->id ) }}" class="btn btn-primary" title="{{ trans('oportunities.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('oportunities.oportunity.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('oportunities.delete') }}" onclick="return confirm(&quot;{{ trans('oportunities.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <div class="row col-md-4" >
            <dl class="dl-horizontal" class="col-md-4">
                <dt>{{ trans('oportunities.oportunity_label_id') }}</dt>
                <dd>{{ optional($oportunity->oportunityLabel)->etiqueta }}</dd>
                <dt>{{ trans('oportunities.descripcion') }}</dt>
                <dd>{{ $oportunity->descripcion }}</dd>
                <dt>{{ trans('oportunities.oportunity_st_id') }}</dt>
                <dd><span class="label arrowed-in-right arrowed" style="background-color: {{ old('color', optional($oportunity->oportunitySt)->color) }};">{{ optional($oportunity->oportunitySt)->estatus }}</span></dd>
            </dl>
        </div>
        <div class="row col-md-4" >
            <dl class="dl-horizontal" class="col-md-4">
                <dt>{{ trans('oportunities.usu_alta_id') }}</dt>
                <dd>{{ optional($oportunity->user)->name }}</dd>
                <dt>{{ trans('oportunities.usu_mod_id') }}</dt>
                <dd>{{ optional($oportunity->user)->name }}</dd>
                <dt>{{ trans('oportunities.created_at') }}</dt>
                <dd>{{ $oportunity->created_at }}</dd>
            </dl>
        </div>
        
        <div class="row col-md-4" >
            <dl class="dl-horizontal" class="col-md-4">
                <dt>{{ trans('oportunities.updated_at') }}</dt>
                <dd>{{ $oportunity->updated_at }}</dd>
                <dt>{{ trans('oportunities.deleted_at') }}</dt>
                <dd>{{ $oportunity->deleted_at }}</dd>
            </dl>
        </div>
        
    </div>
</div>

<div class="row col-md-12" id='loading3' style='display: none'>
    <h3>Actualizando... Por Favor Espere.</h3>
    <div class="progress progress-striped active page-progress-bar">
        <div class="progress-bar" style="width: 100%;"></div>
    </div>
</div>    

<div class="row">
    <div class="col-md-6 col-xs-6">
    <div class="col-xs-12 widget-container-col ui-sortable" id="widget-container-col-10">											
        <div class="widget-box ui-sortable-handle" id="widget-box-10">
                <div class="widget-header widget-header-small">
                    <h5 class="widget-title smaller">Contacto o Cliente</h5>

                    <div class="widget-toolbar no-border">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active">
                                <a data-toggle="tab" href="#informacion">Información</a>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="widget-body">
                    <div class="widget-main padding-6">
                        <div class="tab-content">
                            <div id="informacion" class="tab-pane in active">
                                @if(count($oportunity->customer)>0)
                                    @foreach($oportunity->customer as $customer)
                                        <div class="row">
                                            <a href="{{route('customers.customer.edit', array('id'=>$customer->id,'oportunidad'=>$oportunity->id))}}" class="btn btn-info btn-minier">Editar Cliente</a>
                                            <button class="edit-modal btn btn-warning btn-minier"><span class="glyphicon glyphicon-edit"></span> Cambiar Cliente </button>
                                        </div>
                                        <label><strong>Razón Social:</strong></label>{{$customer->razon  }}<br/>
                                        <label><strong>Nombre:</strong></label>{{$customer->nombre1." ".
                                                                                 $customer->nombre2." ".
                                                                                 $customer->ape_paterno." ".
                                                                                 $customer->ape_materno  }}<br/>
                                        <label><strong>Direccion:</strong></label>{{$customer->calle." ".
                                                                                    $customer->no_inte." ".
                                                                                    $customer->no_ext." ".
                                                                                    $customer->colonia." ".
                                                                                    $customer->ciudad." ".
                                                                                    $customer->estado->estado." ".
                                                                                    $customer->municipio->municipio." ".
                                                                                    $customer->cp  }}<br/>
                                        <label><strong>Teléfono Celular:</strong></label>{{$customer->celular  }}
                                        <label><strong>, Comprobado:</strong></label>
                                        @if($customer->celular_confirmar==0)
                                            NO
                                        @else
                                            SI
                                        @endif
                                        <a href='#' class='btn btn-minier btn-success'>Comprobar</a><br/>
                                        <label><strong>Teléfono fijo:</strong></label>{{$customer->fijo  }}<br/>
                                        <label><strong>Email:</strong></label>{{$customer->email  }}
                                        <label><strong>, Comprobado:</strong></label>
                                        @if($customer->email_confirmar==0)
                                            NO
                                        @else
                                            SI
                                        @endif
                                        <a href='#' class='btn btn-minier btn-success'>Comprobar</a>
                                        <br/>
                                    @endforeach
                                @else
                                    <label>Sin cliente relacionado</label>
                                    <a href="{{route('customers.oportunity.create', array('oportunidad'=>$oportunity->id))}}" class="btn btn-minier btn-success ">Crear Cliente</a>
                                    <button class="edit-modal btn btn-warning btn-minier"><span class="glyphicon glyphicon-edit"></span> Seleccionar Cliente </button>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="col-xs-12 widget-container-col ui-sortable" id="widget-container-col-10">											
        <div class="widget-box ui-sortable-handle" id="widget-box-10">
                <div class="widget-header widget-header-small">
                    <h5 class="widget-title smaller">Productos o Servicios</h5>

                    <div class="widget-toolbar no-border">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active">
                                <a data-toggle="tab" href="#informacion_productos">Información</a>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="widget-body">
                    <div class="widget-main padding-6">
                        <div class="tab-content">
                            <div id="informacion_productos" class="tab-pane in active">
                                @if(count($oportunity->product)>0)
                                @foreach($oportunity->product as $product)
                                <div class="row">
                                    <a href="{{route('products.product.edit', array('id'=>$product->id,'oportunidad'=>$oportunity->id))}}" class="btn btn-info btn-minier">Editar Producto</a>
                                    <button class="edit-modal-producto btn btn-warning btn-minier"><span class="glyphicon glyphicon-edit"></span> Seleccionar Producto </button>
                                </div>
                                <label><strong>{{$product->typeProduct->producto}}:</strong></label>{{$product->producto  }}<br/>
                                @endforeach
                                @else
                                <label>Sin productos o servicios relacionados</label>
                                <a href="{{route('products.product.create', array('oportunity_id'=>$oportunity->id))}}" class="btn btn-minier btn-success ">Crear</a>
                                <button class="edit-modal-producto btn btn-warning btn-minier"><span class="glyphicon glyphicon-edit"></span> Seleccionar Producto </button>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xs-12 widget-container-col ui-sortable" id="widget-container-col-10">
											
        <div class="widget-box ui-sortable-handle" id="widget-box-10">
                <div class="widget-header widget-header-small">
                    <h5 class="widget-title smaller">Comunicacion</h5>
                    <div class="widget-toolbar no-border">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active">
                                <a data-toggle="tab" href="#sms">SMS</a>
                            </li>

                            <li>
                                <a data-toggle="tab" href="#mail">Email</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#archivos">Archivos</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#alertas">Alertas</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#notas">Notas</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tareas">Tareas</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="widget-body">
                    <div class="widget-main padding-6">
                        <div class="tab-content">
                            <div id="sms" class="tab-pane in active">
                                <p>Raw denim you probably haven't heard of them jean shorts Austin.</p>
                            </div>

                            <div id="mail" class="tab-pane">
                                <div id="spinner_loading">
                                    
                                </div>
                                <form  id="f_enviar_correo" name="f_enviar_correo"  action="{{url('/oportunities/oportunity/enviarCorreo')}}"  class="formarchivo" enctype="multipart/form-data" method="post" >
                                <div class="form-group">
                                    
                                        <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>"> 
                                        <input class="form-control" placeholder="Para:" id="destinatario" name="destinatario" value="@if(count($oportunity->customer)>0)@foreach($oportunity->customer as $customer){{$customer->email}}@endforeach @endif">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Nombre:" id="nombre" name="nombre" value="@if(count($oportunity->customer)>0)@foreach($oportunity->customer as $customer){{$customer->nombre1}}@endforeach @endif">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Asunto:" id="asunto" name="asunto">
                                        </div>
                                        
                                        <div class="form-group">
                                            <textarea id="contenido_mail" name="contenido_mail" class="form-control" style="height: 200px" placeholder="escriba aquí...">
                                                Mensaje
                                            </textarea>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> Adjuntar Archivo
                                                <input type="file"  id="file" name="file" class="email_archivo" >
                                                <input type="hidden"  id="file_hidden" name="file_hidden" >
                                            </div>
                                            <p class="help-block"  >Max. 20MB</p>
                                            <div id="texto_notificacion">

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-offset-2 col-md-10">
                                                <input class="btn btn-primary" type="submit" value="{{ trans('customers.add') }}">
                                            </div>
                                        </div>
                                </form>

                            </div>

                            <div id="archivos" class="tab-pane">
                                <div id="spinner_loading">
                                    
                                </div>
                                @if(count($oportunity->archivos)>0)
                                    <table class="table table-striped table-bordered table-hover table-xtra-condensed" id="lista_alertas">
                                        <thead class="thin-border-bottom">
                                            <tr>
                                                <th>Archivo</th>
                                                <th>Nota</th>
                                                <th>Fecha</th>
                                                <th>
                                                    
                                                </th>
                                            </tr>
                                        </thead>
                                            @foreach($oportunity->archivos as $archivo)
                                                <tr id='ln_alert{{$archivo->id}}'>
                                                    <td>
                                                        <a href="{{ route('files_customers.files_customer.descargaArchivo', array('id'=>$archivo->id)) }}">
                                                            {{ $archivo->archivo }}
                                                        </a>
                                                    </td>
                                                    <td>{{$archivo->nota}}</td>
                                                    <td>{{$archivo->created_at}}</td>
                                                    <td>
<!--                                                        <button type="button" class="btn btn-danger btn-minier" id='borrar_alerta' data-id='{{$archivo->id}}'>Eliminar <i class="glyphicon glyphicon-trash"></i></button>-->
                                                    </td>
                                                </tr>
                                            @endforeach
                                        <tbody>

                                        </tbody>
                                    </table>
                                @endif

                            </div>
                            
                            <div id="alertas" class="tab-pane">
                                <div class="no-padding panel-body">
                                @if ($errors->any())
                                    <ul class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                <form method="POST" accept-charset="UTF-8" id="create_alert_form" name="create_alert_form" class="">
                                {{ csrf_field() }}
                                @include ('alerts.form', [
                                                            'alert' => null,
                                                            'oportunity_id'=>$oportunity->id
                                                          ])

                                    <div class="form-group">
                                        <button type="button" class="btn btn-success btn-minier" id='guardar_alerta'>{{ trans('alerts.add') }} <i class="glyphicon glyphicon-plus"></i></button>
                                        <button type="button" class="btn btn-info btn-minier" id='actualizar_alerta' style='display: none;' data-id='0'>{{ trans('alerts.update') }} <i class="glyphicon glyphicon-plus"></i></button>
                                    </div>

                                </form>
                                </div>
                                @if(count($alerts)>0)
                                    <table class="table table-striped table-bordered table-hover table-xtra-condensed" id="lista_alertas">
                                        <thead class="thin-border-bottom">
                                            <tr>
                                                <th>Mensaje</th>
                                                <th>Fecha envio</th>
                                                <th>Mail</th>
                                                <th>Dias</th>
                                                <th>
                                                    
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($alerts as $alert)
                                                <tr id='ln_alert{{$alert->id}}'>
                                                    <td>{{$alert->message}}</td>
                                                    <td>{{$alert->date_send}}</td>
                                                    <td>
                                                        @if($alert->mail_bnd==1)
                                                        SI
                                                        @else
                                                        NO
                                                        @endif
                                                    </td>
                                                    <td>{{$alert->day_before_sent}}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-warning btn-minier" id='editar_alerta' 
                                                                                                                 data-id='{{$alert->id}}' 
                                                                                                                 data-message='{{$alert->message}}'
                                                                                                                 data-date_send='{{$alert->date_send}}'
                                                                                                                 data-mail_bnd='{{$alert->mail_bnd}}'
                                                                                                                 data-day_before_sent='{{$alert->day_before_sent}}'>
                                                        {{ trans('alerts.edit') }} <i class="glyphicon glyphicon-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-minier" id='borrar_alerta' data-id='{{$alert->id}}'>{{ trans('alerts.delete') }} <i class="glyphicon glyphicon-trash"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                            
                            <div id="notas" class="tab-pane no-padding">
                                <div class="no-padding panel-body">
<!--                                <div class="row col-md-12" id='loading3' style='display: none'>
                                    <h3>Actualizando... Por Favor Espere.</h3>
                                    <div class="progress progress-striped active page-progress-bar">
                                        <div class="progress-bar" style="width: 100%;"></div>
                                    </div>
                                </div>    -->
                                @if ($errors->any())
                                    <ul class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                <form  accept-charset="UTF-8" id="create_note_form" name="create_note_form" class="">
                                {{ csrf_field() }}
                                @include ('notes.form', [
                                                            'note' => null,
                                                            'oportunity_id'=>$oportunity->id
                                                          ])

                                    <div class="form-group col-md-2">
                                        
                                            <button type="button" class="btn btn-success btn-minier" id='guardar_nota'>{{ trans('notes.add') }} <i class="glyphicon glyphicon-plus"></i></button>
                                            <button type="button" class="btn btn-info btn-minier" id='actualizar_nota' style='display: none;' data-id='0'>{{ trans('notes.update') }} <i class="glyphicon glyphicon-plus"></i></button>
                                        
                                    </div>

                                </form>
                                </div>
                                @if(count($notes)>0)
                                    <table class="table table-striped table-bordered table-hover table-xtra-condensed" id="lista_notas">
                                        <thead class="thin-border-bottom">
                                            <tr>
                                                <th>Nota</th>
                                                <th>
                                                    Creado
                                                </th>
                                                <th>
                                                    
                                                </th>
                                            </tr>
                                        </thead>
                                            @foreach($notes as $note)
                                                <tr id='ln_nota{{$note->id}}'>
                                                    <td>{{$note->note}}</td>
                                                    <td>{{$note->created_at." / ".$oportunity->usu_mod->name}}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-warning btn-minier" id='editar_nota' 
                                                                                                                 data-id='{{$note->id}}' 
                                                                                                                 data-note='{{$note->note}}'>
                                                        {{ trans('notes.edit') }} <i class="glyphicon glyphicon-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-minier" id='borrar_nota' data-id='{{$note->id}}'>{{ trans('notes.delete') }} <i class="glyphicon glyphicon-trash"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        <tbody>

                                        </tbody>
                                    </table>
                                @endif
                            </div>
                            
                            <div id="tareas" class="tab-pane">
                                <div class="panel-body">
<!--                                    <div class="row col-md-12" id='loading3' class='loading' style='display: none'>
                                        <h3>Actualizando... Por Favor Espere.</h3>
                                        <div class="progress progress-striped active page-progress-bar">
                                            <div class="progress-bar" style="width: 100%;"></div>
                                        </div>
                                    </div>  -->
                                    @if ($errors->any())
                                        <ul class="alert alert-danger">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    <form method="POST" action="{{ route('related_tasks.related_task.store') }}" accept-charset="UTF-8" id="create_related_task_form" name="create_related_task_form" class="">
                                    {{ csrf_field() }}
                                    @include ('related_tasks.form', [
                                                                'relatedTask' => null,
                                                                'oportunity_id' => $oportunity->id,
                                                                'tasks' => $tasks
                                                              ])
                                        <div class="form-group col-md-6 {{ $errors->has('activo') ? 'has-error' : '' }}">                        
                                            
                                                <button type="button" class="btn btn-success btn-minier" id='guardar_related_task'>{{ trans('related_tasks.add') }} <i class="glyphicon glyphicon-plus"></i></button>
                                                <button type="button" class="btn btn-info btn-minier" id='actualizar_related_task' style='display: none;' data-id='0'>{{ trans('related_tasks.update') }} <i class="glyphicon glyphicon-plus"></i></button>
                                            
                                        </div>

                                    </form>
                                </div>
                                @if(count($related_tasks)>0)
                                    <table class="table table-striped table-bordered table-hover table-xtra-condensed" id="lista_related_task">
                                        <thead class="thin-border-bottom">
                                            <tr>
                                                <th>Tarea</th>
                                                <th>Detalle</th>
                                                <th>Fecha</th>
                                                <th>Abierta</th>
                                                <th>
                                                    
                                                </th>
                                            </tr>
                                        </thead>
                                            @foreach($related_tasks as $task)
                                                <tr id='ln_related_task{{$task->id}}'>
                                                    <td>{{$task->task->task}}</td>
                                                    <td>{{$task->detail}}</td>
                                                    <td>{{$task->fecha}}</td>
                                                    <td>
                                                        @if($task->activo==0)
                                                            NO
                                                        @else
                                                            SI
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-warning btn-minier" data-toggle="tooltip" title="{{ trans('related_tasks.edit') }}" id='editar_related_task' 
                                                                                                                 data-id='{{$task->id}}' 
                                                                                                                 data-task_id='{{$task->task_id}}'
                                                                                                                 data-detail='{{$task->detail}}'
                                                                                                                 data-fecha='{{$task->fecha}}'
                                                                                                                 data-activo='{{$task->activo}}'>
                                                        <i class="glyphicon glyphicon-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-info btn-minier" data-toggle="tooltip" title="Cerrar" id='cerrar_related_task' 
                                                                                                                 data-id='{{$task->id}}' 
                                                                                                                 data-task_id='{{$task->task_id}}'
                                                                                                                 data-detail='{{$task->detail}}'
                                                                                                                 data-fecha='{{$task->fecha}}'
                                                                                                                 data-activo='{{$task->activo}}'>
                                                        <i class="glyphicon glyphicon-remove"></i></button>
                                                        <button type="button" class="btn btn-danger btn-minier" id='cerrar_related_task'data-toggle="tooltip" title="{{ trans('related_tasks.delete') }}" data-id='{{$task->id}}'> <i class="glyphicon glyphicon-trash"></i></button>
                                                        
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        <tbody>

                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="col-sm-12 col-md-12 col-xs-12 widget-container-col ui-sortable" id="widget-container-col-10">
        <div class="widget-main padding-6">
            <div class="page-header">
                <h3>
                    Historia de eventos
                </h3>
            </div>
            <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                <div class="timeline-container">
                    <div class="timeline-label">
                        <span class="label label-primary arrowed-in-right label-lg">
                            <b>Today</b>
                        </span>
                    </div>

                    <div class="timeline-items">
                        <div class="timeline-item clearfix">
                            <div class="timeline-info">
                                <span class="label label-info label-sm">16:22</span>
                            </div>

                            <div class="widget-box transparent">
                                <div class="widget-header widget-header-small">
                                    <h5 class="widget-title smaller">
                                        <a href="#" class="blue">Susan</a>
                                        <span class="grey">reviewed a product</span>
                                    </h5>

                                    <span class="widget-toolbar no-border">
                                        <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                        16:22
                                    </span>

                                    <span class="widget-toolbar">
                                        <a href="#" data-action="collapse">
                                            <i class="ace-icon fa fa-chevron-up"></i>
                                        </a>
                                    </span>
                                </div>

                                <div class="widget-body">
                                    <div class="widget-main">
                                        Anim pariatur cliche reprehenderit, enim eiusmod
                                        <span class="red">high life</span>

                                        accusamus terry richardson ad squid …
                                        <div class="space-6"></div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="timeline-item clearfix">
                            <div class="timeline-info">
                                <i class="timeline-indicator ace-icon fa fa-clock-o btn btn-success hover"></i>
                            </div>

                            
                        </div>

                    </div><!-- /.timeline-items -->
                </div><!-- /.timeline-container -->

            </div>
        </div>
    </div>
</div>

<!--Modal change customer-->
<div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body no-padding">
                    <form class="" role="form">
                        <div class="form-group col-md-6 @if($errors->has('caja_concepto_id')) has-error @endif">
                            {!! Form::text("razon", null, array("class" => "form-control form-control-sm", "id" => "razon-buscar", 'placeholder'=>'Razón Social')) !!}
                        </div>
                        <div class="form-group col-md-6 @if($errors->has('caja_concepto_id')) has-error @endif">
                            {!! Form::text("nombre1", null, array("class" => "form-control form-control-sm", "id" => "nombre1-buscar", 'placeholder'=>'Primer Nombre')) !!}
                        </div>
                        <div class="form-group col-md-6 @if($errors->has('caja_concepto_id')) has-error @endif">
                            {!! Form::text("nombre2", null, array("class" => "form-control form-control-sm", "id" => "nombre2-buscar", 'placeholder'=>'Segundo Nombre')) !!}
                        </div>
                        <div class="form-group col-md-6 @if($errors->has('caja_concepto_id')) has-error @endif">
                            {!! Form::text("ape_paterno", null, array("class" => "form-control form-control-sm", "id" => "ape_paterno-buscar", 'placeholder'=>'A. Paterno')) !!}
                        </div>
                        <div class="form-group col-md-6 @if($errors->has('caja_concepto_id')) has-error @endif">
                            {!! Form::text("ape_materno", null, array("class" => "form-control form-control-sm", "id" => "ape_materno-buscar", 'placeholder'=>'A. Materno')) !!}
                         </div>
                        <div class="form-group col-md-6 @if($errors->has('caja_concepto_id')) has-error @endif">
                            <button type="button" class="btn btn-info btn-minier" id='buscar_cliente'>Buscar <i class="glyphicon glyphicon-search"></i>
                        </div>
                    </form>
                    <table class="table table-striped table-bordered table-hover" id="resultado_busqueda">
                        <thead class="thin-border-bottom">
                            <tr>
                                <th>Seleccionar</th>
                                <th>
                                    Razón Social
                                </th>
                                <th>
                                    Nombre
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            
                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning btn-minier" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove' ></span> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--Fin Modal change customer-->

<!--Modal change customer-->
<div id="editModalProducto" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body no-padding">
                    <form class="" role="form">
                        <div class="form-group col-md-6" >
                            {!! Form::text("producto", null, array("class" => "form-control form-control-sm", "id" => "producto-buscar", 'placeholder'=>'Producto')) !!}
                        </div>
                        <div class="form-group col-md-6" >
                            <button type="button" class="btn btn-info btn-minier" id='buscar_producto'>Buscar <i class="glyphicon glyphicon-search"></i>
                        </div>
                    </form>
                    <table class="table table-striped table-bordered table-hover" id="resultado_busqueda_productos">
                        <thead class="thin-border-bottom">
                            <tr>
                                <th>Seleccionar</th>
                                <th>
                                    Producto
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            
                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning btn-minier" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove' ></span> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Delete note -->
    <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <h3 class="text-center">¿Estas seguro de borrar el registro?</h3>
                    <br />
                    <form class="form-horizontal" role="form">
                    
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger delete" data-dismiss="modal">
                            <span id="" class='glyphicon glyphicon-trash'></span> Borrar
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Delete related_task -->
    <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <h3 class="text-center">¿Estas seguro de borrar el registro?</h3>
                    <br />
                    <form class="form-horizontal" role="form">
                    
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="borrar_related_task" data-dismiss="modal">
                            <span id="" class='glyphicon glyphicon-trash'></span> Borrar
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<link rel="stylesheet" href="{{ asset('/ace-master/assets/css/bootstrap3-wysihtml5.min.css')}}">
<script src="{{ asset ('/ace-master/assets/js/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script src="{{ asset ('/ace-master/assets/js/bootstrap-wysihtml5.es-ES.js') }}"></script>
<script>
    $('#fecha').datetimepicker({
    //format: 'MM/DD/YYYY h:mm:ss A',//use this option to display seconds
    //locale: 'es',
    icons: {
           time: 'fa fa-clock-o',
           date: 'fa fa-calendar',
           up: 'fa fa-chevron-up',
           down: 'fa fa-chevron-down',
           previous: 'fa fa-chevron-left',
           next: 'fa fa-chevron-right',
           today: 'fa fa-arrows ',
           clear: 'fa fa-trash',
           close: 'fa fa-times'
    }
   }).next().on(ace.click_event, function(){
           $(this).prev().focus();
   });
   
   $('#date_send').datetimepicker({
    //format: 'MM/DD/YYYY h:mm:ss A',//use this option to display seconds
    //locale: 'es',
    icons: {
           time: 'fa fa-clock-o',
           date: 'fa fa-calendar',
           up: 'fa fa-chevron-up',
           down: 'fa fa-chevron-down',
           previous: 'fa fa-chevron-left',
           next: 'fa fa-chevron-right',
           today: 'fa fa-arrows ',
           clear: 'fa fa-trash',
           close: 'fa fa-times'
    }
   }).next().on(ace.click_event, function(){
           $(this).prev().focus();
   });
   
   
   
    function activareditor() {
        $("#contenido_mail").wysihtml5({
            toolbar: {
                "font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
                "emphasis": true, //Italics, bold, etc. Default true
                "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
                "html": false, //Button which allows you to edit the generated HTML. Default false
                "link": true, //Button to insert a link. Default true
                "image": true, //Button to insert an image. Default true,
                "color": false, //Button to change color of font  
                "blockquote": true, //Blockquote  
                "size": "xs", //default: none, other options are xs, sm, lg
                "fa": true,
                "locale": "es-ES"
              }
        });
    }
    ;
    activareditor();
    // Edit Customer
    $(document).on('click', '.edit-modal', function() {
        $('.modal-title').text('Seleccionar Cliente');
        $('#nombre1-buscar').val("");
        $('#nombre2-buscar').val("");
        $('#ape_paterno-buscar').val("");
        $('#ape_materno-buscar').val("");
        $('#razon-buscar').val("");
        $('.linea').remove();
        
        $('#editModal').modal('show');
    });
    
    $(document).on('click', '#buscar_cliente', function(){
        $.ajax({
            type: 'POST',
            url: "{{route('customers.oportunity.change')}}",
            data: {
                '_token': $('input[name=_token]').val(),
                'nombre1': $('#nombre1-buscar').val(),
                'nombre2': $('#nombre2-buscar').val(),
                'ape_paterno': $('#ape_paterno-buscar').val(),
                'ape_materno': $('#ape_materno-buscar').val(),
                'razon': $('#razon-buscar').val()
            },
            beforeSend : function(){$("#loading3").show(); },
            complete : function(){$("#loading3").hide(); },
            success: function(data) { 
                $('.linea').remove();
                $.each(data, function (i) {
                    $('#resultado_busqueda').append("<tr class='linea'><td> <button id='seleccionar_cliente' type='button' data-cliente='" + data[i].id + 
                                                                            "' data-oportunidad='"+{{$oportunity->id}} +
                                                                            "'> Seleccionar </button> </td><td>" + 
                                                  (data[i].razon_social?data[i].razon_social:"") + 
                                    "</td><td>" + (data[i].nombre1?data[i].nombre1:"") + " " + 
                                                  (data[i].nombre2?data[i].nombre2:"") + " " +
                                                  (data[i].ape_paterno?data[i].ape_paterno:"") + " " +
                                                  (data[i].ape_materno?data[i].ape_materno:"") + "</td>"); 
                                    
                });
                
            }
        });
    });
    
    $(document).on('click', '#seleccionar_cliente', function(){
        $.ajax({
            type: 'GET',
            url: "{{route('oportunities.oportunity.seleccionarCliente')}}",
            data: {
                'cliente': $(this).data('cliente'),
                'oportunidad': $(this).data('oportunidad')
            },
            beforeSend : function(){$("#loading3").show(); },
            complete : function(){$("#loading3").hide(); },
            success: function(data) { 
                location.reload();
            }
        });
    });
    
    // Edit a product
    $(document).on('click', '.edit-modal-producto', function() {
        $('.modal-title').text('Seleccionar Producto');
        $('#producto-buscar').val("");
        $('.linea').remove();
        
        $('#editModalProducto').modal('show');
    });
    
    $(document).on('click', '#buscar_producto', function(){
        //alert($('#producto-buscar').val());
        $.ajax({
            type: 'POST',
            url: "{{route('products.oportunity.change')}}",
            data: {
                '_token': $('input[name=_token]').val(),
                'producto': $('#producto-buscar').val()
            },
            beforeSend : function(){$("#loading3").show(); },
            complete : function(){$("#loading3").hide(); },
            success: function(data) { 
                $('.linea').remove();
                $.each(data, function (i) {
                    $('#resultado_busqueda_productos').append("<tr class='linea'><td> <button id='seleccionar_producto' type='button' data-producto='" + data[i].id + 
                                                                            "' data-oportunidad='"+{{$oportunity->id}} +
                                                                            "'> Seleccionar </button> </td><td>" + 
                                                  (data[i].producto?data[i].producto:"") + "</td>"); 
                                    
                });
                
            }
        });
    });
    
    $(document).on('click', '#seleccionar_producto', function(){
        $.ajax({
            type: 'GET',
            url: "{{route('oportunities.oportunity.seleccionarProducto')}}",
            data: {
                'producto': $(this).data('producto'),
                'oportunidad': $(this).data('oportunidad')
            },
            beforeSend : function(){$("#loading3").show(); },
            complete : function(){$("#loading3").hide(); },
            success: function(data) { 
                location.reload();
            }
        });
    });
    
    //crear nota
    $(document).on('click', '#guardar_nota', function(){
        //alert($('#producto-buscar').val());
        $.ajax({
            type: 'POST',
            url: "{{route('notes.note.store')}}",
            data: {
                '_token': $('input[name=_token]').val(),
                'oportunity_id':{{$oportunity->id}},
                'note': $('#note').val()
            },
            beforeSend : function(){$("#loading3").show(); },
            complete : function(){$("#loading3").hide(); },
            success: function(data) { 
                toastr.success('Operacion realizada', 'Mensaje', {timeOut: 5000});
                $('#lista_notas').prepend("<tr id='ln_nota"+ data.id +"'><td>" + 
                                        data.note + "</td><td>" + data.created_at + 
                                        "</td><td> <button type='button' class='btn btn-warning btn-minier' id='editar_nota' data-id='" + data.id + 
                                        "' data-note='"+ data.note +
                                        "'> "+"{{ trans('notes.edit') }}"+
                                        " <i class='glyphicon glyphicon-edit'></i> </button> <button type='button' class='btn btn-danger btn-minier' id='borrar_nota' data-id='"+
                                        data.id + "'>"+"{{ trans('notes.delete') }}"+"<i class='glyphicon glyphicon-trash'></i></button> </td>"); 
                $('#note').val("");                    
                
                
            }
        });
    });
    
    //editar nota
    $(document).on('click', '#editar_nota', function(){
        //alert($(this).data('id'));
        $('#note').val($(this).data('note'));
        $('#actualizar_nota').attr('data-id', $(this).data('id'))
        $('#actualizar_nota').show();
        $('#guardar_nota').hide();
    });
    
    $(document).on('click', '#actualizar_nota', function(){
        //alert($('#producto-buscar').val());
        $.ajax({
            type: 'POST',
            url: "{{ url('notes/note/').'/' }}"+$(this).data('id'),
            data: {
                '_token': $('input[name=_token]').val(),
                'oportunity_id':{{$oportunity->id}},
                'note': $('#note').val()
            },
            beforeSend : function(){$("#loading3").show(); },
            complete : function(){$("#loading3").hide(); },
            success: function(data) { 
                toastr.success('Operacion realizada', 'Mensaje', {timeOut: 5000});
                $('#ln_nota' + data.id).replaceWith("<tr id='ln_nota"+data.id+"'><td>" + 
                                        data.note + "</td><td>" + data.created_at + 
                                        "</td><td> <button type='button' class='btn btn-warning btn-minier' id='editar_nota' data-id='" + data.id + 
                                        "' data-note='"+ data.note +
                                        "'> "+ "{{ trans('notes.edit') }}" +
                                        " <i class='glyphicon glyphicon-edit'></i> </button> <button type='button' class='btn btn-danger btn-minier' id='borrar_nota' data-id='"+
                                        data.id + "'>"+ "{{ trans('notes.delete') }}"+"<i class='glyphicon glyphicon-trash'></i></button> </td>"); 
                                
                $('#actualizar_nota').hide();
                $('#guardar_nota').show();
                $('#note').val("");
                
            }
        });
    });
    
    // delete a note
        $(document).on('click', '#borrar_related_task', function() {
            $('.modal-title').text('Borrar');
            $('#deleteModal').modal('show');
            id = $(this).data('id');
        });
        
        $('.modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'DELETE',
                url: "{{url('related_tasks/related_task/')}}" + "/" + id,
                data: {
                    '_token': $('input[name=_token]').val()
                },
                beforeSend : function(){$("#loading3").show(); },
                complete : function(){$("#loading3").hide(); },
                success: function(data) {
                    toastr.success('Operacion realizada', 'Mensaje', {timeOut: 5000});
                    $('#ln_related_task' + data.id).remove();
                    
                }
            });
        });
    
    //crear task
    $(document).on('click', '#guardar_related_task', function(){
        //alert($('#producto-buscar').val());
        
        $.ajax({
            type: 'POST',
            url: "{{route('related_tasks.related_task.store')}}",
            data: {
                '_token': $('input[name=_token]').val(),
                'oportunity_id':{{$oportunity->id}},
                'task_id':$('#task_id option:selected').val(),
                'detail':$('#detail').val(),
                'fecha':$('#fecha').val(),
                'activo': 1
            },
            beforeSend : function(){$("#loading3").show(); },
            complete : function(){$("#loading3").hide(); },
            success: function(data) { 
                toastr.success('Operacion realizada', 'Mensaje', {timeOut: 5000});
                var activo="NO";
                if(data.activo==1){
                    activo="SI";
                }
                $('#lista_related_task').prepend("<tr id='ln_related_task"+ data.id +"'><td>" + 
                                        $('#task_id option:selected').text() + "</td><td>" + data.detail + "</td><td>" + data.fecha + "</td><td>" + activo + 
                                        "</td><td> <button type='button' class='btn btn-warning btn-minier' id='editar_related_task' data-toggle='tooltip' title='"+"{{ trans('related_tasks.edit') }}"+"' data-id='" + data.id + 
                                        "' data-task_id='"+ data.task_id + "' data-detail='"+ data.detail + "' data-fecha='"+ data.fecha + "' data-activo='"+ data.activo +
                                        "'> "+
                                        " <i class='glyphicon glyphicon-edit'></i> </button> <button type='button' class='btn btn-info btn-minier' id='cerrar_related_task' data-toggle='tooltip' title='Cerrar' data-id='" + data.id + 
                                        "' data-task_id='"+ data.task_id + "' data-detail='"+ data.detail + "' data-fecha='"+ data.fecha + "' data-activo='"+ data.activo +
                                        "'> "+
                                        " <i class='glyphicon glyphicon-remove'></i> </button> <button type='button' class='btn btn-danger btn-minier' id='borrar_related_task' data-toggle='tooltip' title='"+"{{ trans('related_tasks.delete') }}"+"' data-id='"+
                                        data.id + "'><i class='glyphicon glyphicon-trash'></i></button> </td>");
                $('#task_id option[value=1]').attr('selected','selected').change(); 
                $('#detail').val("");
                $('#fecha').val("");
                
            }
        });
    });
    
    //editar task
    $(document).on('click', '#editar_related_task', function(){
        
        $('#task_id').val($(this).data('task_id'));
        $('#detail').val($(this).data('detail'));
        $('#fecha').val($(this).data('fecha'));
        $('#actualizar_related_task').attr('data-id', $(this).data('id'))
        $('#actualizar_related_task').show();
        $('#guardar_related_task').hide();
        if($(this).data('activo')==true){
            activo = 1;
        }else{
            activo = 0;
        }
        
    });
    
    $(document).on('click', '#actualizar_related_task', function(){
        //alert($('#producto-buscar').val());
        $.ajax({
            type: 'PUT',
            url: "{{ url('related_tasks/related_task/').'/' }}"+$(this).data('id'),
            data: {
                '_token': $('input[name=_token]').val(),
                'oportunity_id':{{$oportunity->id}},
                'task_id':$('#task_id option:selected').val(),
                'detail':$('#detail').val(),
                'fecha':$('#fecha').val(),
                'activo':activo
            },
            beforeSend : function(){$(".loading").show(); },
            complete : function(){$(".loading").hide(); },
            success: function(data) {
                
                toastr.success('Operacion realizada', 'Mensaje', {timeOut: 5000});
                var activo="NO";
                if(data.activo==1){
                    activo="SI";
                }
                $('#ln_related_task' + data.id).replaceWith("<tr id='ln_related_task"+ data.id +"'><td>" + 
                                        $('#task_id option:selected').text() + "</td><td>" + data.detail + "</td><td>" + data.fecha + "</td><td>" + activo + 
                                        "</td><td> <button type='button' class='btn btn-warning btn-minier' id='editar_related_task' data-toggle='tooltip' title='"+"{{ trans('related_tasks.edit') }}"+"' data-id='" + data.id + 
                                        "' data-task_id='"+ data.task_id + "' data-detail='"+ data.detail + "' data-fecha='"+ data.fecha + "' data-activo='"+ data.activo +
                                        "'> "+
                                        " <i class='glyphicon glyphicon-edit'></i> </button> <button type='button' class='btn btn-info btn-minier' id='cerrar_related_task' data-toggle='tooltip' title='Cerrar' data-id='" + data.id + 
                                        "' data-task_id='"+ data.task_id + "' data-detail='"+ data.detail + "' data-fecha='"+ data.fecha + "' data-activo='"+ data.activo +
                                        "'> "+
                                        " <i class='glyphicon glyphicon-remove'></i> </button> <button type='button' class='btn btn-danger btn-minier' id='borrar_related_task' data-toggle='tooltip' title='"+"{{ trans('related_tasks.delete') }}"+"' data-id='"+
                                        data.id + "'><i class='glyphicon glyphicon-trash'></i></button> </td>");
                                
                $('#actualizar_related_task').hide();
                $('#guardar_related_task').show();
                $('#task_id option[value=1]').attr('selected','selected').change(); 
                $('#detail').val("");
                $('#fecha').val("");
            }
        });
    });
    
    //Cerrar related_task
    $(document).on('click', '#cerrar_related_task', function(){
        //alert($('#producto-buscar').val());
        $.ajax({
            type: 'PUT',
            url: "{{ url('related_tasks/related_task/').'/' }}"+$(this).data('id'),
            data: {
                '_token': $('input[name=_token]').val(),
                'oportunity_id':{{$oportunity->id}},
                'task_id':$(this).data('task_id'),
                'detail':$(this).data('detail'),
                'fecha':$(this).data('fecha'),
            },
            beforeSend : function(){$(".loading").show(); },
            complete : function(){$(".loading").hide(); },
            success: function(data) {
                
                toastr.success('Operacion realizada', 'Mensaje', {timeOut: 5000});
                var activo="NO";
                if(data.activo==1){
                    activo="SI";
                }
                $('#ln_related_task' + data.id).replaceWith("<tr id='ln_related_task"+ data.id +"'><td>" + 
                                        $('#task_id option:selected').text() + "</td><td>" + data.detail + "</td><td>" + data.fecha + "</td><td>" + activo + 
                                        "</td><td> <button type='button' class='btn btn-warning btn-minier' id='editar_related_task' data-toggle='tooltip' title='"+"{{ trans('related_tasks.edit') }}"+"' data-id='" + data.id + 
                                        "' data-task_id='"+ data.task_id + "' data-detail='"+ data.detail + "' data-fecha='"+ data.fecha + "' data-activo='"+ data.activo +
                                        "'> "+
                                        " <i class='glyphicon glyphicon-edit'></i> </button> <button type='button' class='btn btn-info btn-minier' id='cerrar_related_task' data-toggle='tooltip' title='Cerrar' data-id='" + data.id + 
                                        "' data-task_id='"+ data.task_id + "' data-detail='"+ data.detail + "' data-fecha='"+ data.fecha + "' data-activo='"+ data.activo +
                                        "'> "+
                                        " <i class='glyphicon glyphicon-remove'></i> </button> <button type='button' class='btn btn-danger btn-minier' id='borrar_related_task' data-toggle='tooltip' title='"+"{{ trans('related_tasks.delete') }}"+"' data-id='"+
                                        data.id + "'><i class='glyphicon glyphicon-trash'></i></button> </td>"); 
                                
                $('#actualizar_related_task').hide();
                $('#guardar_related_task').show();
                $('#task_id option[value=1]').attr('selected','selected').change(); 
                $('#detail').val("");
                $('#fecha').val("");
            }
        });
    });
    
    // delete a task
        $(document).on('click', '#borrar_related_task', function() {
            $('.modal-title').text('Borrar');
            $('#deleteModal').modal('show');
            id = $(this).data('id');
        });
        
        $('.modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'DELETE',
                url: "{{ url('related_tasks/related_task/') }}" + "/" + id,
                data: {
                    '_token': $('input[name=_token]').val()
                },
                beforeSend : function(){$("#loading3").show(); },
                complete : function(){$("#loading3").hide(); },
                success: function(data) {
                    toastr.success('Operacion realizada', 'Mensaje', {timeOut: 5000});
                    $('#ln_related_task' + data.id).remove();
                    
                }
            });
        });
        
        
    //crear alert
    $(document).on('click', '#guardar_alerta', function(){
        //alert($('#producto-buscar').val());
        
        
        if ($('input#mail_bnd_1').is(':checked')) {
            datos={
                '_token': $('input[name=_token]').val(),
                'oportunity_id':{{$oportunity->id}},
                'message':$('#message').val(),
                'date_send':$('#date_send').val(),
                'mail_bnd': 1,
                'day_before_sent': $('#day_before_sent').val(),
            };
        }else{
            datos={
                '_token': $('input[name=_token]').val(),
                'oportunity_id':{{$oportunity->id}},
                'message':$('#message').val(),
                'date_send':$('#date_send').val(),
                'day_before_sent': $('#day_before_sent').val(),
            };
        }
        
        $.ajax({
            type: 'POST',
            url: "{{route('alerts.alert.store')}}",
            data: datos,
            beforeSend : function(){$("#loading3").show(); },
            complete : function(){$("#loading3").hide(); },
            success: function(data) {
                
                toastr.success('Operacion realizada', 'Mensaje', {timeOut: 5000});
                var mail_bnd="NO";
                if(data.mail_bnd==true){
                    mail_bnd="SI";
                }
                
                /*$('#lista_alertas').prepend("<tr id='ln_alert" + data.id + "'>" +
                                                    "<td>" + data.message + "</td>" +
                                                    "<td>" + data.date_send + "</td>" +
                                                    "<td>" + mail_bnd + "</td>" +
                                                    "<td>" + data.day_before_sent + "</td>" +
                                                    "<td>" +
                                                        "<button type='button' class='btn btn-warning btn-minier' id='editar_alerta' " +
                                                                                        "data-id='" + data.id + "' " + 
                                                                                        "data-message='"+ data.message + "' " +
                                                                                        "data-date_send='" + data.date_send + "' " +
                                                                                        "data-mail_bnd='" + data.mail_bnd + "' " +
                                                                                        "data-day_before_sent='" + data.day_before_sent + "'>" +
                                                        "{{ trans('alerts.edit') }} <i class='glyphicon glyphicon-edit'></i>" +
                                                        "</button>" +
                                                        "<button type='button' class='btn btn-danger btn-minier' id='borrar_alerta' data-id='"+ data.id +
                                                        "'>{{ trans('alerts.delete') }} <i class='glyphicon glyphicon-trash'></i></button>" +
                                                    "</td>" +
                                                "</tr>");
                  */
                
                $('#lista_alertas').prepend("<tr id='ln_alert" + data.id + "'>" +
                                                    "<td>" + data.message + "</td>" +
                                                    "<td>" + data.date_send + "</td>" +
                                                    "<td>" + mail_bnd + "</td>" +
                                                    "<td>" + data.day_before_sent + "</td>" +
                                                    "<td>" +
                                                        "<button type='button' class='btn btn-warning btn-minier' id='editar_alerta' " +
                                                                                        "data-id='" + data.id + "' " + 
                                                                                        "data-message='"+ data.message + "' " +
                                                                                        "data-date_send='" + data.date_send + "' " +
                                                                                        "data-mail_bnd='" + data.mail_bnd + "' " +
                                                                                        "data-day_before_sent='" + data.day_before_sent + "'>" +
                                                        "{{ trans('alerts.edit') }} <i class='glyphicon glyphicon-edit'></i>" +
                                                        "</button>" +
                                                        "<button type='button' class='btn btn-danger btn-minier' id='borrar_alerta' data-id='"+ data.id +
                                                        "'>{{ trans('alerts.delete') }} <i class='glyphicon glyphicon-trash'></i></button>" +
                                                    "</td>" +
                                                "</tr>")
                $('#message').val("");
                $('#date_send').val("");
                $('#mail_bnd_1').prop('checked', false).change();
                $('#day_before_sent').val("");
                $('#actualizar_alerta').hide();
                $('#guardar_alerta').show();
                
            }
        });
    });
    
    //editar alerta
    $(document).on('click', '#editar_alerta', function(){
        $('#message').val($(this).data('message'));
        $('#day_before_sent').val($(this).data('day_before_sent'));
        $('#date_send').val($(this).data('date_send'));
        $('#actualizar_alerta').attr('data-id', $(this).data('id'))
        $('#actualizar_alerta').show();
        $('#guardar_alerta').hide();
        //alert($(this).data('mail_bnd'));
        if($(this).data('mail_bnd')==1){
            $('#mail_bnd_1').prop('checked', true).change();
        }else{
            
            $('#mail_bnd_1').prop('checked', false).change();
        }
        
    });
    
    $(document).on('click', '#actualizar_alerta', function(){
        
        if ($('input#mail_bnd_1').is(':checked')) {
            datos={
                '_token': $('input[name=_token]').val(),
                'oportunity_id':{{$oportunity->id}},
                'message':$('#message').val(),
                'date_send':$('#date_send').val(),
                'mail_bnd': 1,
                'day_before_sent': $('#day_before_sent').val(),
            };
        }else{
            datos={
                '_token': $('input[name=_token]').val(),
                'oportunity_id':{{$oportunity->id}},
                'message':$('#message').val(),
                'date_send':$('#date_send').val(),
                'day_before_sent': $('#day_before_sent').val(),
            };
        }
        $.ajax({
            type: 'PUT',
            url: "{{ url('alerts/alert/').'/' }}"+$(this).data('id'),
            data: datos,
            beforeSend : function(){$(".loading").show(); },
            complete : function(){$(".loading").hide(); },
            success: function(data) {
                
                toastr.success('Operacion realizada', 'Mensaje', {timeOut: 5000});
                var mail_bnd="NO";
                if(data.mail_bnd==true){
                    mail_bnd="SI";
                }
                $('#ln_alert' + data.id).replaceWith("<tr id='ln_alert" + data.id + "'>" +
                                                    "<td>" + data.message + "</td>" +
                                                    "<td>" + data.date_send + "</td>" +
                                                    "<td>" + mail_bnd + "</td>" +
                                                    "<td>" + data.day_before_sent + "</td>" +
                                                    "<td>" +
                                                        "<button type='button' class='btn btn-warning btn-minier' id='editar_alerta' " +
                                                                                        "data-id='" + data.id + "' " + 
                                                                                        "data-message='"+ data.message + "' " +
                                                                                        "data-date_send='" + data.date_send + "' " +
                                                                                        "data-mail_bnd='" + data.mail_bnd + "' " +
                                                                                        "data-day_before_sent='" + data.day_before_sent + "'>" +
                                                        "{{ trans('alerts.edit') }} <i class='glyphicon glyphicon-edit'></i>" +
                                                        "</button>" +
                                                        "<button type='button' class='btn btn-danger btn-minier' id='borrar_alerta' data-id='"+ data.id +
                                                        "'>{{ trans('alerts.delete') }} <i class='glyphicon glyphicon-trash'></i></button>" +
                                                    "</td>" +
                                                "</tr>");
                                
                $('#message').val("");
                $('#date_send').val("");
                $('#mail_bnd_1').prop('checked', false).change();
                $('#day_before_sent').val("");
                $('#actualizar_alerta').hide();
                $('#guardar_alerta').show();
            }
        });
    });
    
    // delete a task
        $(document).on('click', '#borrar_alerta', function() {
            $('.modal-title').text('Borrar');
            $('#deleteModal').modal('show');
            id = $(this).data('id');
        });
        
        $('.modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'DELETE',
                url: "{{ url('alerts/alert/') }}" + "/" + id,
                data: {
                    '_token': $('input[name=_token]').val()
                },
                beforeSend : function(){$("#loading3").show(); },
                complete : function(){$("#loading3").hide(); },
                success: function(data) {
                    toastr.success('Operacion realizada', 'Mensaje', {timeOut: 5000});
                    $('#ln_alert' + data.id).remove();
                    
                }
            });
        });
        
    function irarriba() {
        $('html, body').animate({scrollTop: 0}, 300);
    }

    $(document).on("submit", ".formarchivo", function (e) {
        e.preventDefault();
        var formu = $(this);
        var nombreform = $(this).attr("id");
        var rs = false; //leccion 10
        var seccion_sel = $("#seccion_seleccionada").val();
        if (nombreform == "f_enviar_correo") {
                var miurl = "{{url('/oportunities/oportunity/enviarCorreo')}}";
            var divresul = "spinner_loading";
        }

        //informaciÃ³n del formulario
        var formData = new FormData($("#" + nombreform + "")[0]);

        //hacemos la peticiÃ³n ajax   
        $.ajax({
            url: miurl,
            type: 'POST',

            // Form data
            //datos del formulario
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function () {
                $("#" + divresul + "").html($("#loading3").html());
            },
            //una vez finalizado correctamente
            success: function (data) {
                $("#" + divresul + "").html(data);
                $("#fotografia_usuario").attr('src', $("#fotografia_usuario").attr('src') + '?' + Math.random());

                if (rs) {
                    $('#' + nombreform + '').trigger("reset");
                    mostrarseccion(seccion_sel);
                }
                $('#destinatario').val('');
                $('#nombre').val('');
                $('#asunto').val('');
                $('#file_hidden').val('');
                $('#file').val('');
                $('#contenido_mail').text('');
                
            },
            //si ha ocurrido un error
            error: function (data) {
                alert("ha ocurrido un error");

            }
        });

        irarriba();

    })

    $(document).on("change", ".email_archivo", function (e) {

        var miurl = "{{route('files_customers.files_customer.cargaArchivoCorreo')}}";
        // var fileup=$("#file").val();
        var divresul = "texto_notificacion";

        var data = new FormData();
        data.append('file', $('#file')[0].files[0]);
        data.append('oportunity', {{ $oportunity->id }});

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#_token').val()
            }
        });
        $.ajax({
            url: miurl,
            type: 'POST',

            // Form data
            //datos del formulario
            data: data,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function () {
                $("#" + divresul + "").html($("#cargador_empresa").html());
            },
            //una vez finalizado correctamente
            success: function (data) {
                var codigo = '<div class="mailbox-attachment-info"><a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>' + data + '</a><span class="mailbox-attachment-size"> </span></div>';
                $("#" + divresul + "").html(codigo);
                $('#file_hidden').val(data);    
            },
            //si ha ocurrido un error
            error: function (data) {
                $("#" + divresul + "").html(data);

            }
        });

    })
    
</script>
@endpush