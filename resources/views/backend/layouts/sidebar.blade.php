<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
<!--            <div class="pull-left image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>-->
        </div>
        <!--         search form 
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search..."/>
                        <span class="input-group-btn">
                            <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
                 /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <!--                <ul class="treeview-menu">
                                    <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
                                </ul>-->
            </li>
            @if(Entrust::can('product-read'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Products</span><i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('backend.product.index')}}"><i class="fa fa-circle-o"></i>Product List</a></li>
                    <li><a href="{{route('backend.product.create')}}"><i class="fa fa-plus"></i>Add Product</a></li>
                </ul>
            </li>
            @endif
            @if(Entrust::can('category-read'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Categories</span><i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('backend.category.index')}}"><i class="fa fa-circle-o"></i>Categories</a></li>
                    <li><a href="{{route('backend.category.create')}}"><i class="fa fa-plus"></i>Add Category</a></li>
                </ul>
            </li>
            @endif
            @if(Entrust::can('page-read'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Pages</span><i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('backend.page.index')}}"><i class="fa fa-circle-o"></i>Page List</a></li>
                    <li><a href="{{route('backend.page.create')}}"><i class="fa fa-plus"></i>Add Page</a></li>
                </ul>
            </li>
            @endif
            @if(Entrust::can('user-read'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Users</span><i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('backend.user.index')}}"><i class="fa fa-circle-o"></i>Users List</a></li>
                    <li><a href="{{route('backend.user.create')}}"><i class="fa fa-plus"></i>Add User</a></li>
                </ul>
            </li>
            @endif
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Widget</span><i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    @if(Entrust::can('slideshow-read'))
                    <li><a href="{{route('backend.slideshow.index')}}"><i class="fa fa-circle-o"></i>Slideshow</a></li>
                    @endif
                    <li><a href="{{route('backend.page.create')}}"><i class="fa fa-plus"></i>Social Account</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="{{url('backend/options')}}">
                    <i class="fa fa-files-o"></i>
                    <span>Options</span></i>
                </a>
            </li>
            <li>
                <a href="{{url('')}}" target="_blank">
                    <i class="fa fa-th"></i> <span>Front End</span>
                </a>
            </li>
            <li>
                <a href="pages/widgets.html">
                    <i class="fa fa-th"></i> <span>Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>