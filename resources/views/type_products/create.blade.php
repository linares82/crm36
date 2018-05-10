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
				<a href="{{ route('type_products.type_product.index') }}">{{ trans('type_products.model_plural') }}</a>
			</li>
			<li class="active">Crear</li>
		</ul><!-- /.breadcrumb -->
	</div>
    <div class="panel panel-default">

        <div class="panel-heading clearfix">
            
            <span class="pull-left">
                <h4 class="mt-5 mb-5">{{ trans('type_products.create') }}</h4>
            </span>
            @ifUserCan('type_products.type_product.index')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('type_products.type_product.index') }}" class="btn btn-primary" title="{{ trans('type_products.show_all') }}">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>
            </div>
            @endif
        </div>

        <div class="panel-body">
        
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('type_products.type_product.store') }}" accept-charset="UTF-8" id="create_type_product_form" name="create_type_product_form" class="form-horizontal">
            {{ csrf_field() }}
            @include ('type_products.form', [
                                        'typeProduct' => null,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('type_products.add') }}">
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection


