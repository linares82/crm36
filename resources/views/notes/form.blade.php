<div class="form-group col-md-10 {{ $errors->has('note') ? 'has-error' : '' }}">
    <label for="note" class="control-label">{{ trans('notes.note') }}</label>
        <input class="form-control input-sm " name="oportunity_id" type="hidden" id="oportunity_id" value="<?php echo (isset($oportunity_id))?$oportunity_id:old('oportunity_id', optional($customer)->oportunity_id); ?>" minlength="1" maxlength="255" required="true" placeholder="{{ trans('customers.oportunity_id__placeholder') }}">
        <textarea class="form-control input-sm " name="note" id="note" rows="2"  required="true">
        </textarea>
        {!! $errors->first('note', '<p class="help-block">:message</p>') !!}
    
</div>

