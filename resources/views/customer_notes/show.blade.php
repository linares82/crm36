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
				<a href="{{ route('customer_notes.customer_note.index') }}">{{ trans('customer_notes.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Customer Note' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('customer_notes.customer_note.destroy', $customerNote->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('customer_notes.customer_note.index')
                    <a href="{{ route('customer_notes.customer_note.index') }}" class="btn btn-primary" title="{{ trans('customer_notes.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('customer_notes.customer_note.create')
                    <a href="{{ route('customer_notes.customer_note.create') }}" class="btn btn-success" title="{{ trans('customer_notes.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('customer_notes.customer_note.edit')
                    <a href="{{ route('customer_notes.customer_note.edit', $customerNote->id ) }}" class="btn btn-primary" title="{{ trans('customer_notes.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('customer_notes.customer_note.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('customer_notes.delete') }}" onclick="return confirm(&quot;{{ trans('customer_notes.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('customer_notes.customer_id') }}</dt>
            <dd>{{ optional($customerNote->customer)->razon }}</dd>
            <dt>{{ trans('customer_notes.short_name') }}</dt>
            <dd>{{ $customerNote->short_name }}</dd>
            <dt>{{ trans('customer_notes.note') }}</dt>
            <dd>{{ $customerNote->note }}</dd>
            <dt>{{ trans('customer_notes.usu_alta_id') }}</dt>
            <dd>{{ optional($customerNote->user)->name }}</dd>
            <dt>{{ trans('customer_notes.usu_mod_id') }}</dt>
            <dd>{{ optional($customerNote->user)->name }}</dd>
            <dt>{{ trans('customer_notes.created_at') }}</dt>
            <dd>{{ $customerNote->created_at }}</dd>
            <dt>{{ trans('customer_notes.updated_at') }}</dt>
            <dd>{{ $customerNote->updated_at }}</dd>
            <dt>{{ trans('customer_notes.deleted_at') }}</dt>
            <dd>{{ $customerNote->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection