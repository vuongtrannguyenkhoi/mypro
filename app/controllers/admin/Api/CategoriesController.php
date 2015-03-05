<?php namespace Admin\Api;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Qdesign\Repositories\Category\CategoryInterface;

class CategoriesController extends Controller {

    /**
     * @var \Qdesign\Repositories\Category\CategoryInterface
     */
    private $category;

    public function __construct(CategoryInterface $category)
    {
        $this->category = $category;
    }
    public function updateActiveStatus()
    {
        $input = Input::all();

        $category = $this->category->byId($input['id']);
        $category->active = $input['value'];
        if($category->save())
            $jsonData = array(
                'status' => 1,
                'message' => 'done'
            );
        else
            $jsonData = array(
                'status' => 0,
                'message' => 'Failure'
            );

        echo json_encode($jsonData);
    }

    public function getCategory($id)
    {
        $category = $this->category->byId($id)->toJson();

        if(!empty($category))
            $jsonData = array(
                'status' => 1,
                'message' => 'done',
                'category' => $category
            );
        else
            $jsonData = array(
                'status' => 0,
                'message' => 'Failure'
            );
        echo json_encode($jsonData);
    }
}