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
				<a href="{{ route('related_tasks.related_task.index') }}">{{ trans('related_tasks.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Related Task' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('related_tasks.related_task.destroy', $relatedTask->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('related_tasks.related_task.index')
                    <a href="{{ route('related_tasks.related_task.index') }}" class="btn btn-primary" title="{{ trans('related_tasks.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('related_tasks.related_task.create')
                    <a href="{{ route('related_tasks.related_task.create') }}" class="btn btn-success" title="{{ trans('related_tasks.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('related_tasks.related_task.edit')
                    <a href="{{ route('related_tasks.related_task.edit', $relatedTask->id ) }}" class="btn btn-primary" title="{{ trans('related_tasks.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('related_tasks.related_task.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('related_tasks.delete') }}" onclick="return confirm(&quot;{{ trans('related_tasks.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('related_tasks.oportunity_id') }}</dt>
            <dd>{{ optional($relatedTask->oportunity)->descripcion }}</dd>
            <dt>{{ trans('related_tasks.task_id') }}</dt>
            <dd>{{ optional($relatedTask->task)->task }}</dd>
            <dt>{{ trans('related_tasks.detail') }}</dt>
            <dd>{{ $relatedTask->detail }}</dd>
            <dt>{{ trans('related_tasks.activo') }}</dt>
            <dd>{{ ($relatedTask->activo) ? 'Yes' : 'No' }}</dd>
            <dt>{{ trans('related_tasks.usu_alta_id') }}</dt>
            <dd>{{ optional($relatedTask->user)->name }}</dd>
            <dt>{{ trans('related_tasks.usu_mod_id') }}</dt>
            <dd>{{ optional($relatedTask->user)->name }}</dd>
            <dt>{{ trans('related_tasks.created_at') }}</dt>
            <dd>{{ $relatedTask->created_at }}</dd>
            <dt>{{ trans('related_tasks.updated_at') }}</dt>
            <dd>{{ $relatedTask->updated_at }}</dd>
            <dt>{{ trans('related_tasks.deleted_at') }}</dt>
            <dd>{{ $relatedTask->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection