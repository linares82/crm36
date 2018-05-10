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
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Customer' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('customers.customer.destroy', $customer->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('customers.customer.index')
                    <a href="{{ route('customers.customer.index') }}" class="btn btn-primary" title="{{ trans('customers.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('customers.customer.create')
                    
                    @endif
                    @ifUserCan('customers.customer.edit')
                    
                    @endif
                    @ifUserCan('customers.customer.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('customers.delete') }}" onclick="return confirm(&quot;{{ trans('customers.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('customers.oportunity_id') }}</dt>
            <dd>{{ optional($customer->oportunity)->descripcion }}</dd>
            <dt>{{ trans('customers.razon') }}</dt>
            <dd>{{ $customer->razon }}</dd>
            <dt>{{ trans('customers.nombre1') }}</dt>
            <dd>{{ $customer->nombre1 }}</dd>
            <dt>{{ trans('customers.nombre2') }}</dt>
            <dd>{{ $customer->nombre2 }}</dd>
            <dt>{{ trans('customers.ape_paterno') }}</dt>
            <dd>{{ $customer->ape_paterno }}</dd>
            <dt>{{ trans('customers.ape_materno') }}</dt>
            <dd>{{ $customer->ape_materno }}</dd>
            <dt>{{ trans('customers.calle') }}</dt>
            <dd>{{ $customer->calle }}</dd>
            <dt>{{ trans('customers.numero_int') }}</dt>
            <dd>{{ $customer->numero_int }}</dd>
            <dt>{{ trans('customers.numero_ext') }}</dt>
            <dd>{{ $customer->numero_ext }}</dd>
            <dt>{{ trans('customers.colonia') }}</dt>
            <dd>{{ $customer->colonia }}</dd>
            <dt>{{ trans('customers.ciudad') }}</dt>
            <dd>{{ $customer->ciudad }}</dd>
            <dt>{{ trans('customers.estado_id') }}</dt>
            <dd>{{ optional($customer->estado)->estado }}</dd>
            <dt>{{ trans('customers.municipio_id') }}</dt>
            <dd>{{ optional($customer->municipio)->estado }}</dd>
            <dt>{{ trans('customers.cp') }}</dt>
            <dd>{{ $customer->cp }}</dd>
            <dt>{{ trans('customers.celular') }}</dt>
            <dd>{{ $customer->celular }}</dd>
            <dt>{{ trans('customers.celular_confirmar') }}</dt>
            <dd>{{ ($customer->celular_confirmar) ? 'Yes' : 'No' }}</dd>
            <dt>{{ trans('customers.cuenta_sms') }}</dt>
            <dd>{{ $customer->cuenta_sms }}</dd>
            <dt>{{ trans('customers.fijo') }}</dt>
            <dd>{{ $customer->fijo }}</dd>
            <dt>{{ trans('customers.email') }}</dt>
            <dd>{{ $customer->email }}</dd>
            <dt>{{ trans('customers.cuenta_email') }}</dt>
            <dd>{{ $customer->cuenta_email }}</dd>
            <dt>{{ trans('customers.email_confirmar') }}</dt>
            <dd>{{ ($customer->email_confirmar) ? 'Yes' : 'No' }}</dd>
            <dt>{{ trans('customers.usu_alta_id') }}</dt>
            <dd>{{ optional($customer->user)->name }}</dd>
            <dt>{{ trans('customers.usu_mod_id') }}</dt>
            <dd>{{ optional($customer->user)->name }}</dd>
            <dt>{{ trans('customers.created_at') }}</dt>
            <dd>{{ $customer->created_at }}</dd>
            <dt>{{ trans('customers.updated_at') }}</dt>
            <dd>{{ $customer->updated_at }}</dd>
            <dt>{{ trans('customers.deleted_at') }}</dt>
            <dd>{{ $customer->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection