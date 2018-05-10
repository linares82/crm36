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
				<a href="{{ route('estados.estado.index') }}">{{ trans('estados.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Estado' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('estados.estado.destroy', $estado->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('estados.estado.index')
                    <a href="{{ route('estados.estado.index') }}" class="btn btn-primary" title="{{ trans('estados.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('estados.estado.create')
                    <a href="{{ route('estados.estado.create') }}" class="btn btn-success" title="{{ trans('estados.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('estados.estado.edit')
                    <a href="{{ route('estados.estado.edit', $estado->id ) }}" class="btn btn-primary" title="{{ trans('estados.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('estados.estado.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('estados.delete') }}" onclick="return confirm(&quot;{{ trans('estados.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('estados.estado') }}</dt>
            <dd>{{ $estado->estado }}</dd>
            <dt>{{ trans('estados.usu_alta_id') }}</dt>
            <dd>{{ optional($estado->user)->name }}</dd>
            <dt>{{ trans('estados.usu_mod_id') }}</dt>
            <dd>{{ optional($estado->user)->name }}</dd>
            <dt>{{ trans('estados.created_at') }}</dt>
            <dd>{{ $estado->created_at }}</dd>
            <dt>{{ trans('estados.updated_at') }}</dt>
            <dd>{{ $estado->updated_at }}</dd>
            <dt>{{ trans('estados.deleted_at') }}</dt>
            <dd>{{ $estado->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection