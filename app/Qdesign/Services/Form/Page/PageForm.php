<?php namespace Qdesign\Services\Form\Page;

use Qdesign\Services\Validation\ValidableInterface;
use Qdesign\Repositories\Page\PageInterface;

class PageForm {

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
     * @var \Qdesign\Repositories\Page\PageInterface
     */
    protected $page;

    public function __construct(ValidableInterface $validator, PageInterface $page)
    {
        $this->validator = $validator;
        $this->page = $page;
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
        return $this->page->create($input);
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

        return $this->page->update($input);
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