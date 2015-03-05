<?php namespace Qdesign\Repositories\Topic;

use Illuminate\Support\Facades\Auth;
use Qdesign\Repositories\RepositoryAbstract;
use Illuminate\Database\Eloquent\Model;
use DB;
class EloquentTopic extends RepositoryAbstract implements TopicInterface {

    protected $modelInstance;
    // Class expects an Eloquent model
    public function __construct(Model $topic)
    {
        $this->model = $topic;
    }

    public function all(){
        return $this->model->with('forum')->get();
    }

    public function allBelongToMember()
    {
        return $this->model
                    ->whereCreatedBy(Auth::user()->id)
                    ->with('forum')
                    ->get();
    }

    public function getAllByForumId($forumId,$record = 9)
    {
        return $this->model
            ->with('forum')
            ->whereForumId($forumId)
            ->paginate($record);
    }
    public function byId($id)
    {
        return $this->model->with('author')->find($id);
    }

    public function bySlug($slug){
        return $this->model->whereSlug($slug)
            ->first();
    }

    public function create(array $data)
    {
        $data['slug'] = $this->slug($data['slug']);
        $data['content'] = stripslashes($data['content']) ;
        $topic = $this->model->create($data);

        if( ! $topic )
        {
            return false;
        }

        return true;
    }

    public function update(array $data)
    {
        $topic = $this->find($data['id']);
        $fields = array(
            'name',
            'slug',
            'description',
            'content',
            'meta_descriptions',
            'meta_keywords',
            'forum_id',
        );
        $data['slug'] = $this->slug($data['slug']);
        $data['content'] = stripslashes($data['content']) ;
        $topic->myUpdate($fields,$data);
        $topic->save();
        return true;
    }

    public function delete($id)
    {
        $topic = $this->find($id);
        if($topic){
            $topic->delete();
            return true;
        }
        return false;
    }

    private function find($id){
        if(is_null($this->modelInstance))
            $this->modelInstance = $this->model->find($id);
        if(is_null($this->modelInstance))throw new TopicNotFoundException('the topic with id='.$this->id.' not found');
        return $this->modelInstance;
    }

}
