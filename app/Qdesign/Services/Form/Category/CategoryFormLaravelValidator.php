<?php namespace Qdesign\Services\Form\Category;

use Qdesign\Services\Validation\AbstractLaravelValidator;

class CategoryFormLaravelValidator extends AbstractLaravelValidator {

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