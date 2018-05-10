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
				<a href="{{ route('tasks.task.index') }}">{{ trans('tasks.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Task' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('tasks.task.destroy', $task->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('tasks.task.index')
                    <a href="{{ route('tasks.task.index') }}" class="btn btn-primary" title="{{ trans('tasks.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('tasks.task.create')
                    <a href="{{ route('tasks.task.create') }}" class="btn btn-success" title="{{ trans('tasks.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('tasks.task.edit')
                    <a href="{{ route('tasks.task.edit', $task->id ) }}" class="btn btn-primary" title="{{ trans('tasks.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('tasks.task.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('tasks.delete') }}" onclick="return confirm(&quot;{{ trans('tasks.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('tasks.task') }}</dt>
            <dd>{{ $task->task }}</dd>
            <dt>{{ trans('tasks.usu_alta_id') }}</dt>
            <dd>{{ optional($task->user)->name }}</dd>
            <dt>{{ trans('tasks.usu_mod_id') }}</dt>
            <dd>{{ optional($task->user)->name }}</dd>
            <dt>{{ trans('tasks.created_at') }}</dt>
            <dd>{{ $task->created_at }}</dd>
            <dt>{{ trans('tasks.updated_at') }}</dt>
            <dd>{{ $task->updated_at }}</dd>
            

        </dl>

    </div>
</div>

@endsection