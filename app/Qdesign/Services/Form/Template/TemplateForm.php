<?php namespace Qdesign\Services\Form\Template;

use Qdesign\Services\Validation\ValidableInterface;
use Qdesign\Repositories\Template\TemplateInterface;

class TemplateForm {

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
     * @var \Qdesign\Repositories\Template\TemplateInterface
     */
    protected $template;

    public function __construct(ValidableInterface $validator, TemplateInterface $template)
    {
        $this->validator = $validator;
        $this->template = $template;
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
        return $this->template->create($input);
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

        return $this->template->update($input);
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