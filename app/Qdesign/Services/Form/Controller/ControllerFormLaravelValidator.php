<?php namespace Qdesign\Services\Form\Controller;

use Qdesign\Services\Validation\AbstractLaravelValidator;

class ControllerFormLaravelValidator extends AbstractLaravelValidator {

    /**
     * Validation rules
     *
     * @var Array
     */
    protected $rules = array(
        'controller'  =>  'required',
    );

}