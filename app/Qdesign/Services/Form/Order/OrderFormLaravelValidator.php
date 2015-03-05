<?php namespace Qdesign\Services\Form\Order;

use Qdesign\Services\Validation\AbstractLaravelValidator;

class OrderFormLaravelValidator extends AbstractLaravelValidator {

    /**
     * Validation rules
     *
     * @var Array
     */
    protected $rules = array(
        'customer_name'  =>  'required',
        'phone'  =>  'required',
        'address'  =>  'required',
        'email'  =>  'email',
    );

}