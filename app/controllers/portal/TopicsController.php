<?php namespace Portal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Qdesign\Models\Forum;
use Qdesign\Repositories\Topic\TopicInterface;
use Qdesign\Services\Form\Topic\TopicForm;
use View;
use App\Libraries\BackendController;
/**
 * Created by PhpStorm.
 * User: bluesky
 * Date: 5/4/14
 * Time: 10:01 PM
 */

class TopicsController extends BackendController {
    /**
     * @var \Qdesign\Models\Topic
     */
    private $topic;
    /**
     * @var \Qdesign\Services\Form\Topic\TopicForm
     */
    private $topicForm;
    /**
     * @var Forum
     */
    private $forum;

    public function __construct(Forum $forum,TopicInterface $topic,TopicForm $topicForm)
    {
        // Closure as callback
        $this->beforeFilter(function(){
            if(!Auth::check()) {
                return Redirect::guest('login');
            }
        });
        $this->topic = $topic;
        $this->topicForm = $topicForm;
        $this->forum = $forum;
    }
    //be access only member
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        return View::make('portal.topics.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->data['forums'] = $this->forum->all();
        return View::make('portal.topics.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        if( $this->topicForm->save( Input::all() ) )
        {
            // Success!
            return Redirect::to('portal/dashboard#topics')
                ->with('status', 'success');
        } else {
            return Redirect::to('portal/dashboard#topics/create')
                ->withInput()
                ->withErrors( $this->topicForm->errors() )
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
        $this->data['forums'] = $this->forum->all();
        $this->data['topic'] = $this->topic->byId($id);
        return View::make('portal.topics.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {

        if( $this->topic->update( Input::all() ) )
        {
            // Success!
            return Redirect::to('portal/dashboard#topics')
                ->with('status', 'success');
        } else {
            return Redirect::to('portal/dashboard#topics/'.$id.'/edit')
                ->withInput()
                ->withErrors( $this->topicForm->errors() )
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
        $this->topic->delete($id);
        return Redirect::to('portal/dashboard#topics');

    }


    public function getDatatable()
    {
        return \Datatable::collection($this->topic->allBelongToMember())
            ->addColumn('name',function($model)
                {
                    return $model->name;
                }
            )
            ->addColumn('forum',function($model)
                {
                    return $model->forum->name;
                }
            )
            ->addColumn('created_at',function($model)
                {
                    return $model->created_at ? $model->created_at->diffForHumans() : '';
                }
            )
            ->addColumn('updated_at',function($model)
                {
                    return $model->updated_at->diffForHumans();
                }
            )
            ->addColumn('edit',function($model)
                {
                    return "<a href='#topics/{$model->id}/edit'>edit</a>";
                }
            )
            ->addColumn('delete',function($model)
                {
                    return '<form method="POST" action="'.url('portal/topics/'.$model->id).'" accept-charset="UTF-8" class="pull-right">
                    <input name="_method" type="hidden" value="DELETE">
                    <input class="btn btn-warning btn-xs" type="submit" value="delete">
                    </form>';
                }
            )
            ->searchColumns(
                'name'

            )
            ->orderColumns('created_at','asc')
            ->make();
    }

}