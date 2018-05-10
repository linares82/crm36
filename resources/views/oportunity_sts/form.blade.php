
<div class="form-group col-md-4 {{ $errors->has('estatus') ? 'has-error' : '' }}">
    <label for="estatus" class="control-label">{{ trans('oportunity_sts.estatus') }}</label>
    
        <input class="form-control input-sm " name="estatus" type="text" id="estatus" value="{{ old('estatus', optional($oportunitySt)->estatus) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('oportunity_sts.estatus__placeholder') }}">
        {!! $errors->first('estatus', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-4 {{ $errors->has('color') ? 'has-error' : '' }}">
    <label for="color" class="control-label">{{ trans('oportunity_sts.color') }}</label>
        <input class="form-control input-sm " name="color" type="text" id="color" value="{{ old('color', optional($oportunitySt)->color) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('oportunity_sts.color__placeholder') }}">
    <span class="btn-colorpicker" style="background-color: {{ old('color', optional($oportunitySt)->color) }};"></span>
        {!! $errors->first('estatus', '<p class="help-block">:message</p>') !!}
</div>

@push('scripts')
<script>
  $(function () {
    $('#color').colorpicker();
  });
</script>
@endpush