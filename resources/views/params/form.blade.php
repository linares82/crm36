
<div class="form-group col-md-4 {{ $errors->has('key') ? 'has-error' : '' }}">
    <label for="key" class="control-label">{{ trans('params.key') }}</label>
    <div class="col-md-10">
        <input class="form-control input-sm " name="key" type="text" id="key" value="{{ old('key', optional($param)->key) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('params.key__placeholder') }}">
        {!! $errors->first('key', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('value') ? 'has-error' : '' }}">
    <label for="value" class="control-label">{{ trans('params.value') }}</label>
    <div class="col-md-10">
        <input class="form-control input-sm " name="value" type="text" id="value" value="{{ old('value', optional($param)->value) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('params.value__placeholder') }}">
        {!! $errors->first('value', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_alta_id') ? 'has-error' : '' }}">
    <label for="usu_alta_id" class="control-label">{{ trans('params.usu_alta_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="usu_alta_id" name="usu_alta_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_alta_id', optional($param)->usu_alta_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('params.usu_alta_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_alta_id', optional($param)->usu_alta_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_alta_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_mod_id') ? 'has-error' : '' }}">
    <label for="usu_mod_id" class="control-label">{{ trans('params.usu_mod_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="usu_mod_id" name="usu_mod_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_mod_id', optional($param)->usu_mod_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('params.usu_mod_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_mod_id', optional($param)->usu_mod_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_mod_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

