<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="utf-8">
    <title> Tackedesign CMS </title>
    <meta name="description" content="tackedesign cms">
    <meta name="author" content="tackedesign.com">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <script>
        base_url = '{{ url() }}/';
    </script>
    <!-- #CSS Links -->
    <!-- Basic Styles -->
    {{ HTML::style('backend/smartadmin/css/bootstrap.min.css') }}
    {{ HTML::style('backend/smartadmin/css/font-awesome.min.css') }}
    <!-- SmartAdmin Styles : Please note (smartadmin-production.css) was created using LESS variables -->
    {{ HTML::style('backend/smartadmin/css/smartadmin-production.min.css') }}
    {{ HTML::style('backend/smartadmin/css/smartadmin-skins.min.css') }}
    <!-- plugins -->
    {{ HTML::style('backend/plugins/redactor/redactor.css') }}
    {{ HTML::style('backend/plugins/datepicker/css/datepicker.css') }}
    <!-- SmartAdmin RTL Support is under construction
         This RTL CSS will be released in version 1.5
    <link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-rtl.min.css"> -->

    <!-- We recommend you use "your_style.css" to override SmartAdmin
         specific styles this will also ensure you retrain your customization with each SmartAdmin update.
    <link rel="stylesheet" type="text/css" media="screen" href="css/your_style.css"> -->
    {{ HTML::style('backend/css/your_style.css') }}
    <!-- #FAVICONS -->
    <link rel="shortcut icon" href="{{ url('backend/smartadmin/img/favicon/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ url('backend/smartadmin/img/favicon/favicon.png') }}" type="image/x-icon">

    <!-- #GOOGLE FONT -->
    {{--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">--}}

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

<!--

TABLE OF CONTENTS.

Use search to find needed section.

===================================================================

|  01. #CSS Links                |  all CSS links and file paths  |
|  02. #FAVICONS                 |  Favicon links and file paths  |
|  03. #GOOGLE FONT              |  Google font link              |
|  04. #APP SCREEN / ICONS       |  app icons, screen backdrops   |
|  05. #BODY                     |  body tag                      |
|  06. #HEADER                   |  header tag                    |
|  07. #PROJECTS                 |  project lists                 |
|  08. #TOGGLE LAYOUT BUTTONS    |  layout buttons and actions    |
|  09. #MOBILE                   |  mobile view dropdown          |
|  10. #SEARCH                   |  search field                  |
|  11. #NAVIGATION               |  left panel & navigation       |
|  12. #MAIN PANEL               |  main panel                    |
|  13. #MAIN CONTENT             |  content holder                |
|  14. #PAGE FOOTER              |  page footer                   |
|  15. #SHORTCUT AREA            |  dropdown shortcuts area       |
|  16. #PLUGINS                  |  all scripts and plugins       |

===================================================================

-->

<!-- #BODY -->
<!-- Possible Classes

    * 'smart-skin-{SKIN#}'
    * 'smart-rtl'         - Switch theme mode to RTL (will be avilable from version SmartAdmin 1.5)
    * 'menu-on-top'       - Switch to top navigation (no DOM change required)
    * 'hidden-menu'       - Hides the main menu but still accessable by hovering over left edge
    * 'fixed-header'      - Fixes the header
    * 'fixed-navigation'  - Fixes the main menu
    * 'fixed-ribbon'      - Fixes breadcrumb
    * 'fixed-footer'      - Fixes footer
    * 'container'         - boxed layout mode (non-responsive: will not work with fixed-navigation & fixed-ribbon)
-->
<body class="fixed-header fixed-navigation fixed-ribbon">

<!-- #HEADER -->
<header id="header">
<div id="logo-group">
    <!-- PLACE YOUR LOGO HERE -->
    <span id="logo"> <img src="{{ url('backend/img/logo.jpg') }}" alt="tackedesign"> </span>
    <!-- END LOGO PLACEHOLDER -->
</div>

<!-- #TOGGLE LAYOUT BUTTONS -->
<!-- pulled right: nav area -->
<div class="pull-right">

    <!-- collapse menu button -->
    <div id="hide-menu" class="btn-header pull-right">
        <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
    </div>
    <!-- end collapse menu -->

    <!-- logout button -->
    <div id="logout" class="btn-header transparent pull-right">
        <span> <a href="{{ url('logout') }}" title="Sign Out" data-action="userLogout" data-logout-msg="You can improve your security further after logging out by closing this opened browser"><i class="fa fa-sign-out"></i></a> </span>
    </div>
    <!-- end logout button -->



    <!-- fullscreen button -->
    <div id="fullscreen" class="btn-header transparent pull-right">
        <span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
    </div>
    <!-- end fullscreen button -->

</div>
<!-- end pulled right: nav area -->

</header>
<!-- END HEADER -->