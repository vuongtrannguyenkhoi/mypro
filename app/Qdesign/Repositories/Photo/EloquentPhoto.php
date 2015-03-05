<?php namespace Qdesign\Repositories\Photo;

use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Qdesign\Repositories\RepositoryAbstract;
use Illuminate\Database\Eloquent\Model;
use DB;
class EloquentPhoto extends RepositoryAbstract implements PhotoInterface {
    public static $thumb_w = 360;
    public static $thumb_h = 150;
    /**
     * @var string
     */
    public static $path = 'upload/media/images/photo/';

    /**
     * @var
     */
    protected $modelInstance;

    // Class expects an Eloquent model
    public function __construct(Model $photo)
    {
        $this->model = $photo;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all(){
        return $this->model->all();
    }

    /**
     * @param $id
     * @return EloquentPhoto
     */
    public function byId($id)
    {
        return $this->find($id);
    }

    public function create(array $data)
    {
        $dataImg = $this->uploadImage('file');
        $photo = $this->model->create(array_merge($data,$dataImg));

        if( ! $photo )
        {
            return false;
        }

        return true;
    }

    public function update(array $data)
    {
        $photo = $this->find($data['id']);
        $dataImg = $this->uploadImage('file');
        $data = array_merge($data,$dataImg);
        $fields = array('name','photo','thumb','caption','alt','link','description');
        $photo->myUpdate($fields,$data);
        $photo->save();
        return true;
    }

    public function delete($id)
    {
        $photo = $this->find($id);
        $photo->delete();
        return true;
    }

    private function find($id){
        if(is_null($this->modelInstance))
            $this->modelInstance = $this->model->find($id);
        if(is_null($this->modelInstance))throw new PhotoNotFoundException('the photo with id='.$this->id.' not found');
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

        Image::make( $destinationPath.$filename )->resize(self::$thumb_w,null,function($constraint){
            $constraint->aspectRatio();
        })->save( $destinationPath.$filename_x_x );
        $data['photo'] = self::$path.$filename;
        $data['thumb'] = self::$path.$filename_x_x;
        return $data;
    }

    public function findByGallery($gallery)
    {
        $results = $this->model
                        ->where('gallery_id','=',$gallery)
                        ->orderBy('order')
                        ->get();
        return $results;
    }

    public function getBySlug($photo_slug)
    {
        return $this->model->where('slug','=',$photo_slug)->first();
    }
}
