<?php namespace Qdesign\Repositories;

use Qdesign\Models\Seo;

abstract class RepositoryAbstract {
    protected $model;
    /**
     * Make a string "slug-friendly" for URLs
     * @param  string $string  Human-friendly tag
     * @return string       Computer-friendly tag
     */
    protected function slug($string)
    {
        return filter_var( str_replace(' ', '-', strtolower( trim($string) ) ), FILTER_SANITIZE_URL);
    }

    protected  function removeFile($file){
        if ( $file && file_exists( public_path().$file )) {
            unlink( public_path().$file );
            return true;
        }
        return false;
    }

    public  function updateOrder($ids){
        $i = 1;
        foreach ($ids as $id) {
            $this->model->where('id','=',$id)
                ->update(array('order'=>$i++));
        }
        return true;
    }

    public function saveSeo($data){
        $seo = new Seo;
        $seo->title = $data['site_title'];
        $seo->description = $data['site_meta_description'];
        $seo->keywords = $data['site_meta_keywords'];
        $seo->save();
        return $seo;
    }

    public function __get($key)
    {
        if (method_exists($this, $key))
        {
            return $this->{$key}();
        }

        return $this->$key;
    }
}