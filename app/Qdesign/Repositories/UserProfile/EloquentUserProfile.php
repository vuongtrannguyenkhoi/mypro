<?php namespace Qdesign\Repositories\UserProfile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Qdesign\Repositories\RepositoryAbstract;
use Illuminate\Database\Eloquent\Model;
use DB;

class EloquentUserProfile extends RepositoryAbstract implements UserProfileInterface {

    public static $thumb_w = 360;
    public static $thumb_h = 150;
    /**
     * @var string
     */
    public static $path = 'upload/images/member/avata/';

    protected $modelInstance;
    // Class expects an Eloquent model
    public function __construct(Model $profile)
    {
        $this->model = $profile;
    }

    public function create(array $data)
    {
        $dataImg = $this->uploadImage('file');
        unset($data['file']);
        $profile = $this->model->create(array_merge($data,$dataImg));

        if( ! $profile )
        {
            return false;
        }
        $profile->user()->associate(Auth::user());
        $profile->save();
        return true;
    }

    public function update(array $data)
    {
        $profile = Auth::user()->profile;
        $dataImg = $this->uploadImage('file');
        unset($data['file']);

        $fields = array(
            'first_name',
            'last_name',
            'photo',
            'thumb',
        );
        $profile->myUpdate($fields,array_merge($data,$dataImg)) ;
        $profile->save();
        return true;
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

}
