<?php

use App\User;

return [

    // Setting page url, will be used for get and post request
    'url' => 'workflow',

    // Any middleware you want to run on above route
    'middleware' => ['auth'],

    // default auth class
    'auth_class' => User::class,

    /*
     *  Enable roles
     */
    'role_class' => null,

    // View settings
    'layout_view' => 'workflow::layout',
    'flash_partial' => 'workflow::_flash',

    // Input wrapper and group class setting
    'input_wrapper_class' => 'form-group',
    'input_class' => 'form-control',
    'input_error_class' => 'has-error',
    'input_invalid_class' => 'is-invalid',
    'input_hint_class' => 'form-text text-muted',
    'input_error_feedback_class' => 'text-danger',


    // settings group
    'workflow_group' => function() {
        return 'default';
    }
];
