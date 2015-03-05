<?php namespace Qdesign\Services\Form;

use Illuminate\Support\ServiceProvider;
use Qdesign\Services\Form\Category\CategoryForm;
use Qdesign\Services\Form\Controller\ControllerForm;
use Qdesign\Services\Form\Controller\ControllerFormLaravelValidator;
use Qdesign\Services\Form\Gallery\GalleryForm;
use Qdesign\Services\Form\Gallery\GalleryFormLaravelValidator;
use Qdesign\Services\Form\Order\OrderForm;
use Qdesign\Services\Form\Order\OrderFormLaravelValidator;
use Qdesign\Services\Form\Photo\PhotoForm;
use Qdesign\Services\Form\Photo\PhotoFormLaravelValidator;
use Qdesign\Services\Form\Post\PostForm;
use Qdesign\Services\Form\Post\PostFormLaravelValidator;
use Qdesign\Services\Form\Contact\ContactForm;
use Qdesign\Services\Form\Contact\ContactFormLaravelValidator;
use Qdesign\Services\Form\Box\BoxForm;
use Qdesign\Services\Form\Box\BoxFormLaravelValidator;
use Qdesign\Services\Form\Page\PageForm;
use Qdesign\Services\Form\Login\LoginForm;
use Qdesign\Services\Form\Login\LoginFormLaravelValidator;
use Qdesign\Services\Form\Category\CategoryFormLaravelValidator;
use Qdesign\Services\Form\Page\PageFormLaravelValidator;
use Qdesign\Services\Form\Profile\ProfileForm;
use Qdesign\Services\Form\Profile\ProfileFormLaravelValidator;
use Qdesign\Services\Form\Member\Register\RegisterForm;
use Qdesign\Services\Form\Member\Register\RegisterFormLaravelValidator;
use Qdesign\Services\Form\Template\TemplateForm;
use Qdesign\Services\Form\Template\TemplateFormLaravelValidator;
use Qdesign\Services\Form\Topic\TopicForm;
use Qdesign\Services\Form\Topic\TopicFormLaravelValidator;
use Qdesign\Services\Form\User\UserForm;
use Qdesign\Services\Form\User\UserFormLaravelValidator;
use Qdesign\Services\Form\Siteconfig\SiteconfigForm;
use Qdesign\Services\Form\Siteconfig\SiteconfigFormLaravelValidator;
use Qdesign\Services\Form\UserProfile\UserProfileForm;
use Qdesign\Services\Form\UserProfile\UserProfileFormLaravelValidator;


class FormServiceProvider extends ServiceProvider {

    /**
     * Register the binding
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;
        //Login form
        $app->bind('Qdesign\Services\Form\Login\LoginForm', function($app)
        {
            return new LoginForm(
                new LoginFormLaravelValidator( $app['validator'] )
            );
        });

        //User form
        $app->bind('Qdesign\Services\Form\User\UserForm', function($app)
        {
            return new UserForm(
                new UserFormLaravelValidator( $app['validator'] ),
                $app->make('Qdesign\Repositories\User\UserInterface')
            );
        });

        //Siteconfig form
        $app->bind('Qdesign\Services\Form\Siteconfig\SiteconfigForm', function($app)
        {
            return new SiteconfigForm(
                new SiteconfigFormLaravelValidator( $app['validator'] ),
                $app->make('Qdesign\Repositories\Siteconfig\SiteconfigInterface')
            );
        });
        //Profile form
        $app->bind('Qdesign\Services\Form\Profile\ProfileForm', function($app)
        {
            return new ProfileForm(
                new ProfileFormLaravelValidator( $app['validator'] ),
                $app->make('Qdesign\Repositories\Profile\ProfileInterface')
            );
        });

        //Category form
        $app->bind('Qdesign\Services\Form\Category\CategoryForm', function($app)
        {
            return new CategoryForm(
                new CategoryFormLaravelValidator( $app['validator'] ),
                $app->make('Qdesign\Repositories\Category\CategoryInterface')
            );
        });

        //Page form
        $app->bind('Qdesign\Services\Form\Page\PageForm', function($app)
        {
            return new PageForm(
                new PageFormLaravelValidator( $app['validator'] ),
                $app->make('Qdesign\Repositories\Page\PageInterface')
            );
        });

        //Gallery form
        $app->bind('Qdesign\Services\Form\Gallery\GalleryForm', function($app)
        {
            return new GalleryForm(
                new GalleryFormLaravelValidator( $app['validator'] ),
                $app->make('Qdesign\Repositories\Gallery\GalleryInterface')
            );
        });

        //Photo form
        $app->bind('Qdesign\Services\Form\Photo\PhotoForm', function($app)
        {
            return new PhotoForm(
                new PhotoFormLaravelValidator( $app['validator'] ),
                $app->make('Qdesign\Repositories\Photo\PhotoInterface')
            );
        });

        //Box form
        $app->bind('Qdesign\Services\Form\Box\BoxForm', function($app)
        {
            return new BoxForm(
                new BoxFormLaravelValidator( $app['validator'] ),
                $app->make('Qdesign\Repositories\Box\BoxInterface')
            );
        });
        //Controller form
        $app->bind('Qdesign\Services\Form\Controller\ControllerForm', function($app)
        {
            return new ControllerForm(
                new ControllerFormLaravelValidator( $app['validator'] ),
                $app->make('Qdesign\Repositories\Controller\ControllerInterface')
            );
        });
        //Template form
        $app->bind('Qdesign\Services\Form\Template\TemplateForm', function($app)
        {
            return new TemplateForm(
                new TemplateFormLaravelValidator( $app['validator'] ),
                $app->make('Qdesign\Repositories\Template\TemplateInterface')
            );
        });
        //Post form
        $app->bind('Qdesign\Services\Form\Post\PostForm', function($app)
        {
            return new PostForm(
                new PostFormLaravelValidator( $app['validator'] ),
                $app->make('Qdesign\Repositories\Post\PostInterface')
            );
        });
        //Contact form
        $app->bind('Qdesign\Services\Form\Contact\ContactForm', function($app)
        {
            return new ContactForm(
                new ContactFormLaravelValidator( $app['validator'] )
            );
        });

        //Register form
        $app->bind('Qdesign\Services\Form\Member\Register\RegisterForm', function($app)
        {
            return new RegisterForm(
                new RegisterFormLaravelValidator( $app['validator'] )
            );
        });

        //Order form
        $app->bind('Qdesign\Services\Form\Order\OrderForm', function($app)
        {
            return new OrderForm(
                new OrderFormLaravelValidator( $app['validator'] ),
                $app->make('Qdesign\Repositories\Order\OrderInterface')
            );
        });
        //Topic form
        $app->bind('Qdesign\Services\Form\Topic\TopicForm', function($app)
        {
            return new TopicForm(
                new TopicFormLaravelValidator( $app['validator'] ),
                $app->make('Qdesign\Repositories\Topic\TopicInterface')
            );
        });

        //User profile
        $app->bind('Qdesign\Services\Form\UserProfile\UserProfileForm', function($app)
        {
            return new UserProfileForm(
                new UserProfileFormLaravelValidator( $app['validator'] ),
                $app->make('Qdesign\Repositories\UserProfile\UserProfileInterface')
            );
        });
    }
}