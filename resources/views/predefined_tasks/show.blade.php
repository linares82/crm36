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
				<a href="{{ route('predefined_tasks.predefined_task.index') }}">{{ trans('predefined_tasks.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Predefined Task' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('predefined_tasks.predefined_task.destroy', $predefinedTask->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('predefined_tasks.predefined_task.index')
                    <a href="{{ route('predefined_tasks.predefined_task.index') }}" class="btn btn-primary" title="{{ trans('predefined_tasks.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('predefined_tasks.predefined_task.create')
                    <a href="{{ route('predefined_tasks.predefined_task.create') }}" class="btn btn-success" title="{{ trans('predefined_tasks.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('predefined_tasks.predefined_task.edit')
                    <a href="{{ route('predefined_tasks.predefined_task.edit', $predefinedTask->id ) }}" class="btn btn-primary" title="{{ trans('predefined_tasks.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('predefined_tasks.predefined_task.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('predefined_tasks.delete') }}" onclick="return confirm(&quot;{{ trans('predefined_tasks.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('predefined_tasks.task_id') }}</dt>
            <dd>{{ optional($predefinedTask->task)->task }}</dd>
            <dt>{{ trans('predefined_tasks.detail') }}</dt>
            <dd>{{ $predefinedTask->detail }}</dd>
            <dt>{{ trans('predefined_tasks.activo') }}</dt>
            <dd>{{ ($predefinedTask->activo) ? 'Si' : 'No' }}</dd>
            <dt>{{ trans('predefined_tasks.usu_alta_id') }}</dt>
            <dd>{{ optional($predefinedTask->user)->name }}</dd>
            <dt>{{ trans('predefined_tasks.usu_mod_id') }}</dt>
            <dd>{{ optional($predefinedTask->user)->name }}</dd>
            <dt>{{ trans('predefined_tasks.created_at') }}</dt>
            <dd>{{ $predefinedTask->created_at }}</dd>
            <dt>{{ trans('predefined_tasks.updated_at') }}</dt>
            <dd>{{ $predefinedTask->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection