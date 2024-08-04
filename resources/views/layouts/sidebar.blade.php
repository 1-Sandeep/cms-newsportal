@php
    $second_segment = Request::segment(2);
@endphp

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ $second_segment == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#"
                        class="nav-link {{ $second_segment == 'post' || $second_segment == 'author' || $second_segment == 'category' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Post
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('backend.post.index') }}"
                                class="nav-link {{ $second_segment == 'post' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Post</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('backend.author.index') }}"
                                class="nav-link {{ request()->is('cms/author/list') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Author</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('backend.category.index') }}"
                                class="nav-link {{ $second_segment == 'category' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('backend.tag.index') }}"
                                class="nav-link {{ $second_segment == 'tags' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tags</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#"
                        class="nav-link {{ $second_segment == 'user' || $second_segment == 'role' || $second_segment == 'permission' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            User
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('backend.user.index') }}"
                                class="nav-link {{ $second_segment == 'user' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('backend.role.index') }}"
                                class="nav-link {{ $second_segment == 'role' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Role</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('backend.permission.index') }}"
                                class="nav-link {{ $second_segment == 'permission' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permission</p>
                            </a>
                        </li>
                    </ul>

                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link {{ $second_segment == 'pages' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Pages
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('backend.page.index') }}"
                                class="nav-link {{ $second_segment == 'pages' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pages</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link {{ $second_segment == 'seo' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            SEO
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/examples/invoice.html"
                                class="nav-link {{ $second_segment == 'seo' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>SEO</p>
                            </a>
                        </li>
                    </ul>
                </li>




                <li class="nav-item">
                    <a href="#" class="nav-link {{ $second_segment == 'advertisement' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-ad"></i>
                        <ion-icon name="images-outline"></ion-icon>
                        <p>
                            Advertisement
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/examples/invoice.html"
                                class="nav-link {{ $second_segment == 'advertisement' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Advertisement</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link {{ $second_segment == 'media' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-photo-video"></i>
                        <ion-icon name="images-outline"></ion-icon>
                        <p>
                            Media
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/examples/invoice.html"
                                class="nav-link {{ $second_segment == 'media' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Media</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
