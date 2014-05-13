<?php

function form_input($type, $name, $label, $errors, $value = null, array $labelOpt = [], array $inputOpt = [])
{
    return  "<div class=\"form-group ".($errors->has($name) ? 'has-error' : '')."\">".
                Form::label($name, $label, $labelOpt).
                Form::{$type}($name, $value, $inputOpt).
                $errors->first($name, '<span class="error">:message</span>').
            "</div>";
}

function form_text($name, $label, $errors, $value = null, array $labelOpt = [], array $inputOpt = [])
{
    return form_input('text', $name, $label, $errors, $value, $labelOpt, $inputOpt);
}

function form_email($name, $label, $errors, $value = null, array $labelOpt = [], array $inputOpt = [])
{
    return form_input('email', $name, $label, $errors, $value, $labelOpt, $inputOpt);
}

function form_password($name, $label, $errors, $value = null, array $labelOpt = [], array $inputOpt = [])
{
    return form_input('password', $name, $label, $errors, $value, $labelOpt, $inputOpt);
}

function form_textarea($name, $label, $errors, $value = null, array $labelOpt = [], array $inputOpt = [])
{
    return form_input('textarea', $name, $label, $errors, $value, $labelOpt, $inputOpt);
}

function form_select($name, $label, array $value = [], $errors, $selected = null, array $labelOpt = [], array $inputOpt = [])
{
    return "<div class=\"form-group ".($errors->has($name) ? 'has-error' : '')."\">".
                Form::label($name, $label, $labelOpt)." ".
                Form::select($name, $value, $selected, $inputOpt).
                $errors->first($name, '<span class="error">:message</span>').
            "</div>";
}

function form_hidden($name, $errors, $value = null)
{
    return "<div class=\"form-group ".($errors->has($name) ? 'has-error' : '')."\">".
                Form::hidden($name, $value).
                $errors->first($name, '<span class="error">:message</span>').
            "</div>";
}

function form_submit($value, array $option = [])
{
    return  "<div class=\"form-group\">".
                Form::submit($value, $option).
            "</div>";
}