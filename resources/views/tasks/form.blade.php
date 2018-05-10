
<div class="form-group col-md-4 {{ $errors->has('task') ? 'has-error' : '' }}">
    <label for="task" class="control-label">{{ trans('tasks.task') }}</label>
    
        <input class="form-control input-sm " name="task" type="text" id="task" value="{{ old('task', optional($task)->task) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('tasks.task__placeholder') }}">
        {!! $errors->first('task', '<p class="help-block">:message</p>') !!}
    
</div>
