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
				<a href="{{ route('customers.customer.index') }}">{{ trans('customers.model_plural') }}</a>
			</li>
		</ul><!-- /.breadcrumb -->
	</div>

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif
	
    <div class="panel panel-default">

        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ trans('customers.model_plural') }}</h4>
            </div>
            
            @ifUserCan('customers.customer.create')
            <div class="btn-group btn-group-sm pull-right" role="group">
                
            </div>
            @endif
			<div class="btn-group btn-group-sm pull-right" role="group">
                <button id="search_btn" class="btn btn-warning btn-xs" title="Buscar">
					<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
				</button>
            </div>
			<div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('customers.customer.index') }}" class="btn btn-xs" title="Refrescar">
                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($customers) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('customers.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="row" >
				<div class="col-md-12">
					<form method="GET" action="{{ route('customers.customer.index') }}" id="search_form" name="search_form" accept-charset="UTF-8" class="">
						{{ csrf_field() }}
						<input name="_method" type="hidden" value="GET">
						<div class="form-group col-md-4 {{ $errors->has('slug') ? 'has-error' : '' }}">
							<label for="id" class="control-label">Id</label>
							<input class="form-control input-sm" name="id" type="text" id="slug" minlength="1" maxlength="255" placeholder="Capturar id ...">
						</div>
						<div class="form-group">
							<div class="col-md-offset-2 col-md-10">
								<input class="btn btn-info btn-app btn-xs" type="submit" value="Buscar">
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="table-responsive">

                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            
                            <th>{{ trans('customers.razon') }}</th>
                            <th>{{ trans('customers.nombre1') }}</th>
                            <th>{{ trans('customers.nombre2') }}</th>
                            <th>{{ trans('customers.ape_paterno') }}</th>
                            <th>{{ trans('customers.ape_materno') }}</th>
                            <th>{{ trans('customers.calle') }}</th>
                            <th>{{ trans('customers.numero_int') }}</th>
                            <th>{{ trans('customers.numero_ext') }}</th>
                            <th>{{ trans('customers.colonia') }}</th>
                            <th>{{ trans('customers.ciudad') }}</th>
                            <th>{{ trans('customers.estado_id') }}</th>
                            <th>{{ trans('customers.municipio_id') }}</th>
                            <th>{{ trans('customers.cp') }}</th>
                            <th>{{ trans('customers.celular') }}</th>
                            <th>{{ trans('customers.celular_confirmar') }}</th>
                            <th>{{ trans('customers.cuenta_sms') }}</th>
                            <th>{{ trans('customers.fijo') }}</th>
                            <th>{{ trans('customers.email') }}</th>
                            <th>{{ trans('customers.cuenta_email') }}</th>
                            <th>{{ trans('customers.email_confirmar') }}</th>
                            <th>{{ trans('customers.usu_alta_id') }}</th>
                            <th>{{ trans('customers.usu_mod_id') }}</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            
                            <td>{{ $customer->razon }}</td>
                            <td>{{ $customer->nombre1 }}</td>
                            <td>{{ $customer->nombre2 }}</td>
                            <td>{{ $customer->ape_paterno }}</td>
                            <td>{{ $customer->ape_materno }}</td>
                            <td>{{ $customer->calle }}</td>
                            <td>{{ $customer->numero_int }}</td>
                            <td>{{ $customer->numero_ext }}</td>
                            <td>{{ $customer->colonia }}</td>
                            <td>{{ $customer->ciudad }}</td>
                            <td>{{ optional($customer->estado)->estado }}</td>
                            <td>{{ optional($customer->municipio)->estado }}</td>
                            <td>{{ $customer->cp }}</td>
                            <td>{{ $customer->celular }}</td>
                            <td>{{ ($customer->celular_confirmar) ? 'Yes' : 'No' }}</td>
                            <td>{{ $customer->cuenta_sms }}</td>
                            <td>{{ $customer->fijo }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->cuenta_email }}</td>
                            <td>{{ ($customer->email_confirmar) ? 'Yes' : 'No' }}</td>
                            <td>{{ optional($customer->user)->name }}</td>
                            <td>{{ optional($customer->user)->name }}</td>

                            <td>

                                <form method="POST" action="{!! route('customers.customer.destroy', $customer->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        @ifUserCan('customers.customer.show')
                                        <a href="{{ route('customers.customer.show', $customer->id ) }}" class="btn btn-info btn-xs" title="{{ trans('customers.show') }}">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('customers.customer.edit')
                                        
                                        @endif
                                        @ifUserCan('customers.customer.destroy')
                                        <button type="submit" class="btn btn-danger btn-xs" title="{{ trans('customers.delete') }}" onclick="return confirm(&quot;{{ trans('customers.confirm_delete') }}&quot;)">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                        @endif
                                    </div>

                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="panel-footer">
            {!! $customers->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection