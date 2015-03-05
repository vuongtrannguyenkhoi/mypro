<?php namespace Portal;
use Qdesign\Models\Forum;
use Qdesign\Repositories\Topic\TopicInterface;
use View;
use App\Libraries\BackendController;
/**
 * Created by PhpStorm.
 * User: bluesky
 * Date: 5/4/14
 * Time: 10:01 PM
 */

class ForumsController extends BackendController {

    /**
     * @var \Qdesign\Repositories\Topic\TopicInterface
     */
    private $topic;
    /**
     * @var \Qdesign\Models\Forum
     */
    private $forum;

    public function __construct(TopicInterface $topic,Forum $forum)
    {

        $this->topic = $topic;
        $this->forum = $forum;
    }
    public function getTopics($forumId)
    {
        $this->data['forum'] = $this->forum->find($forumId);
        if(!$this->data['forum']){
            echo 'Forum not found!!!';
            die;
        }

        $this->data['topics'] = $this->topic->getAllByForumId($forumId);
        $this->data['topics']->setBaseUrl("#forums/{$forumId}/".$this->data['forum']->slug);
        return View::make('portal.forums.topics.index',$this->data);
	}

    public function getViewTopic($topicId)
    {
        $this->data['topic'] = $this->topic->byId($topicId);
        if(!$this->data['topic'])
        {
            echo('Topic not found!!!');
            die;
        }

        $this->data['forum'] = $this->forum->find($this->data['topic']->forum_id);
        if(!$this->data['forum']){
            echo 'Forum not found!!!';
            die;
        }

        return View::make('portal.forums.topics.detail',$this->data);
    }
    //be access only member
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        return View::make('portal.users.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('portal.users.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::only(
            'username',
            'email',
            'password',
            'password_confirmation',
            'role',
            'status'
        );
        if( $this->userform->save( $input ) )
        {
            // Success!
            return Redirect::to('portal/dashboard#users')
                ->with('status', 'success');
        } else {
            return Redirect::to('portal/dashboard#users/create')
                ->withInput()
                ->withErrors( $this->userform->errors() )
                ->with('status', 'error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

        $this->data['user'] = $this->user->byId($id);
        return View::make('portal.users.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {

        if( $this->userform->update( Input::all() ) )
        {
            // Success!
            return Redirect::to('portal/dashboard#users')
                ->with('status', 'success');
        } else {
            return Redirect::to('portal/dashboard#users/'.$id.'/edit')
                ->withInput()
                ->withErrors( $this->userform->errors() )
                ->with('status', 'error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        $this->user->delete($id);
        return Redirect::to('portal/dashboard#users');

    }


}