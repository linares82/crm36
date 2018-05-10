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
				<a href="{{ route('files_customers.files_customer.index') }}">{{ trans('files_customers.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Files Customer' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('files_customers.files_customer.destroy', $filesCustomer->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('files_customers.files_customer.index')
                    <a href="{{ route('files_customers.files_customer.index') }}" class="btn btn-primary" title="{{ trans('files_customers.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('files_customers.files_customer.create')
                    <a href="{{ route('files_customers.files_customer.create') }}" class="btn btn-success" title="{{ trans('files_customers.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('files_customers.files_customer.edit')
                    <a href="{{ route('files_customers.files_customer.edit', $filesCustomer->id ) }}" class="btn btn-primary" title="{{ trans('files_customers.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('files_customers.files_customer.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('files_customers.delete') }}" onclick="return confirm(&quot;{{ trans('files_customers.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('files_customers.oportunity_id') }}</dt>
            <dd>{{ optional($filesCustomer->oportunity)->descripcion }}</dd>
            <dt>{{ trans('files_customers.archivo') }}</dt>
            <dd>{{ $filesCustomer->archivo }}</dd>
            <dt>{{ trans('files_customers.nota') }}</dt>
            <dd>{{ $filesCustomer->nota }}</dd>
            <dt>{{ trans('files_customers.usu_alta_id') }}</dt>
            <dd>{{ optional($filesCustomer->user)->name }}</dd>
            <dt>{{ trans('files_customers.usu_mod_id') }}</dt>
            <dd>{{ optional($filesCustomer->user)->name }}</dd>
            <dt>{{ trans('files_customers.created_at') }}</dt>
            <dd>{{ $filesCustomer->created_at }}</dd>
            <dt>{{ trans('files_customers.updated_at') }}</dt>
            <dd>{{ $filesCustomer->updated_at }}</dd>
            <dt>{{ trans('files_customers.deleted_at') }}</dt>
            <dd>{{ $filesCustomer->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection