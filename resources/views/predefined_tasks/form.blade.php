
<div class="form-group col-md-4 {{ $errors->has('task_id') ? 'has-error' : '' }}">
    <label for="task_id" class="control-label">{{ trans('predefined_tasks.task_id') }}</label>
    
        <select class="form-control" id="task_id" name="task_id" required="true">
        	    <option value="" style="display: none;" {{ old('task_id', optional($predefinedTask)->task_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('predefined_tasks.task_id__placeholder') }}</option>
        	@foreach ($tasks as $key => $task)
			    <option value="{{ $key }}" {{ old('task_id', optional($predefinedTask)->task_id) == $key ? 'selected' : '' }}>
			    	{{ $task }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('task_id', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-4 {{ $errors->has('detail') ? 'has-error' : '' }}">
    <label for="detail" class="control-label">{{ trans('predefined_tasks.detail') }}</label>
        <textArea class="form-control input-sm " name="detail" id="detail" rows='2' required="true">
            {{old('detail', optional($predefinedTask)->detail)}}
        </textarea>
        {!! $errors->first('detail', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-4 {{ $errors->has('activo') ? 'has-error' : '' }}">
    <label for="activo" class="control-label">{{ trans('predefined_tasks.activo') }}</label>
    
        <div class="checkbox">
            <label for="activo_1">
            	<input id="activo_1" class="" name="activo" type="checkbox" value="1" {{ old('activo', optional($predefinedTask)->activo) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('activo', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-4 {{ $errors->has('dias') ? 'has-error' : '' }}" style="clear:left;">
    <label for="dias" class="control-label">{{ trans('predefined_tasks.dias') }}</label>
    
        <input class="form-control input-sm " name="dias" type="text" id="dias" value="{{ old('dias', optional($predefinedTask)->dias) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('predefined_tasks.dias__placeholder') }}">
        {!! $errors->first('dias', '<p class="help-block">:message</p>') !!}
    
</div>