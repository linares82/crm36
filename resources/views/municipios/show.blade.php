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
				<a href="{{ route('municipios.municipio.index') }}">{{ trans('municipios.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Municipio' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('municipios.municipio.destroy', $municipio->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('municipios.municipio.index')
                    <a href="{{ route('municipios.municipio.index') }}" class="btn btn-primary" title="{{ trans('municipios.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('municipios.municipio.create')
                    <a href="{{ route('municipios.municipio.create') }}" class="btn btn-success" title="{{ trans('municipios.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('municipios.municipio.edit')
                    <a href="{{ route('municipios.municipio.edit', $municipio->id ) }}" class="btn btn-primary" title="{{ trans('municipios.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('municipios.municipio.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('municipios.delete') }}" onclick="return confirm(&quot;{{ trans('municipios.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('municipios.estado') }}</dt>
            <dd>{{ $municipio->estado }}</dd>
            <dt>{{ trans('municipios.usu_alta_id') }}</dt>
            <dd>{{ optional($municipio->user)->name }}</dd>
            <dt>{{ trans('municipios.usu_mod_id') }}</dt>
            <dd>{{ optional($municipio->user)->name }}</dd>
            <dt>{{ trans('municipios.created_at') }}</dt>
            <dd>{{ $municipio->created_at }}</dd>
            <dt>{{ trans('municipios.updated_at') }}</dt>
            <dd>{{ $municipio->updated_at }}</dd>
            <dt>{{ trans('municipios.deleted_at') }}</dt>
            <dd>{{ $municipio->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection