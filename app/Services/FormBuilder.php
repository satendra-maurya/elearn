<?php

namespace App\Services;

use Form;

class FormBuilder {

    /**
     * Boot the Form Builder components.
     *
     * @return void
     */
    public static function boot() {
        Form::component('submitBootstrap', 'components.submit', [
            'value',
            'class' => '',
        ]);
        Form::component('controlBootstrap', 'components.control', [
            'type',
            'columns',
            'name',
            'errors',
            'label' => null,
            'value' => null,
            'placeholder' => null,
            'icon' => null
        ]);
        Form::component('selectBootstrap', 'components.select', [
            'name',
            'list' => [],
            'selected' => null,
            'label' => null,
        ]);
    }

}
