<?php namespace Qdesign\Services\Form\Page;

use Qdesign\Services\Validation\AbstractLaravelValidator;

class PageFormLaravelValidator extends AbstractLaravelValidator {

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