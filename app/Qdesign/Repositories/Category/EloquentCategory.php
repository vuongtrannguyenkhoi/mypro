<?php namespace Qdesign\Repositories\Category;

use Qdesign\Models\Category;
use Qdesign\Repositories\RepositoryAbstract;
use Illuminate\Database\Eloquent\Model;
use DB;
class EloquentCategory extends RepositoryAbstract implements CategoryInterface {

    public $modelInstance;
    // Class expects an Eloquent model
    public function __construct(Model $category)
    {
        $this->model = $category;
    }

    /**
     * get all categories
     * @return mixed
     */
    public function all(){
        return DB::table('view_depth_nodes as node')
            ->select(array(
                'id',
                'slug',
                'name',
                'depth',
                'active'
            ))
            ->get();
    }

    /**
     * get category by category id
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|Model|static
     * @throws CategoryNotFoundException
     */
    public function byId($id)
    {
        return $this->find($id);
    }

    /**
     * get category by category slug
     * @param $slug
     * @return mixed
     */
    public function bySlug($slug){
        return $this->model->whereSlug($slug)->first();
    }

    /**
     * insert new category
     * @param array $data
     * @return bool
     * @throws CategoryNotFoundException
     */
    public function create(array $data)
    {
        $data['active'] = isset($data['active']) ? true: false;
        $parent_id = $data['parent_id'];
        unset($data['parent_id']);
        $parent = $this->find( $parent_id );
        $data['slug'] = $this->slug($data['slug']);
        $sql = "UPDATE categories
			SET left_side = IF(left_side > ?, left_side + 2, left_side)
			, right_side = IF(right_side >= ?, right_side + 2, right_side)
			WHERE right_side >= ?";
        DB::update( $sql , array($parent->right_side, $parent->right_side, $parent->right_side));

        $data['left_side'] = $parent->right_side;
        $data['right_side'] = $parent->right_side + 1;
        // Create the article
        $category = $this->model->create($data);

        if( ! $category )
        {
            return false;
        }
        return true;
    }

    /**
     * update an category
     * @param array $data
     * @return bool
     * @throws CategoryNotFoundException
     */
    public function update(array $data)
    {
        $category = $this->find($data['id']);
        $category->name = $data['name'];
        $category->active = isset($data['active']) ? true: false;
        $category->slug = $this->slug($data['slug']);
        $category->description = $data['description'];
        $category->page_id = isset($data['page_id']) ? $data['page_id'] : null;
        $category->gallery_id = isset($data['gallery_id']) ? $data['gallery_id'] : null;
        $category->template = isset($data['template']) ? $data['template']:null;
        $category->controller = isset($data['controller']) ? $data['controller']:null;
        $category->save();
        return true;
    }

    /**
     * delete category by id
     * @param $id
     * @return bool
     * @throws CategoryNotFoundException
     */
    public function delete($id)
    {
        $delete_node = $this->find( $id );
        if (empty( $delete_node )) {
            return false;
        }
        $sql = "UPDATE categories
				SET left_side = IF(left_side > {$delete_node->left_side}, left_side - 2, left_side)
				, right_side = IF(right_side > {$delete_node->right_side}, right_side - 2, right_side)
				WHERE right_side > {$delete_node->right_side}";
        DB::update( $sql );
        $delete_node->delete();
        return true;
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|Model|static
     * @throws CategoryNotFoundException
     */
    private function find($id){
        if(is_null($this->modelInstance))
            $this->modelInstance = $this->model->find($id);
        if(is_null($this->modelInstance))throw new CategoryNotFoundException('the category with id='.$this->id.' not found');
        return $this->modelInstance;
    }


    /**
     * update order categories
     * @param $categories
     * @return null
     */
    public function updateOrder ( $categories ){
        if (count( $categories)) {
            foreach ($categories as $category) {
                if ($category['item_id']!='') {
                    $o = $this->model->find($category['item_id']);
                    $o->left_side = $category['left'];
                    $o->right_side = $category['right'];
                    $o->save();
                }
            }
        }
        return null;
    }

    //front end
    /**
     * @return mixed
     */
    public function getFrontEndCategories()
    {
        $sql = "select 
                node.id AS id,
                node.controller AS controller,
                node.slug AS slug,
                node.name,
                node.left_side AS left_side,
                node.right_side AS right_side,
                node.display AS display,
                node.template_id AS template_id,
                node.categorytype_id AS categorytype_id,
                node.default_page AS default_page,
                node.page_id AS page_id,
                node.external_link AS external_link,
                node.target AS target,
                node.display_title AS display_title,
                node.meta_keywords AS meta_keywords,
                node.meta_description AS meta_description,
                node.browser_page_title AS browser_page_title,
                node.active AS active,
                node.created_at AS created_at,
                node.updated_at AS updated_at,
                node.created_by AS created_by,
                node.updated_by AS updated_by,
                parent.controller AS parentController,
                parent.slug AS parentSlug,
                (count(parent.slug) - 1) AS depth
            from
                (categories node
                join categories parent)
            where
                (node.left_side between parent.left_side and parent.right_side and node.active = 1)
            group by node.slug
            order by node.left_side";
        return DB::select($sql);
    }

    /**
     * @param $category_slug
     * @return mixed
     */
    public function children($category_slug)
    {
        return DB::table('view_branch')
            ->select(array(
                'id',
                'name',
                'depth',
                'slug',
                'parent_slug',
            ))
            ->where('parent_slug','=',$category_slug)
            ->where('slug','<>',$category_slug)
            ->get();
    }

    public function getCategoriesHaveController($controller)
    {
        return $this->model->whereController($controller)->get();
    }
}
