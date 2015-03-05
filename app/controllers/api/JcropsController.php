<?php namespace Api;

use App\Libraries\BaseController;
use Input;
use SplFileInfo;
use View;
use Intervention\Image\Facades\Image;
use Whoops\Example\Exception;

class JcropsController extends BaseController {

    public function index()
    {
        $data['link'] = Input::get('link');
        return View::make('admin.posts.jcrop',$data);
    }

    public function postSave()
    {
        $input = Input::all();

        $file = url($input['file']);
        $info = new SplFileInfo($input['file']);
        $w = $input['w'];
        $h = $input['h'];
        $x = $input['x'];
        $y = $input['y'];
        //crop
        $img = Image::make( $file )->crop($w,$h,$x,$y)->save( public_path().$info->getPathName() )
            ->save( public_path().$info->getPath().'/jcrop'.$info->getFileName() );
        $photo = url($info->getPath().'/'.$img->basename);
        //make thumbnail
        $thumb = $img->resize(200,null,function($constraint){
            $constraint->aspectRatio();
        })->save( public_path().$info->getPath().'/thumb_'.$info->getFileName() )
            ->save( public_path().$info->getPath().'/thumb_jcrop'.$info->getFileName() );

        $data = array(
          'photo' => $photo,
          'thumb' => url($info->getPath().'/'.$thumb->basename),
        );

        echo json_encode($data);
    }

    public function postScale()
    {
        $input = Input::all();
        $file = url($input['file']);
        $info = new SplFileInfo($input['file']);
        $img = Image::make( $file );
//
            $photo = $img->resize($input['scaleW'],$input['scaleH'])->save( public_path().'/'.$info->getPath().'/'.$info->getFileName() );

        $data = array(
            'url' => $file,
            'message' => 'scale',
        );

        echo json_encode($data);
    }

    public function postCrop()
    {
        $input = Input::all();
        $file = url($input['file']);
        $info = new SplFileInfo($input['file']);
        $w = $input['w'];
        $h = $input['h'];
        $x = $input['x'];
        $y = $input['y'];
        //crop
        $img = Image::make( $file );
        $img->crop($w,$h,$x,$y)->save( public_path().'/'.$info->getPath().'/'.$info->getFileName() );
        $data = array(
            'url' => $file,
            'message' => 'crop',
        );

        echo json_encode($data);
    }
}