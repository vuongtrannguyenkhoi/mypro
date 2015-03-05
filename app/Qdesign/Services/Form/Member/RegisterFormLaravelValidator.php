<?php namespace Qdesign\Services\Form\Member\Register;

use Qdesign\Services\Validation\AbstractLaravelValidator;

class RegisterFormLaravelValidator extends AbstractLaravelValidator {

    /**
     * Validation rules
     *
     * @var Array
     */
    protected $rules = array(
        'username'      => 'required',
        'email' 	=>  'email',
        'password' 	=>  'required',
    );

}