@include('portal.components.head')
<!-- #NAVIGATION -->
<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS variables -->
<aside id="left-panel">

    <!-- User info -->
    <div class="login-info">
				<span> <!-- User image size is adjusted inside CSS, it should stay as is -->
					<a href="#user/profile">
                        @if (Auth::check())
                            @if (Auth::user()->profile)
                                {{Auth::user()->profile->avata()}}
                            @else
                            <img src="{{ url('frontend/images/default-avata.png') }}"/>
                            @endif
                            <span>
                                {{ Auth::user()->username }}
                            </span>
                        @endif
                    </a>
				</span>
    </div>
    <!-- end user info -->

    <!-- NAVIGATION : This navigation is also responsive

    To make this navigation dynamic please make sure to link the node
    (the reference to the nav > ul) after page load. Or the navigation
    will not initialize.
    -->
    <nav>
        <!--
        NOTE: Notice the gaps after each icon usage <i></i>..
        Please note that these links work a bit different than
        traditional href="" links. See documentation for details.
        -->
        <ul>
            <li>
                <a href="forums/1/giao-dich-bat-dong-san" title="Giao dịch bất động sản">
                    <i class="fa fa-lg fa-fw fa-comments-o"></i>
                    <span class="menu-item-parent">Giao dịch Bất động sản</span></a>
            </li>
            <li>
                <a href="forums/2/giao-dich-nha-dat" title="Giao dịch nhà ở">
                    <i class="fa fa-lg fa-fw fa-comments-o"></i>
                    <span class="menu-item-parent">Giao dịch Nhà ở</span></a>
            </li>
            <!-- Member logged Manage controls -->
            @if (Auth::check())
            <li style="border-bottom: 1px solid #1A1817">
            </li>
            <li style="border-top: 1px solid #525151;">
                <a href="topics" title="Topics">
                    <i class="fa fa-lg fa-fw fa-list-alt"></i>
                    <span class="menu-item-parent">Quản lý bài viết</span></a>
            </li>
            @endif
        </ul>
    </nav>
<!--    <span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>-->

</aside>
<!-- END NAVIGATION -->

<!-- #MAIN PANEL -->
<div id="main" role="main">

    <!-- RIBBON -->
    <div id="ribbon">

				<span class="ribbon-button-alignment">
					<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh" rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true" data-reset-msg="Would you like to RESET all your saved widgets and clear LocalStorage?"><i class="fa fa-refresh"></i></span>
				</span>

        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <!-- This is auto generated -->
        </ol>
        <!-- end breadcrumb -->

        <!-- You can also add more buttons to the
        ribbon for further usability

        Example below:

        <span class="ribbon-button-alignment pull-right" style="margin-right:25px">
            <span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa fa-grid"></i> Change Grid</span>
            <span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa fa-plus"></i> Add</span>
            <span id="search" class="btn btn-ribbon" data-title="search"><i class="fa fa-search"></i> <span class="hidden-mobile">Search</span></span>
        </span> -->

    </div>
    <!-- END RIBBON -->
    <div id="alert">
        <div id="alert-success" class="alert alert-success fade in" style="display:">
            <button class="close" data-dismiss="alert">
                ×
            </button>
            <i class="fa-fw fa fa-check"></i>
            <strong>Success</strong> <span class="message"></span>.
        </div>
    </div>
    <!-- #MAIN CONTENT -->
    <div id="content">

    </div>

    <!-- END #MAIN CONTENT -->

</div>
<!-- END #MAIN PANEL -->
@include('portal.components.tail')