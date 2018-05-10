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
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Type Product' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('type_products.type_product.destroy', $typeProduct->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('type_products.type_product.index')
                    <a href="{{ route('type_products.type_product.index') }}" class="btn btn-primary" title="{{ trans('type_products.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('type_products.type_product.create')
                    <a href="{{ route('type_products.type_product.create') }}" class="btn btn-success" title="{{ trans('type_products.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('type_products.type_product.edit')
                    <a href="{{ route('type_products.type_product.edit', $typeProduct->id ) }}" class="btn btn-primary" title="{{ trans('type_products.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('type_products.type_product.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('type_products.delete') }}" onclick="return confirm(&quot;{{ trans('type_products.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('type_products.producto') }}</dt>
            <dd>{{ $typeProduct->producto }}</dd>
            <dt>{{ trans('type_products.descripcion') }}</dt>
            <dd>{{ $typeProduct->descripcion }}</dd>
            <dt>{{ trans('type_products.usu_alta_id') }}</dt>
            <dd>{{ optional($typeProduct->user)->name }}</dd>
            <dt>{{ trans('type_products.usu_mod_id') }}</dt>
            <dd>{{ optional($typeProduct->user)->name }}</dd>
            <dt>{{ trans('type_products.created_at') }}</dt>
            <dd>{{ $typeProduct->created_at }}</dd>
            <dt>{{ trans('type_products.updated_at') }}</dt>
            <dd>{{ $typeProduct->updated_at }}</dd>
            <dt>{{ trans('type_products.deleted_at') }}</dt>
            <dd>{{ $typeProduct->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection