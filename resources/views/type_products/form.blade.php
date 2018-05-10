
<div class="form-group col-md-4 {{ $errors->has('producto') ? 'has-error' : '' }}">
    <label for="producto" class="control-label">{{ trans('type_products.producto') }}</label>
    <div class="col-md-10">
        <input class="form-control input-sm " name="producto" type="text" id="producto" value="{{ old('producto', optional($typeProduct)->producto) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('type_products.producto__placeholder') }}">
        {!! $errors->first('producto', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('descripcion') ? 'has-error' : '' }}">
    <label for="descripcion" class="control-label">{{ trans('type_products.descripcion') }}</label>
    <div class="col-md-10">
        <input class="form-control input-sm " name="descripcion" type="text" id="descripcion" value="{{ old('descripcion', optional($typeProduct)->descripcion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('type_products.descripcion__placeholder') }}">
        {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_alta_id') ? 'has-error' : '' }}">
    <label for="usu_alta_id" class="control-label">{{ trans('type_products.usu_alta_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="usu_alta_id" name="usu_alta_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_alta_id', optional($typeProduct)->usu_alta_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('type_products.usu_alta_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_alta_id', optional($typeProduct)->usu_alta_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_alta_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_mod_id') ? 'has-error' : '' }}">
    <label for="usu_mod_id" class="control-label">{{ trans('type_products.usu_mod_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="usu_mod_id" name="usu_mod_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_mod_id', optional($typeProduct)->usu_mod_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('type_products.usu_mod_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_mod_id', optional($typeProduct)->usu_mod_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_mod_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

