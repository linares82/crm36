
<div class="form-group col-md-4 {{ $errors->has('etiqueta') ? 'has-error' : '' }}">
    <label for="etiqueta" >{{ trans('oportunity_labels.etiqueta') }}</label>
        <input class="form-control input-sm " name="etiqueta" type="text" id="etiqueta" value="{{ old('etiqueta', optional($oportunityLabel)->etiqueta) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('oportunity_labels.etiqueta__placeholder') }}">
        {!! $errors->first('etiqueta', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-4 {{ $errors->has('descripcion') ? 'has-error' : '' }}">
    <label for="descripcion" class="control-label">{{ trans('oportunity_labels.descripcion') }}</label>
        <input class="form-control input-sm " name="descripcion" type="text" id="descripcion" value="{{ old('descripcion', optional($oportunityLabel)->descripcion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('oportunity_labels.descripcion__placeholder') }}">
        {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
    
</div>
