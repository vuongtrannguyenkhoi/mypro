<?php namespace Qdesign\Repositories\Page;

use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Qdesign\Models\Seo;
use Qdesign\Repositories\RepositoryAbstract;
use Illuminate\Database\Eloquent\Model;
use DB;
class EloquentPage extends RepositoryAbstract implements PageInterface {
    public static $path = '/upload/media/images/page/';
    public static $thumb_w = 297;
    public static $thumb_h = 156;
    protected $modelInstance;
    // Class expects an Eloquent model
    public function __construct(Model $page)
    {
        $this->model = $page;
    }

    public function all(){
        return $this->model->all();
    }

    public function byId($id)
    {
        return $this->find($id);
    }

    public function bySlug($slug)
    {
        return $this->model->whereSlug($slug)->first();
    }

    public function create(array $data)
    {
        $dataImg = $this->uploadImage('file');
        unset($data['file']);
        $data['slug'] = $this->slug($data['slug']);
        $data['content'] = stripslashes($data['content']) ;
        $data['description'] = stripslashes($data['description']) ;
        $page = $this->model->create(array_merge($data,$dataImg));

        if( ! $page )
        {
            return false;
        }
        //SEO
        $seo = $this->saveSeo($data);
        $page->seo()->save($seo);


        return true;
    }

    public function update(array $data)
    {
        $page = $this->find($data['id']);
        $dataImg = $this->uploadImage('file');
        $fields = array(
            'name',
            'slug',
            'thumb',
            'photo',
            'description',
            'content',
        );
        $data['slug'] = $this->slug($data['slug']);
        $data['content'] = stripslashes($data['content']) ;
        $data['description'] = stripslashes($data['description']) ;
        $page->myUpdate($fields,array_merge($data,$dataImg));
        $page->save();

        $seo = $page->seo->first();
        $seo->title = $data['site_title'];
        $seo->description = $data['site_meta_description'];
        $seo->keywords = $data['site_meta_keywords'];
        $seo->save();
        return true;
    }

    public function delete($id)
    {
        $page = $this->find($id);
        $page->delete();
        return true;
    }

    private function find($id){
        if(is_null($this->modelInstance))
            $this->modelInstance = $this->model->find($id);
        if(is_null($this->modelInstance))throw new PageNotFoundException('the page with id='.$this->id.' not found');
        return $this->modelInstance;
    }
    private function uploadImage($fileName){
        $dataImg = array();
        if(!Input::hasFile($fileName))
            return $dataImg;
        $file = Input::file($fileName);
        $extension = $file->getClientOriginalExtension();
        $filename = sha1(time().time()).".{$extension}";

        $destinationPath = public_path().self::$path;

        //upload
        Image::make($file->getRealPath())->save($destinationPath.$filename);
        //resize
        $filename_x_x = 'thumb_'.$filename;

        Image::make( $destinationPath.$filename )->resize(self::$thumb_w,null,function($constraint){
            $constraint->aspectRatio();
        })->save( $destinationPath.$filename_x_x );
        $data['photo'] = self::$path.$filename;
        $data['thumb'] = self::$path.$filename_x_x;
        return $data;
    }
}
