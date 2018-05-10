
<div class="form-group col-md-4 {{ $errors->has('oportunity_label_id') ? 'has-error' : '' }}">
    <label for="oportunity_label_id" class="control-label">{{ trans('oportunities.oportunity_label_id') }}</label>
    
        <select class="form-control" id="oportunity_label_id" name="oportunity_label_id" required="true">
        	    <option value="" style="display: none;" {{ old('oportunity_label_id', optional($oportunity)->oportunity_label_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('oportunities.oportunity_label_id__placeholder') }}</option>
        	@foreach ($oportunityLabels as $key => $oportunityLabel)
			    <option value="{{ $key }}" {{ old('oportunity_label_id', optional($oportunity)->oportunity_label_id) == $key ? 'selected' : '' }}>
			    	{{ $oportunityLabel }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('oportunity_label_id', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-4 {{ $errors->has('descripcion') ? 'has-error' : '' }}">
    <label for="descripcion" class="control-label">{{ trans('oportunities.descripcion') }}</label>
    
        <input class="form-control input-sm " name="descripcion" type="text" id="descripcion" value="{{ old('descripcion', optional($oportunity)->descripcion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('oportunities.descripcion__placeholder') }}">
        {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-4 {{ $errors->has('oportunity_st_id') ? 'has-error' : '' }}">
    <label for="oportunity_st_id" class="control-label">{{ trans('oportunities.oportunity_st_id') }}</label>
    
        <select class="form-control" id="oportunity_st_id" name="oportunity_st_id" required="true">
        	    <option value="" style="display: none;" {{ old('oportunity_st_id', optional($oportunity)->oportunity_st_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('oportunities.oportunity_st_id__placeholder') }}</option>
        	@foreach ($oportunitySts as $key => $oportunitySt)
			    <option value="{{ $key }}" {{ old('oportunity_st_id', optional($oportunity)->oportunity_st_id) == $key ? 'selected' : '' }}>
			    	{{ $oportunitySt }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('oportunity_st_id', '<p class="help-block">:message</p>') !!}
    
</div>

