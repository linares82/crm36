
<div class="form-group col-md-6 {{ $errors->has('task_id') ? 'has-error' : '' }}">

    <label for="task_id" class="control-label">{{ trans('related_tasks.task_id') }}</label>
        <input class="form-control input-sm " name="oportunity_id" type="hidden" id="oportunity_id" value="<?php echo (isset($oportunity_id))?$oportunity_id:old('oportunity_id', optional($related_task)->oportunity_id); ?>" minlength="1" maxlength="255" required="true" placeholder="{{ trans('customers.oportunity_id__placeholder') }}">
        <select class="chosen-select" id="task_id" name="task_id" required="true" style="width:100%">
        	    <option value="" style="display: none;" {{ old('task_id', optional($relatedTask)->task_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('related_tasks.task_id__placeholder') }}</option>
                    @foreach ($tasks as $key => $task)
			    <option value="{{ $key }}" {{ old('task_id', optional($relatedTask)->task_id) == $key ? 'selected' : '' }}>
			    	{{ $task }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('task_id', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-6 {{ $errors->has('detail') ? 'has-error' : '' }}">
    <label for="detail" class="control-label">{{ trans('related_tasks.detail') }}</label>
    
        <textArea class="form-control input-sm " name="detail" id="detail" rows='2' required="true">
        </textarea>
        {!! $errors->first('detail', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-6 {{ $errors->has('fecha') ? 'has-error' : '' }}">
    <label for="fecha" class="control-label">{{ trans('related_tasks.fecha') }}</label>
    
        <input class="form-control input-sm " name="fecha" type="text" id="fecha" value="{{ old('fecha', optional($relatedTask)->fecha) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('related_tasks.fecha__placeholder') }}">
        {!! $errors->first('fecha', '<p class="help-block">:message</p>') !!}
    
</div>







