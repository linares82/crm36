<div class="form-group col-md-8 {{ $errors->has('message') ? 'has-error' : '' }}">
    <label for="message" class="control-label">{{ trans('alerts.message') }}</label>
    
        <input class="form-control input-sm " name="oportunity_id" type="hidden" id="oportunity_id" value="<?php echo (isset($oportunity_id))?$oportunity_id:old('oportunity_id', optional($alerta)->oportunity_id); ?>" minlength="1" maxlength="255" required="true" placeholder="{{ trans('alertas.oportunity_id__placeholder') }}">
        <input class="form-control input-sm " name="message" type="text" id="message" value="{{ old('message', optional($alert)->message) }}" min="1" max="255" required="true" placeholder="{{ trans('alerts.message__placeholder') }}">
        {!! $errors->first('message', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-4 {{ $errors->has('date_send') ? 'has-error' : '' }}">
    <label for="date_send" class="control-label">{{ trans('alerts.date_send') }}</label>
    
        <input class="form-control input-sm " name="date_send" type="text" id="date_send" value="{{ old('date_send', optional($alert)->date_send) }}" minlength="1" required="true" placeholder="{{ trans('alerts.date_send__placeholder') }}">
        {!! $errors->first('date_send', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-2 {{ $errors->has('mail_bnd') ? 'has-error' : '' }}">
    <label for="mail_bnd" class="control-label">{{ trans('alerts.mail_bnd') }}</label>
    
        <div class="checkbox">
            <label for="mail_bnd_1">
            	<input id="mail_bnd_1" class="" name="mail_bnd" type="checkbox" value="1" {{ old('mail_bnd', optional($alert)->mail_bnd) == '1' ? 'checked' : '' }}>
                Si
            </label>
        </div>

        {!! $errors->first('mail_bnd', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-6 {{ $errors->has('day_before_sent') ? 'has-error' : '' }}">
    <label for="day_before_sent" class="control-label">{{ trans('alerts.day_before_sent') }}</label>
    
        <input class="form-control input-sm " name="day_before_sent" type="number" id="day_before_sent" value="0" min="-2147483648" max="2147483647" required="true" placeholder="{{ trans('alerts.day_before_sent__placeholder') }}">
        {!! $errors->first('day_before_sent', '<p class="help-block">:message</p>') !!}
    
</div>

