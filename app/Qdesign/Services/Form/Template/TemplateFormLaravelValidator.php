<?php namespace Qdesign\Services\Form\Template;

use Qdesign\Services\Validation\AbstractLaravelValidator;

class TemplateFormLaravelValidator extends AbstractLaravelValidator {

    /**
     * Validation rules
     *
     * @var Array
     */
    protected $rules = array(
        'template'  =>  'required',
    );

}