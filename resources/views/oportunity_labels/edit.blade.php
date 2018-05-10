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
			<li class="active">Editar</li>
		</ul><!-- /.breadcrumb -->
	</div>
    <div class="panel panel-default">
  
        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : 'Oportunity Label' }}</h4>
            </div>
            <div class="btn-group btn-group-sm pull-right" role="group">
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

            <form method="POST" action="{{ route('oportunity_labels.oportunity_label.update', $oportunityLabel->id) }}" id="edit_oportunity_label_form" name="edit_oportunity_label_form" accept-charset="UTF-8" class="">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('oportunity_labels.form', [
                                        'oportunityLabel' => $oportunityLabel,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('oportunity_labels.update') }}">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection