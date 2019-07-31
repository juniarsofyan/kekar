<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                            class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
                </ul>
            </li>

            <li class="treeview {{ (request()->routeIs('category*')) ? 'active' : '' }}" >
                <a href="#">
                    <span>Kategori</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li class="{{ (request()->routeIs('category.index')) ? 'active' : '' }}"><a href="{{ route('category.index') }}"><i class="fa fa-circle-o"></i> List</a></li>
                    <li class="{{ (request()->routeIs('category.create')) ? 'active' : '' }}"><a href="{{ route('category.create') }}"><i class="fa fa-circle-o"></i> Buat Baru</a></li>
                </ul>
            </li>

            <li class="treeview {{ (request()->routeIs('component*')) ? 'active' : '' }}" >
                <a href="#">
                    <span>Komponen</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li class="{{ (request()->routeIs('component.index')) ? 'active' : '' }}"><a href="{{ route('component.index') }}"><i class="fa fa-circle-o"></i> List</a></li>
                    <li class="{{ (request()->routeIs('component.create')) ? 'active' : '' }}"><a href="{{ route('component.create') }}"><i class="fa fa-circle-o"></i> Buat Baru</a></li>
                </ul>
            </li>

            {{-- <li class="treeview {{ (request()->routeIs('process*')) ? 'active' : '' }}" >
                <a href="#">
                    <span>Proses</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li class="{{ (request()->routeIs('process.index')) ? 'active' : '' }}"><a href="{{ route('process.index') }}"><i class="fa fa-circle-o"></i> List</a></li>
                    <li class="{{ (request()->routeIs('process.create')) ? 'active' : '' }}"><a href="{{ route('process.create') }}"><i class="fa fa-circle-o"></i> Buat Baru</a></li>
                </ul>
            </li> --}}

            <li class="treeview {{ (request()->routeIs('customer*')) ? 'active' : '' }}" >
                <a href="#">
                    <span>Customer</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li class="{{ (request()->routeIs('customer.index')) ? 'active' : '' }}"><a href="{{ route('customer.index') }}"><i class="fa fa-circle-o"></i> List</a></li>
                    <li class="{{ (request()->routeIs('customer.create')) ? 'active' : '' }}"><a href="{{ route('customer.create') }}"><i class="fa fa-circle-o"></i> Buat Baru</a></li>
                </ul>
            </li>

            <li class="treeview {{ (request()->routeIs('inventory*')) ? 'active' : '' }}" >
                <a href="#">
                    <span>Barang</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li class="{{ (request()->routeIs('inventory.index')) ? 'active' : '' }}"><a href="{{ route('inventory.index') }}"><i class="fa fa-circle-o"></i> List</a></li>
                    <li class="{{ (request()->routeIs('inventory.create')) ? 'active' : '' }}"><a href="{{ route('inventory.create') }}"><i class="fa fa-circle-o"></i> Buat Baru</a></li>
                </ul>
            </li>

            {{-- <li class="treeview {{ (request()->routeIs('material*')) ? 'active' : '' }}" >
                <a href="#">
                    <span>Jenis Material</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li class="{{ (request()->routeIs('material.index')) ? 'active' : '' }}"><a href="{{ route('material.index') }}"><i class="fa fa-circle-o"></i> List</a></li>
                    <li class="{{ (request()->routeIs('material.create')) ? 'active' : '' }}"><a href="{{ route('material.create') }}"><i class="fa fa-circle-o"></i> Buat Baru</a></li>
                </ul>
            </li> --}}

            {{-- <li class="treeview {{ (request()->routeIs('project*')) ? 'active' : '' }}" >
                <a href="#">
                    <span>Kartu Kerja</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li class="{{ (request()->routeIs('project.index')) ? 'active' : '' }}"><a href="{{ route('project.index') }}"><i class="fa fa-circle-o"></i> List</a></li>
                    <li class="{{ (request()->routeIs('project.create')) ? 'active' : '' }}"><a href="{{ route('project.create') }}"><i class="fa fa-circle-o"></i> Buat Baru</a></li>
                </ul>
            </li> --}}

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
