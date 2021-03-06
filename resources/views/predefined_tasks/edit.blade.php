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
			<li class="active">Editar</li>
		</ul><!-- /.breadcrumb -->
	</div>
    <div class="panel panel-default">
  
        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : 'Predefined Task' }}</h4>
            </div>
            <div class="btn-group btn-group-sm pull-right" role="group">
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
            </div>
        </div>

        <div class="panel-body">

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('predefined_tasks.predefined_task.update', $predefinedTask->id) }}" id="edit_predefined_task_form" name="edit_predefined_task_form" accept-charset="UTF-8" class="">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('predefined_tasks.form', [
                                        'predefinedTask' => $predefinedTask,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('predefined_tasks.update') }}">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection