<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title',$meta->title)</title>

    <meta name="author" content="bluecloud.vn">
    <meta name="description" content="@yield('description',$meta->description)">
    <meta name="keyword" content="@yield('keywords',$meta->keywords)">
    <link rel="canonical" href="@yield('canonical')"/>

    <!-- bootstrap 3.2.0 -->
    {{ HTML::style('frontend/assets/bootstrap/css/bootstrap.min.css') }}
    <!-- jquery 1.11.1 -->
    {{ HTML::script('frontend/js/jquery-1.11.1.min.js') }}
    {{ HTML::script('frontend/assets/bootstrap/js/bootstrap.min.js') }}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    {{ HTML::script('frontend/js/html5shiv.min.js') }}
    {{ HTML::script('frontend/js/respond.min.js') }}
    <![endif]-->
    <!-- plugins -->

    <!-- modules -->
    {{ HTML::style('frontend/css/module.css') }}
    {{ HTML::style('frontend/css/non-responsive.css') }}
    {{ HTML::style('frontend/css/responsive.css') }}

</head>
<body>

<div class="body-head">
    @yield('body-head','<div class="about-top-bg"></div>')
</div>
<div class="body-nav">

    <nav class="navbar" role="navigation">
        <div class="">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
							<span class="sr-only">
								Toggle navigation
							</span>
							<span class="icon-bar">
							</span>
							<span class="icon-bar">
							</span>
							<span class="icon-bar">
							</span>
                </button>
                <a href="{{ url() }}" class="navbar-brand icon-home">
                    {{ $box['logo']->content }}
                </a>
            </div>
            <div class="collapse navbar-collapse" id="main-nav">
                    {{ renderTreeMenu($categories) }}
            </div>
            <!-- /.navbar-collapse -->
        </div>
    </nav>
    <div class="box-social-links">
        {{ $box['links']->content }}
    </div>
</div>
