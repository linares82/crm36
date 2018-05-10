<h3 class='header smaller lighter blue'>Identificación</h3>

<div class="form-group col-md-6 col-xs-12 {{ $errors->has('razon') ? 'has-error' : '' }}">
    <label for="razon" class="control-label">{{ trans('customers.razon') }}</label>
        
        <input class="form-control input-sm " name="oportunity_id" type="hidden" id="oportunity_id" value="<?php echo (isset($oportunity_id))?$oportunity_id:old('oportunity_id', optional($customer)->oportunity_id); ?>" minlength="1" maxlength="255" required="true" placeholder="{{ trans('customers.oportunity_id__placeholder') }}">
        <input class="form-control input-sm " name="razon" type="text" id="razon" value="{{ old('razon', optional($customer)->razon) }}" minlength="1" maxlength="255" placeholder="{{ trans('customers.razon__placeholder') }}">
        {!! $errors->first('razon', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-6 col-xs-12 {{ $errors->has('nombre1') ? 'has-error' : '' }}">
    <label for="nombre1" class="control-label">{{ trans('customers.nombre1') }}</label>
    
        <input class="form-control input-sm " name="nombre1" type="text" id="nombre1" value="{{ old('nombre1', optional($customer)->nombre1) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('customers.nombre1__placeholder') }}">
        {!! $errors->first('nombre1', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-6 col-xs-12 {{ $errors->has('nombre2') ? 'has-error' : '' }}">
    <label for="nombre2" class="control-label">{{ trans('customers.nombre2') }}</label>
    
        <input class="form-control input-sm " name="nombre2" type="text" id="nombre2" value="{{ old('nombre2', optional($customer)->nombre2) }}" maxlength="255" placeholder="{{ trans('customers.nombre2__placeholder') }}">
        {!! $errors->first('nombre2', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-6 col-xs-12 {{ $errors->has('ape_paterno') ? 'has-error' : '' }}">
    <label for="ape_paterno" class="control-label">{{ trans('customers.ape_paterno') }}</label>
    
        <input class="form-control input-sm " name="ape_paterno" type="text" id="ape_paterno" value="{{ old('ape_paterno', optional($customer)->ape_paterno) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('customers.ape_paterno__placeholder') }}">
        {!! $errors->first('ape_paterno', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-6 col-xs-12 {{ $errors->has('ape_materno') ? 'has-error' : '' }}">
    <label for="ape_materno" class="control-label">{{ trans('customers.ape_materno') }}</label>
    
        <input class="form-control input-sm " name="ape_materno" type="text" id="ape_materno" value="{{ old('ape_materno', optional($customer)->ape_materno) }}" maxlength="255" placeholder="{{ trans('customers.ape_materno__placeholder') }}">
        {!! $errors->first('ape_materno', '<p class="help-block">:message</p>') !!}
    
</div>
<div class='row'></div>
<h3 class='header smaller lighter blue'>Dirección</h3>


<div class="form-group col-md-6 col-xs-12 {{ $errors->has('calle') ? 'has-error' : '' }}">
    <label for="calle" class="control-label">{{ trans('customers.calle') }}</label>
    
        <input class="form-control input-sm " name="calle" type="text" id="calle" value="{{ old('calle', optional($customer)->calle) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('customers.calle__placeholder') }}">
        {!! $errors->first('calle', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-6 col-xs-12 {{ $errors->has('numero_int') ? 'has-error' : '' }}">
    <label for="numero_int" class="control-label">{{ trans('customers.numero_int') }}</label>
    
        <input class="form-control input-sm " name="numero_int" type="text" id="numero_int" value="{{ old('numero_int', optional($customer)->numero_int) }}" minlength="1" maxlength="255" placeholder="{{ trans('customers.numero_int__placeholder') }}">
        {!! $errors->first('numero_int', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-6 col-xs-12 {{ $errors->has('numero_ext') ? 'has-error' : '' }}">
    <label for="numero_ext" class="control-label">{{ trans('customers.numero_ext') }}</label>
    
        <input class="form-control input-sm " name="numero_ext" type="text" id="numero_ext" value="{{ old('numero_ext', optional($customer)->numero_ext) }}" maxlength="255" placeholder="{{ trans('customers.numero_ext__placeholder') }}">
        {!! $errors->first('numero_ext', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-6 col-xs-12 {{ $errors->has('colonia') ? 'has-error' : '' }}">
    <label for="colonia" class="control-label">{{ trans('customers.colonia') }}</label>
    
        <input class="form-control input-sm " name="colonia" type="text" id="colonia" value="{{ old('colonia', optional($customer)->colonia) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('customers.colonia__placeholder') }}">
        {!! $errors->first('colonia', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-6 col-xs-12 {{ $errors->has('ciudad') ? 'has-error' : '' }}">
    <label for="ciudad" class="control-label">{{ trans('customers.ciudad') }}</label>
    
        <input class="form-control input-sm " name="ciudad" type="text" id="ciudad" value="{{ old('ciudad', optional($customer)->ciudad) }}" maxlength="255" placeholder="{{ trans('customers.ciudad__placeholder') }}">
        {!! $errors->first('ciudad', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-6 col-xs-12 {{ $errors->has('estado_id') ? 'has-error' : '' }}">
    <label for="estado_id" class="control-label">{{ trans('customers.estado_id') }}</label>
    
        <select class="form-control chosen" id="estado_id" name="estado_id" required="true" style='width:100%;'>
        	    <option value="" style="display: none;" {{ old('estado_id', optional($customer)->estado_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('customers.estado_id__placeholder') }}</option>
        	@foreach ($estados as $key => $estado)
			    <option value="{{ $key }}" {{ old('estado_id', optional($customer)->estado_id) == $key ? 'selected' : '' }}>
			    	{{ $estado }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('estado_id', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-6 col-xs-12 {{ $errors->has('municipio_id') ? 'has-error' : '' }}" style="clear:left;">
    <label for="municipio_id" class="control-label">{{ trans('customers.municipio_id') }}</label>
    
        <select class="form-control" id="municipio_id" name="municipio_id" required="true">
        	    <option value="" style="display: none;" {{ old('municipio_id', optional($customer)->municipio_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('customers.municipio_id__placeholder') }}</option>
        	@foreach ($municipios as $key => $municipio)
			    <option value="{{ $key }}" {{ old('municipio_id', optional($customer)->municipio_id) == $key ? 'selected' : '' }}>
			    	{{ $municipio }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('municipio_id', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-6 col-xs-12 {{ $errors->has('cp') ? 'has-error' : '' }}">
    <label for="cp" class="control-label">{{ trans('customers.cp') }}</label>
    
        <input class="form-control input-sm " name="cp" type="text" id="cp" value="{{ old('cp', optional($customer)->cp) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('customers.cp__placeholder') }}">
        {!! $errors->first('cp', '<p class="help-block">:message</p>') !!}
    
</div>

<div class='row'></div>
<h3 class='header smaller lighter blue'>Contacto</h3>
<div class="form-group col-md-6 col-xs-12 {{ $errors->has('celular') ? 'has-error' : '' }}">
    <label for="celular" class="control-label">{{ trans('customers.celular') }}</label>
    
        <input class="form-control input-sm " name="celular" type="text" id="celular" value="{{ old('celular', optional($customer)->celular) }}" maxlength="255" placeholder="{{ trans('customers.celular__placeholder') }}">
        {!! $errors->first('celular', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-6 col-xs-12 {{ $errors->has('fijo') ? 'has-error' : '' }}">
    <label for="fijo" class="control-label">{{ trans('customers.fijo') }}</label>
    
        <input class="form-control input-sm " name="fijo" type="text" id="fijo" value="{{ old('fijo', optional($customer)->fijo) }}" maxlength="255" placeholder="{{ trans('customers.fijo__placeholder') }}">
        {!! $errors->first('fijo', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-6 col-xs-12 {{ $errors->has('email') ? 'has-error' : '' }}">
    <label for="email" class="control-label">{{ trans('customers.email') }}</label>
    
        <input class="form-control input-sm " name="email" type="text" id="email" value="{{ old('email', optional($customer)->email) }}" maxlength="255" placeholder="{{ trans('customers.email__placeholder') }}">
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    
</div>

@push('scripts')
<script type="text/javascript">
    $('#estado_id').change(function(){
        $.ajax({
            url: '{{ route('municipios.getCmbMunicipios') }}',
            type: 'GET',
            data: "estado="+$(this).val()+"&municipio="+$('#municipio_id option:selected').val(),
            dataType: 'json',
            beforeSend: function () {
                $("#loading12").show();
            },
            complete: function () {
                $("#loading12").hide();
            },
            success: function (data) {
                //alert(data);
                //$example.select2("destroy");
                $('#municipio_id').html('');
                $('#municipio_id').empty();
                $('#municipio_id').append($('<option></option>').text('Seleccionar').val('0'));
                /*/$.each(data, function (i) {
                    console.log(data[i]);
                    $('#municipio_id').append("<option " + data[i].selectec + " value=\"" + data[i].id + "\">" + data[i].name + "<\/option>");
                });*/
                $.each(data, function (obj, item) {  
                    $('#municipio_id').append("<option " + item.selectec + " value=\"" + item.id + "\">" + item.name + "<\/option>");
                });
                $("#municipio_id").chosen();
                $("#municipio_id").trigger("chosen:updated");
            }
        });
        
    });
</script>
@endpush
