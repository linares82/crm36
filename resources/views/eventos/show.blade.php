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
				<a href="{{ route('eventos.evento.index') }}">{{ trans('eventos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Evento' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('eventos.evento.destroy', $evento->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('eventos.evento.index')
                    <a href="{{ route('eventos.evento.index') }}" class="btn btn-primary" title="{{ trans('eventos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('eventos.evento.create')
                    <a href="{{ route('eventos.evento.create') }}" class="btn btn-success" title="{{ trans('eventos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('eventos.evento.edit')
                    <a href="{{ route('eventos.evento.edit', $evento->id ) }}" class="btn btn-primary" title="{{ trans('eventos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('eventos.evento.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('eventos.delete') }}" onclick="return confirm(&quot;{{ trans('eventos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('eventos.short_name') }}</dt>
            <dd>{{ $evento->short_name }}</dd>
            <dt>{{ trans('eventos.detail') }}</dt>
            <dd>{{ $evento->detail }}</dd>
            <dt>{{ trans('eventos.date') }}</dt>
            <dd>{{ $evento->date }}</dd>
            <dt>{{ trans('eventos.mail_bnd') }}</dt>
            <dd>{{ ($evento->mail_bnd) ? 'Yes' : 'No' }}</dd>
            <dt>{{ trans('eventos.day_before_sent') }}</dt>
            <dd>{{ $evento->day_before_sent }}</dd>
            <dt>{{ trans('eventos.usu_alta_id') }}</dt>
            <dd>{{ optional($evento->user)->name }}</dd>
            <dt>{{ trans('eventos.usu_mod_id') }}</dt>
            <dd>{{ optional($evento->user)->name }}</dd>
            <dt>{{ trans('eventos.created_at') }}</dt>
            <dd>{{ $evento->created_at }}</dd>
            <dt>{{ trans('eventos.updated_at') }}</dt>
            <dd>{{ $evento->updated_at }}</dd>
            <dt>{{ trans('eventos.deleted_at') }}</dt>
            <dd>{{ $evento->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection