<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('backend') }}/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Starter Kits</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ isMenuActive('admin/dashboard*') }}">
                        <i class="fas fa-home fa-sm"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-header">AUTHORIZATIONS</li>
                <li class="nav-item">
                    <a href="{{ route('admin.roles.index') }}" class="nav-link {{ isMenuActive('admin/roles*') }}">
                        <i class="fas fa-user-cog fa-sm"></i>
                        <p>
                            Role
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.admins.index') }}" class="nav-link {{ isMenuActive('admin/admins*') }}">
                        <i class="fas fa-users fa-sm"></i>
                        <p>
                            Admin
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.manage-admins.user.index') }}" class="nav-link {{ isMenuActive('admin/dashboard*') }}">
                        <i class="fas fa-users fa-sm"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>

                <li class="nav-header">BLOG</li>
                <li class="nav-item">
                    <a href="{{ route('admin.posts.index') }}"
                        class="nav-link {{ isMenuActive('admin/posts*') }}">
                        <i class="fas fa-file-alt fa-sm"></i>
                        <p>
                            Post
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.categories.index') }}"
                        class="nav-link {{ isMenuActive('admin/categories*') }}">
                        <i class="fa fa-tags fa-sm"></i>
                        <p>
                            Categories
                        </p>
                    </a>
                </li>

                <li class="nav-header">CONTENT MANAGES</li>
                <li class="nav-item">
                    <a href="#"
                        class="nav-link {{ isMenuActive('admin.pages*') }}">
                        <i class="fa fa-link fa-sm"></i>
                        <p>
                            Testimonials
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#"
                        class="nav-link {{ isMenuActive('admin.pages*') }}">
                        <i class="fa fa-link fa-sm"></i>
                        <p>
                            FAQ
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.pages.index') }}" class="nav-link {{ isMenuActive('admin.pages*') }}">
                        <i class="fa fa-file fa-sm"></i>
                        <p>
                            Pages
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.useful-links.index') }}"
                        class="nav-link {{ isMenuActive('admin.pages*') }}">
                        <i class="fa fa-link fa-sm"></i>
                        <p>
                            Useful Links
                        </p>
                    </a>
                </li>

                <li class="nav-header">FRONTEND</li>

                <li class="nav-item">
                    <a href="" class="nav-link {{ isMenuActive('admin/subscriber*') }}">
                        <i class="fa fa-bars fa-sm"></i>
                        <p>
                            Menu
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.subscriber') }}" class="nav-link {{ isMenuActive('admin/subscriber*') }}">
                        <i class="fa fa-user fa-sm"></i>
                        <p>
                            Subscribers
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.contact.message') }}"
                        class="nav-link {{ isMenuActive('admin/contact/message*') }}">
                        <i class="fa fa-comment fa-sm"></i>
                        <p>
                            Contact Message
                        </p>
                    </a>
                </li>

                <li class="nav-header">SETTINGS</li>
                <li class="nav-item {{ isMenuExpand('admin/manage-admins*') }}">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cog fa-sm"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left fa-sm"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.web.settings') }}"
                                class="nav-link {{ isMenuActive('admin/manage-admins*') }}">
                                <i class="fas fa-angle-right fa-sm"></i>
                                <p>Basic Settings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ isMenuActive('admin/manage-admins*') }}">
                                <i class="fas fa-angle-right fa-sm"></i>
                                <p>Images</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link {{ isMenuActive('admin/contact/message*') }}">
                        <i class="fa fa-envelope fa-sm"></i>
                        <p>
                            Mail Configure
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
