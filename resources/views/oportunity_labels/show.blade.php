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
				<a href="{{ route('oportunity_labels.oportunity_label.index') }}">{{ trans('oportunity_labels.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Oportunity Label' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('oportunity_labels.oportunity_label.destroy', $oportunityLabel->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('oportunity_labels.oportunity_label.index')
                    <a href="{{ route('oportunity_labels.oportunity_label.index') }}" class="btn btn-primary" title="{{ trans('oportunity_labels.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('oportunity_labels.oportunity_label.create')
                    <a href="{{ route('oportunity_labels.oportunity_label.create') }}" class="btn btn-success" title="{{ trans('oportunity_labels.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('oportunity_labels.oportunity_label.edit')
                    <a href="{{ route('oportunity_labels.oportunity_label.edit', $oportunityLabel->id ) }}" class="btn btn-primary" title="{{ trans('oportunity_labels.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('oportunity_labels.oportunity_label.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('oportunity_labels.delete') }}" onclick="return confirm(&quot;{{ trans('oportunity_labels.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('oportunity_labels.etiqueta') }}</dt>
            <dd>{{ $oportunityLabel->etiqueta }}</dd>
            <dt>{{ trans('oportunity_labels.descripcion') }}</dt>
            <dd>{{ $oportunityLabel->descripcion }}</dd>
            <dt>{{ trans('oportunity_labels.usu_alta_id') }}</dt>
            <dd>{{ optional($oportunityLabel->user)->name }}</dd>
            <dt>{{ trans('oportunity_labels.usu_mod_id') }}</dt>
            <dd>{{ optional($oportunityLabel->user)->name }}</dd>
            <dt>{{ trans('oportunity_labels.created_at') }}</dt>
            <dd>{{ $oportunityLabel->created_at }}</dd>
            <dt>{{ trans('oportunity_labels.updated_at') }}</dt>
            <dd>{{ $oportunityLabel->updated_at }}</dd>
        </dl>

    </div>
</div>

@endsection