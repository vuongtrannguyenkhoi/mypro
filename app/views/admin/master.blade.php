@include('admin.components.head')
<!-- #NAVIGATION -->
<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS variables -->
<aside id="left-panel">

    <!-- User info -->
    <div class="login-info">
				<span> <!-- User image size is adjusted inside CSS, it should stay as is -->

					<a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
                        
						<span>
							Hello, {{ Auth::user()->username }} !
						</span>
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
                <a href="dashboard/view" title="Dashboard">
                    <i class="fa fa-lg fa-fw fa-home"></i>
                    <span class="menu-item-parent">Dashboard</span></a>
            </li>
            <li>
                <a href="categories">
                    <i class="fa fa-lg fa-fw fa-th"></i>
                    <span class="menu-item-parent">Categories</span>
                </a>
            </li>
            <li>
                <a href="pages">
                    <i class="fa fa-lg fa-fw fa-file"></i>
                    <span class="menu-item-parent">Pages</span>
                </a>
            </li>
            <li class="top-menu-hidden">
                <a href="#"><i class="fa fa-lg fa-fw fa-desktop"></i> <span class="menu-item-parent">Posts</span></a>
                <ul>
                    @foreach ($postCategories as $postCategory)
                        <li><a href="posts?topic={{ $postCategory->slug }}">{{ $postCategory->name }}</a></li>
                    @endforeach
                </ul>

            </li>
            <li>
                <a href="galleries">
                    <i class="fa fa-lg fa-fw fa-file-picture-o"></i>
                    <span class="menu-item-parent">Galleries</span>
                </a>
            </li>
            <li>
                <a href="boxes">
                    <i class="fa fa-lg fa-fw fa-inbox"></i>
                    <span class="menu-item-parent">Boxes</span>
                </a>
            </li>
            <li>
                <a href="users">
                    <i class="fa fa-lg fa-fw fa-user"></i>
                    <span class="menu-item-parent">Users</span>
                </a>
            </li>
            <li>
                <a href="siteconfigs">
                    <i class="fa fa-lg fa-fw fa-cogs"></i>
                    <span class="menu-item-parent">Site configs</span>
                </a>
            </li>
            <li>
                <a href="controllers">
                    <i class="fa fa-lg fa-fw fa-gamepad"></i>
                    <span class="menu-item-parent">Controllers</span>
                </a>
            </li>
            <li>
                <a href="templates">
                    <i class="fa fa-lg fa-fw fa-gamepad"></i>
                    <span class="menu-item-parent">Templates</span>
                </a>
            </li>
        </ul>
    </nav>
    <span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>

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
        <div id="alert-success" class="alert alert-success fade in" style="">
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
@include('admin.components.tail')