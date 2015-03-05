<?php namespace Qdesign\Services\Form\Box;

use Qdesign\Services\Validation\AbstractLaravelValidator;

class BoxFormLaravelValidator extends AbstractLaravelValidator {

    /**
     * Validation rules
     *
     * @var Array
     */
    protected $rules = array(
        'name'  =>  'required',
        'slug'  =>  'required',
    );

}