
<div class="form-group col-md-4 {{ $errors->has('oportunity_id') ? 'has-error' : '' }}">
    <label for="oportunity_id" class="control-label">{{ trans('files_customers.oportunity_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="oportunity_id" name="oportunity_id" required="true">
        	    <option value="" style="display: none;" {{ old('oportunity_id', optional($filesCustomer)->oportunity_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('files_customers.oportunity_id__placeholder') }}</option>
        	@foreach ($oportunities as $key => $oportunity)
			    <option value="{{ $key }}" {{ old('oportunity_id', optional($filesCustomer)->oportunity_id) == $key ? 'selected' : '' }}>
			    	{{ $oportunity }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('oportunity_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('archivo') ? 'has-error' : '' }}">
    <label for="archivo" class="control-label">{{ trans('files_customers.archivo') }}</label>
    <div class="col-md-10">
        <input class="form-control input-sm " name="archivo" type="text" id="archivo" value="{{ old('archivo', optional($filesCustomer)->archivo) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('files_customers.archivo__placeholder') }}">
        {!! $errors->first('archivo', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('nota') ? 'has-error' : '' }}">
    <label for="nota" class="control-label">{{ trans('files_customers.nota') }}</label>
    <div class="col-md-10">
        <input class="form-control input-sm " name="nota" type="text" id="nota" value="{{ old('nota', optional($filesCustomer)->nota) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('files_customers.nota__placeholder') }}">
        {!! $errors->first('nota', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_alta_id') ? 'has-error' : '' }}">
    <label for="usu_alta_id" class="control-label">{{ trans('files_customers.usu_alta_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="usu_alta_id" name="usu_alta_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_alta_id', optional($filesCustomer)->usu_alta_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('files_customers.usu_alta_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_alta_id', optional($filesCustomer)->usu_alta_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_alta_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_mod_id') ? 'has-error' : '' }}">
    <label for="usu_mod_id" class="control-label">{{ trans('files_customers.usu_mod_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="usu_mod_id" name="usu_mod_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_mod_id', optional($filesCustomer)->usu_mod_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('files_customers.usu_mod_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_mod_id', optional($filesCustomer)->usu_mod_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_mod_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

