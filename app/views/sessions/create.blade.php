
<!DOCTYPE html>
<html lang="en-us" id="extr-page">
<head>
    <meta charset="utf-8">
    <title> SmartAdmin</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- #CSS Links -->
    <!-- Basic Styles -->
    {{ HTML::style('backend/smartadmin/css/bootstrap.min.css') }}
    {{ HTML::style('backend/smartadmin/css/font-awesome.min.css') }}
    <!-- SmartAdmin Styles : Please note (smartadmin-production.css) was created using LESS variables -->
    {{ HTML::style('backend/smartadmin/css/smartadmin-production.min.css') }}
    {{ HTML::style('backend/smartadmin/css/smartadmin-skins.min.css') }}
    <!-- #APP SCREEN / ICONS -->
    <!-- Specifying a Webpage Icon for Web Clip
         Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
    <link rel="apple-touch-icon" href="{{ url('backend/smartadmin/img/splash/sptouch-icon-iphone.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('backend/smartadmin/img/splash/touch-icon-ipad.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ url('backend/smartadmin/img/splash/touch-icon-iphone-retina.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ url('backend/smartadmin/img/splash/touch-icon-ipad-retina.png') }}">

    <!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Startup image for web apps -->
    <link rel="apple-touch-startup-image" href="{{ url('backend/smartadmin/img/splash/ipad-landscape.png') }}" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
    <link rel="apple-touch-startup-image" href="{{ url('backend/smartadmin/img/splash/ipad-portrait.png') }}" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
    <link rel="apple-touch-startup-image" href="{{ url('backend/smartadmin/img/splash/iphone.png') }}" media="screen and (max-device-width: 320px)">
</head>

<body class="animated fadeInDown">

<div id="main" role="main">

    <!-- MAIN CONTENT -->
    <div id="content" class="container">

        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-offset-4 col-lg-4">
                <div class="well no-padding">
                    @if (Session::has('flash_message'))
                    <div class="">
                        {{ Session::get('flash_message') }}
                    </div>
                    @endif
                    {{ Form::open(array(
                    'route' => 'sessions.store',
                    'class' => 'smart-form client-form'
                    ))}}
                        <header>
                            Sign In
                        </header>

                        <fieldset>

                            <section>
                                <label class="label">Username</label>
                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                    <input type="text" name="username">
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter username</b></label>
                            </section>

                            <section>
                                <label class="label">Password</label>
                                <label class="input"> <i class="icon-append fa fa-lock"></i>
                                    <input type="password" name="password">
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
<!--                                <div class="note">-->
<!--                                    <a href="forgotpassword.html">Forgot password?</a>-->
<!--                                </div>-->
                            </section>

                            <section>
                                <label class="checkbox">
                                    <input id="remember_me" type="checkbox" name="remember_me">
                                    <i></i>Stay signed in</label>
                            </section>
                        </fieldset>
                        <footer>
                            <button type="submit" class="btn btn-primary">
                                Sign in
                            </button>
                        </footer>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>