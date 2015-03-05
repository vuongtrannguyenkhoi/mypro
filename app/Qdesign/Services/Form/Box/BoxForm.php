<?php namespace Qdesign\Services\Form\Box;

use Qdesign\Services\Validation\ValidableInterface;
use Qdesign\Repositories\Box\BoxInterface;

class BoxForm {

    /**
     * Form Data
     *
     * @var array
     */
    protected $data;


    /**
     * @var \Qdesign\Services\Validation\ValidableInterface
     */
    protected $validator;


    /**
     * @var \Qdesign\Repositories\Box\BoxInterface
     */
    protected $box;

    public function __construct(ValidableInterface $validator, BoxInterface $box)
    {
        $this->validator = $validator;
        $this->box = $box;
    }

    /**
     * @param array $input
     * @return bool
     */
    public function save(array $input)
    {
        if( ! $this->valid($input) )
        {
            return false;
        }
        return $this->box->create($input);
    }


    /**
     * @param array $input
     * @return bool
     */
    public function update(array $input)
    {
        if( ! $this->valid($input) )
        {
            return false;
        }

        return $this->box->update($input);
    }

    /**
     * Return any validation errors
     *
     * @return array
     */
    public function errors()
    {
        return $this->validator->errors();
    }

    /**
     * @param array $input
     * @return mixed
     */
    protected function valid(array $input)
    {
        return $this->validator->with($input)->passes();
    }
}