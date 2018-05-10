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
				<a href="{{ route('params.param.index') }}">{{ trans('params.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Param' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('params.param.destroy', $param->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('params.param.index')
                    <a href="{{ route('params.param.index') }}" class="btn btn-primary" title="{{ trans('params.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('params.param.create')
                    <a href="{{ route('params.param.create') }}" class="btn btn-success" title="{{ trans('params.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('params.param.edit')
                    <a href="{{ route('params.param.edit', $param->id ) }}" class="btn btn-primary" title="{{ trans('params.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('params.param.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('params.delete') }}" onclick="return confirm(&quot;{{ trans('params.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('params.key') }}</dt>
            <dd>{{ $param->key }}</dd>
            <dt>{{ trans('params.value') }}</dt>
            <dd>{{ $param->value }}</dd>
            <dt>{{ trans('params.usu_alta_id') }}</dt>
            <dd>{{ optional($param->user)->name }}</dd>
            <dt>{{ trans('params.usu_mod_id') }}</dt>
            <dd>{{ optional($param->user)->name }}</dd>
            <dt>{{ trans('params.created_at') }}</dt>
            <dd>{{ $param->created_at }}</dd>
            <dt>{{ trans('params.updated_at') }}</dt>
            <dd>{{ $param->updated_at }}</dd>
            <dt>{{ trans('params.deleted_at') }}</dt>
            <dd>{{ $param->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection