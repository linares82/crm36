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
				<a href="{{ route('oportunity_sts.oportunity_st.index') }}">{{ trans('oportunity_sts.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Oportunity St' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('oportunity_sts.oportunity_st.destroy', $oportunitySt->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('oportunity_sts.oportunity_st.index')
                    <a href="{{ route('oportunity_sts.oportunity_st.index') }}" class="btn btn-primary" title="{{ trans('oportunity_sts.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('oportunity_sts.oportunity_st.create')
                    <a href="{{ route('oportunity_sts.oportunity_st.create') }}" class="btn btn-success" title="{{ trans('oportunity_sts.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('oportunity_sts.oportunity_st.edit')
                    <a href="{{ route('oportunity_sts.oportunity_st.edit', $oportunitySt->id ) }}" class="btn btn-primary" title="{{ trans('oportunity_sts.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('oportunity_sts.oportunity_st.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('oportunity_sts.delete') }}" onclick="return confirm(&quot;{{ trans('oportunity_sts.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('oportunity_sts.estatus') }}</dt>
            <dd>{{ $oportunitySt->estatus }}</dd>
            <dt>{{ trans('oportunity_sts.usu_alta_id') }}</dt>
            <dd>{{ optional($oportunitySt->user)->name }}</dd>
            <dt>{{ trans('oportunity_sts.usu_mod_id') }}</dt>
            <dd>{{ optional($oportunitySt->user)->name }}</dd>
            <dt>{{ trans('oportunity_sts.created_at') }}</dt>
            <dd>{{ $oportunitySt->created_at }}</dd>
            <dt>{{ trans('oportunity_sts.updated_at') }}</dt>
            <dd>{{ $oportunitySt->updated_at }}</dd>
            <dt>{{ trans('oportunity_sts.deleted_at') }}</dt>
            <dd>{{ $oportunitySt->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection