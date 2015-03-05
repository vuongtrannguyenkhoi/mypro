<?php namespace Qdesign\Services\Form\Post;

use Qdesign\Services\Validation\ValidableInterface;
use Qdesign\Repositories\Post\PostInterface;

class PostForm {

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
     * @var \Qdesign\Repositories\Post\PostInterface
     */
    protected $post;

    public function __construct(ValidableInterface $validator, PostInterface $post)
    {
        $this->validator = $validator;
        $this->post = $post;
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
        return $this->post->create($input);
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

        return $this->post->update($input);
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