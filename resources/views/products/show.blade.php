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
				<a href="{{ route('products.product.index') }}">{{ trans('products.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Product' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('products.product.destroy', $product->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('products.product.index')
                    <a href="{{ route('products.product.index') }}" class="btn btn-primary" title="{{ trans('products.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('products.product.create')
                    <a href="{{ route('products.product.create') }}" class="btn btn-success" title="{{ trans('products.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('products.product.edit')
                    <a href="{{ route('products.product.edit', $product->id ) }}" class="btn btn-primary" title="{{ trans('products.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('products.product.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('products.delete') }}" onclick="return confirm(&quot;{{ trans('products.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('products.oportunity_id') }}</dt>
            <dd>{{ optional($product->oportunity)->descripcion }}</dd>
            <dt>{{ trans('products.type_product_id') }}</dt>
            <dd>{{ optional($product->typeProduct)->producto }}</dd>
            <dt>{{ trans('products.producto') }}</dt>
            <dd>{{ $product->producto }}</dd>
            <dt>{{ trans('products.descripcion') }}</dt>
            <dd>{{ $product->descripcion }}</dd>
            <dt>{{ trans('products.usu_alta_id') }}</dt>
            <dd>{{ optional($product->user)->name }}</dd>
            <dt>{{ trans('products.usu_mod_id') }}</dt>
            <dd>{{ optional($product->user)->name }}</dd>
            <dt>{{ trans('products.created_at') }}</dt>
            <dd>{{ $product->created_at }}</dd>
            <dt>{{ trans('products.updated_at') }}</dt>
            <dd>{{ $product->updated_at }}</dd>
            <dt>{{ trans('products.deleted_at') }}</dt>
            <dd>{{ $product->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection