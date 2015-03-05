<?php namespace Qdesign\Repositories\Gallery;

use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Qdesign\Repositories\RepositoryAbstract;
use Illuminate\Database\Eloquent\Model;
use DB;
class EloquentGallery extends RepositoryAbstract implements GalleryInterface {

    /**
     * @var string
     */
    public static $path = 'upload/media/images/gallery/';

    /**
     * @var
     */
    protected $modelInstance;

    // Class expects an Eloquent model
    public function __construct(Model $gallery)
    {
        $this->model = $gallery;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all(){
        return $this->model->all();
    }

    /**
     * @param $id
     * @return EloquentGallery
     */
    public function byId($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        $dataImg = $this->uploadImage('file');
        $gallery = $this->model->create(array_merge($data,$dataImg));

        if( ! $gallery )
        {
            return false;
        }

        return true;
    }

    public function update(array $data)
    {
        $gallery = $this->find($data['id']);
        $dataImg = $this->uploadImage('file');
        $data = array_merge($data,$dataImg);
        $fields = array('name','photo','thumb');
        $gallery->myUpdate($fields,$data);
        $gallery->save();
        return true;
    }

    public function delete($id)
    {
        $gallery = $this->find($id);
        $gallery->delete();
        return true;
    }

    private function find($id){
        if(is_null($this->modelInstance))
            $this->modelInstance = $this->model->find($id);
        if(is_null($this->modelInstance))throw new GalleryNotFoundException('the gallery with id='.$this->id.' not found');
        return $this->modelInstance;
    }

    private function uploadImage($fileName){
        $dataImg = array();
        if(!Input::hasFile($fileName))
            return $dataImg;
        $file = Input::file($fileName);
        $extension = $file->getClientOriginalExtension();
        $filename = sha1(time().time()).".{$extension}";

        $destinationPath = self::$path;

        //upload
        Image::make($file->getRealPath())->save($destinationPath.$filename);
        //resize
        $filename_x_x = 'thumb_'.$filename;

        Image::make( $destinationPath.$filename )->resize(30,null,function($constraint){
            $constraint->aspectRatio();
        })->save( $destinationPath.$filename_x_x );
        $data['photo'] = self::$path.$filename;
        $data['thumb'] = self::$path.$filename_x_x;
        return $data;
    }
    //database relationship
    public function photos(){
        return $this->find($this->id)->photos;
    }
}
