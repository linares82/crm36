
<div class="form-group col-md-6 {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-3 control-label">{{ trans('users.name') }}</label>
    <div class="col-md-9">
        <input class="form-control input-sm " name="name" type="text" id="name" value="{{ old('name', optional($user)->name) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('users.name__placeholder') }}">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-6 {{ $errors->has('email') ? 'has-error' : '' }}">
    <label for="email" class="col-md-3 control-label">{{ trans('users.email') }}</label>
    <div class="col-md-9">
        <input class="form-control input-sm " name="email" type="text" id="email" value="{{ old('email', optional($user)->email) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('users.email__placeholder') }}">
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-6 {{ $errors->has('password') ? ' has-error' : '' }}">
    <label for="password" class="col-md-3 control-label">Password</label>
    <div class="col-md-9">
        <input id="password" type="password" class="form-control" name="password">
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group col-md-6">
    <label for="password-confirm" class="col-md-3 control-label">Confirm Password</label>
    <div class="col-md-9">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
    </div>
</div>

