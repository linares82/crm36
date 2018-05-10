
<div class="form-group col-md-4 {{ $errors->has('short_name') ? 'has-error' : '' }}">
    <label for="short_name" class="control-label">{{ trans('eventos.short_name') }}</label>
    <div class="col-md-10">
        <input class="form-control input-sm " name="short_name" type="text" id="short_name" value="{{ old('short_name', optional($evento)->short_name) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('eventos.short_name__placeholder') }}">
        {!! $errors->first('short_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('detail') ? 'has-error' : '' }}">
    <label for="detail" class="control-label">{{ trans('eventos.detail') }}</label>
    <div class="col-md-10">
        <input class="form-control input-sm " name="detail" type="text" id="detail" value="{{ old('detail', optional($evento)->detail) }}" minlength="1" maxlength="255" required="true">
        {!! $errors->first('detail', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('date') ? 'has-error' : '' }}">
    <label for="date" class="control-label">{{ trans('eventos.date') }}</label>
    <div class="col-md-10">
        <input class="form-control input-sm " name="date" type="text" id="date" value="{{ old('date', optional($evento)->date) }}" minlength="1" required="true" placeholder="{{ trans('eventos.date__placeholder') }}">
        {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('mail_bnd') ? 'has-error' : '' }}">
    <label for="mail_bnd" class="control-label">{{ trans('eventos.mail_bnd') }}</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="mail_bnd_1">
            	<input id="mail_bnd_1" class="" name="mail_bnd" type="checkbox" value="1" {{ old('mail_bnd', optional($evento)->mail_bnd) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('mail_bnd', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('day_before_sent') ? 'has-error' : '' }}">
    <label for="day_before_sent" class="control-label">{{ trans('eventos.day_before_sent') }}</label>
    <div class="col-md-10">
        <input class="form-control input-sm " name="day_before_sent" type="number" id="day_before_sent" value="{{ old('day_before_sent', optional($evento)->day_before_sent) }}" min="-2147483648" max="2147483647" required="true" placeholder="{{ trans('eventos.day_before_sent__placeholder') }}">
        {!! $errors->first('day_before_sent', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_alta_id') ? 'has-error' : '' }}">
    <label for="usu_alta_id" class="control-label">{{ trans('eventos.usu_alta_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="usu_alta_id" name="usu_alta_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_alta_id', optional($evento)->usu_alta_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('eventos.usu_alta_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_alta_id', optional($evento)->usu_alta_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_alta_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_mod_id') ? 'has-error' : '' }}">
    <label for="usu_mod_id" class="control-label">{{ trans('eventos.usu_mod_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="usu_mod_id" name="usu_mod_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_mod_id', optional($evento)->usu_mod_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('eventos.usu_mod_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_mod_id', optional($evento)->usu_mod_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_mod_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

