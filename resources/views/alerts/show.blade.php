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
				<a href="{{ route('alerts.alert.index') }}">{{ trans('alerts.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Alert' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('alerts.alert.destroy', $alert->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('alerts.alert.index')
                    <a href="{{ route('alerts.alert.index') }}" class="btn btn-primary" title="{{ trans('alerts.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('alerts.alert.create')
                    <a href="{{ route('alerts.alert.create') }}" class="btn btn-success" title="{{ trans('alerts.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('alerts.alert.edit')
                    <a href="{{ route('alerts.alert.edit', $alert->id ) }}" class="btn btn-primary" title="{{ trans('alerts.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('alerts.alert.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('alerts.delete') }}" onclick="return confirm(&quot;{{ trans('alerts.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('alerts.oportunity_id') }}</dt>
            <dd>{{ optional($alert->oportunity)->descripcion }}</dd>
            <dt>{{ trans('alerts.message') }}</dt>
            <dd>{{ $alert->message }}</dd>
            <dt>{{ trans('alerts.detail') }}</dt>
            <dd>{{ $alert->detail }}</dd>
            <dt>{{ trans('alerts.date_send') }}</dt>
            <dd>{{ $alert->date_send }}</dd>
            <dt>{{ trans('alerts.mail_bnd') }}</dt>
            <dd>{{ ($alert->mail_bnd) ? 'Yes' : 'No' }}</dd>
            <dt>{{ trans('alerts.day_before_sent') }}</dt>
            <dd>{{ $alert->day_before_sent }}</dd>
            <dt>{{ trans('alerts.usu_alta_id') }}</dt>
            <dd>{{ optional($alert->user)->name }}</dd>
            <dt>{{ trans('alerts.usu_mod_id') }}</dt>
            <dd>{{ optional($alert->user)->name }}</dd>
            <dt>{{ trans('alerts.created_at') }}</dt>
            <dd>{{ $alert->created_at }}</dd>
            <dt>{{ trans('alerts.updated_at') }}</dt>
            <dd>{{ $alert->updated_at }}</dd>
            <dt>{{ trans('alerts.deleted_at') }}</dt>
            <dd>{{ $alert->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection