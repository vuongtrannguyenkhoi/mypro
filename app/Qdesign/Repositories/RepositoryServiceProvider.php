<?php namespace Qdesign\Repositories;


use Illuminate\Support\ServiceProvider;
use Qdesign\Models\Category;
use Qdesign\Models\Controller;
use Qdesign\Models\Gallery;
use Qdesign\Models\Order;
use Qdesign\Models\Photo;
use Qdesign\Models\Page;
use Qdesign\Models\Box;
use Qdesign\Models\Profile;
use Qdesign\Models\Template;
use Qdesign\Models\Topic;
use Qdesign\Models\User;
use Qdesign\Models\Post;
use Qdesign\Models\Siteconfig;
use Qdesign\Models\UserProfile;
use Qdesign\Repositories\Category\EloquentCategory;
use Qdesign\Repositories\Controller\EloquentController;
use Qdesign\Repositories\Gallery\EloquentGallery;
use Qdesign\Repositories\Order\EloquentOrder;
use Qdesign\Repositories\Photo\EloquentPhoto;
use Qdesign\Repositories\Page\EloquentPage;
use Qdesign\Repositories\Post\EloquentPost;
use Qdesign\Repositories\Box\EloquentBox;
use Qdesign\Repositories\Profile\EloquentProfile;
use Qdesign\Repositories\Template\EloquentTemplate;
use Qdesign\Repositories\Topic\EloquentTopic;
use Qdesign\Repositories\User\EloquentUser;
use Qdesign\Repositories\Siteconfig\EloquentSiteconfig;
use Qdesign\Repositories\UserProfile\EloquentUserProfile;

class RepositoryServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        //DB User
        $app->bind('Qdesign\Repositories\User\UserInterface',function($app)
        {
            return new EloquentUser(new User);
        });

        //DB Profile
        $app->bind('Qdesign\Repositories\Profile\ProfileInterface',function($app)
        {
            return new EloquentProfile(new Profile);
        });
        //DB Siteconfig
        $app->bind('Qdesign\Repositories\Siteconfig\SiteconfigInterface',function($app)
        {
            return new EloquentSiteconfig(new Siteconfig);
        });


        //DB Category
        $app->bind('Qdesign\Repositories\Category\CategoryInterface',function($app)
        {
            return new EloquentCategory(new Category);
        });

        //DB Page
        $app->bind('Qdesign\Repositories\Page\PageInterface',function($app)
        {
            return new EloquentPage(new Page);
        });

        //DB Gallery
        $app->bind('Qdesign\Repositories\Gallery\GalleryInterface',function($app)
        {
            return new EloquentGallery(new Gallery);
        });

        //DB Photo
        $app->bind('Qdesign\Repositories\Photo\PhotoInterface',function($app)
        {
            return new EloquentPhoto(new Photo);
        });

        //DB Box
        $app->bind('Qdesign\Repositories\Box\BoxInterface',function($app)
        {
            return new EloquentBox(new Box);
        });
        //DB Controller
        $app->bind('Qdesign\Repositories\Controller\ControllerInterface',function($app)
        {
            return new EloquentController(new Controller);
        });
        //DB Template
        $app->bind('Qdesign\Repositories\Template\TemplateInterface',function($app)
        {
            return new EloquentTemplate(new Template);
        });
        //DB Post
        $app->bind('Qdesign\Repositories\Post\PostInterface',function($app)
        {
            return new EloquentPost(new Post);
        });

        //DB Order
        $app->bind('Qdesign\Repositories\Order\OrderInterface',function($app)
        {
            return new EloquentOrder(new Order);
        });

        //DB topic
        $app->bind('Qdesign\Repositories\Topic\TopicInterface',function($app)
        {
            return new EloquentTopic(new Topic);
        });

        //User profile
        $app->bind('Qdesign\Repositories\UserProfile\UserProfileInterface',function($app)
        {
            return new EloquentUserProfile(new UserProfile);
        });
    }

}
