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
				<a href="{{ route('notes.note.index') }}">{{ trans('notes.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Note' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('notes.note.destroy', $note->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('notes.note.index')
                    <a href="{{ route('notes.note.index') }}" class="btn btn-primary" title="{{ trans('notes.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('notes.note.create')
                    <a href="{{ route('notes.note.create') }}" class="btn btn-success" title="{{ trans('notes.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('notes.note.edit')
                    <a href="{{ route('notes.note.edit', $note->id ) }}" class="btn btn-primary" title="{{ trans('notes.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('notes.note.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('notes.delete') }}" onclick="return confirm(&quot;{{ trans('notes.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('notes.oportunity_id') }}</dt>
            <dd>{{ optional($note->oportunity)->descripcion }}</dd>
            <dt>{{ trans('notes.short_name') }}</dt>
            <dd>{{ $note->short_name }}</dd>
            <dt>{{ trans('notes.note') }}</dt>
            <dd>{{ $note->note }}</dd>
            <dt>{{ trans('notes.usu_alta_id') }}</dt>
            <dd>{{ optional($note->user)->name }}</dd>
            <dt>{{ trans('notes.usu_mod_id') }}</dt>
            <dd>{{ optional($note->user)->name }}</dd>
            <dt>{{ trans('notes.created_at') }}</dt>
            <dd>{{ $note->created_at }}</dd>
            <dt>{{ trans('notes.updated_at') }}</dt>
            <dd>{{ $note->updated_at }}</dd>
            <dt>{{ trans('notes.deleted_at') }}</dt>
            <dd>{{ $note->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection