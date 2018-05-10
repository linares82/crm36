
<div class="form-group col-md-4 {{ $errors->has('customer_id') ? 'has-error' : '' }}">
    <label for="customer_id" class="control-label">{{ trans('customer_notes.customer_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="customer_id" name="customer_id" required="true">
        	    <option value="" style="display: none;" {{ old('customer_id', optional($customerNote)->customer_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('customer_notes.customer_id__placeholder') }}</option>
        	@foreach ($customers as $key => $customer)
			    <option value="{{ $key }}" {{ old('customer_id', optional($customerNote)->customer_id) == $key ? 'selected' : '' }}>
			    	{{ $customer }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('short_name') ? 'has-error' : '' }}">
    <label for="short_name" class="control-label">{{ trans('customer_notes.short_name') }}</label>
    <div class="col-md-10">
        <input class="form-control input-sm " name="short_name" type="text" id="short_name" value="{{ old('short_name', optional($customerNote)->short_name) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('customer_notes.short_name__placeholder') }}">
        {!! $errors->first('short_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('note') ? 'has-error' : '' }}">
    <label for="note" class="control-label">{{ trans('customer_notes.note') }}</label>
    <div class="col-md-10">
        <input class="form-control input-sm " name="note" type="text" id="note" value="{{ old('note', optional($customerNote)->note) }}" minlength="1" maxlength="255" required="true">
        {!! $errors->first('note', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_alta_id') ? 'has-error' : '' }}">
    <label for="usu_alta_id" class="control-label">{{ trans('customer_notes.usu_alta_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="usu_alta_id" name="usu_alta_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_alta_id', optional($customerNote)->usu_alta_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('customer_notes.usu_alta_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_alta_id', optional($customerNote)->usu_alta_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_alta_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_mod_id') ? 'has-error' : '' }}">
    <label for="usu_mod_id" class="control-label">{{ trans('customer_notes.usu_mod_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="usu_mod_id" name="usu_mod_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_mod_id', optional($customerNote)->usu_mod_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('customer_notes.usu_mod_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_mod_id', optional($customerNote)->usu_mod_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_mod_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

