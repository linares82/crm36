
<div class="form-group col-md-4 {{ $errors->has('type_product_id') ? 'has-error' : '' }}">
    <label for="type_product_id" class="control-label">{{ trans('products.type_product_id') }}</label>
    
        <input class="form-control input-sm " name="oportunity_id" type="hidden" id="oportunity_id" value="<?php echo (isset($oportunity_id))?$oportunity_id:old('oportunity_id', optional($product)->oportunity_id); ?>" minlength="1" maxlength="255" required="true" placeholder="{{ trans('customers.oportunity_id__placeholder') }}">
        <select class="form-control chosen" id="type_product_id" name="type_product_id" required="true">
        	    <option value="" style="display: none;" {{ old('type_product_id', optional($product)->type_product_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('products.type_product_id__placeholder') }}</option>
        	@foreach ($typeProducts as $key => $typeProduct)
			    <option value="{{ $key }}" {{ old('type_product_id', optional($product)->type_product_id) == $key ? 'selected' : '' }}>
			    	{{ $typeProduct }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('type_product_id', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-4 {{ $errors->has('producto') ? 'has-error' : '' }}">
    <label for="producto" class="control-label">{{ trans('products.producto') }}</label>
    
        <input class="form-control input-sm " name="producto" type="text" id="producto" value="{{ old('producto', optional($product)->producto) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('products.producto__placeholder') }}">
        {!! $errors->first('producto', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-4 {{ $errors->has('descripcion') ? 'has-error' : '' }}" >
    <label for="descripcion" class="control-label">{{ trans('products.descripcion') }}</label>
    
        <input class="form-control input-sm " name="descripcion" type="text" id="descripcion" value="{{ old('descripcion', optional($product)->descripcion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('products.descripcion__placeholder') }}">
        {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
    
</div>

