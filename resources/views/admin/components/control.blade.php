<div class="form-group {{ $columns == 0 ? '': 'col-lg-' . $columns }} {{ $errors->has($name) ? 'has-error' : '' }}">
    @if($label)
    {!! Form::label($name, $label, ['class' => 'control-label']) !!}
    @endif
    @if($type == 'textarea')
    {!! Form::textarea($name, $value, ['class' => 'form-control', 'placeholder' => $placeholder]) !!} 
    @else
        @if($icon)
        <div class="input-group">
            @if($type == 'password')
                {!! Form::input($type, $name, $value, ['class' => 'form-control','autocomplete' => 'off', 'placeholder' => $placeholder]) !!}
            @else
                {!! Form::input($type, $name, $value, ['class' => 'form-control', 'placeholder' => $placeholder]) !!}
            @endif
            <div class="input-group-addon">
                <i class="fa fa-{!! $icon !!}"></i>
            </div>
        </div>
        @else
        {!! Form::input($type, $name, $value, ['class' => 'form-control invite-txt', 'placeholder' => $placeholder]) !!}
        @endif
    @endif
    {!! $errors->first($name, '<p class="help-block">:message</p>') !!}           
</div>