<?php namespace Api;

use App\Libraries\BaseController;
use Illuminate\Filesystem\Filesystem;

class RedactorsController extends BaseController {

    public function getImages()
    {
        $dir = 'upload/images/';
        $fileSystem = new Filesystem();
        $files = $fileSystem->allFiles($dir);
        $data = array();
        foreach ($files as $file) {
            $data[] = array(
              'thumb' => url($dir.'/'.$file->getFileName()),
              'image' => url($dir.'/'.$file->getFileName()),
              'title' => url($dir.'/'.$file->getFileName())
            );
        }
        return json_encode($data);

    }

    public function uploadImage()
    {
        // files storage folder
        $dir = 'upload/images/';

        $_FILES['file']['type'] = strtolower($_FILES['file']['type']);

        if ($_FILES['file']['type'] == 'image/png'
            || $_FILES['file']['type'] == 'image/jpg'
            || $_FILES['file']['type'] == 'image/gif'
            || $_FILES['file']['type'] == 'image/jpeg'
            || $_FILES['file']['type'] == 'image/pjpeg')
        {
            // setting file's mysterious name
            $file = $dir.md5(date('YmdHis')).'.jpg';

            // copying
            move_uploaded_file($_FILES['file']['tmp_name'], $file);

            // displaying file
            $array = array(
                'filelink' => url($file)
            );

            echo stripslashes(json_encode($array));
        }
    }

    public function uploadFile()
    {
        move_uploaded_file($_FILES['file']['tmp_name'], 'upload/files/'.$_FILES['file']['name']);

        $array = array(
            'filelink' => url('upload/files/'.$_FILES['file']['name']),
            'filename' => $_FILES['file']['name']
        );
        echo stripslashes(json_encode($array));
    }
}