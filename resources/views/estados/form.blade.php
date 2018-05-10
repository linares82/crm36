
<div class="form-group col-md-4 {{ $errors->has('estado') ? 'has-error' : '' }}">
    <label for="estado" class="control-label">{{ trans('estados.estado') }}</label>
    <div class="col-md-10">
        <input class="form-control input-sm " name="estado" type="text" id="estado" value="{{ old('estado', optional($estado)->estado) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('estados.estado__placeholder') }}">
        {!! $errors->first('estado', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_alta_id') ? 'has-error' : '' }}">
    <label for="usu_alta_id" class="control-label">{{ trans('estados.usu_alta_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="usu_alta_id" name="usu_alta_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_alta_id', optional($estado)->usu_alta_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('estados.usu_alta_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_alta_id', optional($estado)->usu_alta_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_alta_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_mod_id') ? 'has-error' : '' }}">
    <label for="usu_mod_id" class="control-label">{{ trans('estados.usu_mod_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="usu_mod_id" name="usu_mod_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_mod_id', optional($estado)->usu_mod_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('estados.usu_mod_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_mod_id', optional($estado)->usu_mod_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_mod_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

