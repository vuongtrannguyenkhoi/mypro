<?php namespace Qdesign\Services\Form\Login;

use Qdesign\Services\Validation\AbstractLaravelValidator;

class LoginFormLaravelValidator extends AbstractLaravelValidator {

    /**
     * Validation rules
     *
     * @var Array
     */
    protected $rules = array(
        'username' 	=>  'required',
        'password' 	=>  'required',
    );

}