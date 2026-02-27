<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset('public/backend') }}/img/AdminLTELogo.png"
             alt="Admin Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent"
                data-widget="treeview"
                role="menu"
                data-accordion="false">

                <!-- DASHBOARD -->
                <li class="nav-header">MAIN</li>
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ isMenuActive('admin/dashboard*') }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                        <span class="badge badge-info right">NEW</span>
                    </a>
                </li>

                <!-- AUTHORIZATIONS SECTION -->
                <li class="nav-header mt-3">USER MANAGEMENT</li>

                <!-- Manage Admin (with dropdown) -->
                <li class="nav-item {{ isMenuExpand('admin/manage-admins*') ? 'menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link {{ isMenuActive('admin/manage-admins*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            Admin Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        <span class="badge badge-success right">3</span>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.manage-admins.roles.index') }}"
                               class="nav-link {{ isMenuActive('admin/manage-admins/roles*') }}">
                                <i class="fas fa-circle nav-icon" style="font-size: 0.5rem;"></i>
                                <p>Roles & Permissions</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.manage-admins.index') }}"
                               class="nav-link {{ isMenuActive('admin/manage-admins*') && !request()->is('admin/manage-admins/user*') }}">
                                <i class="fas fa-circle nav-icon" style="font-size: 0.5rem;"></i>
                                <p>Administrators</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.manage-admins.user.index') }}"
                               class="nav-link {{ isMenuActive('admin/manage-admins/user*') }}">
                                <i class="fas fa-circle nav-icon" style="font-size: 0.5rem;"></i>
                                <p>Registered Users</p>
                                <span class="badge badge-warning right">12</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- CONTENT MANAGEMENT SECTION -->
                <li class="nav-header mt-3">CONTENT MANAGEMENT</li>

                <!-- UI Elements (Collapsible) -->
                <li class="nav-item {{ isMenuExpand('admin/ui*') ? 'menu-open' : '' }}">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-paint-brush"></i>
                        <p>
                            UI Elements
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.ui-content.page', 'banner') }}" class="nav-link {{ isMenuActive('admin/ui-content/page/banner') }}">
                                <i class="fas fa-circle nav-icon" style="font-size: 0.5rem;"></i>
                                <p>Banner Manager</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link">
                                <i class="fas fa-circle nav-icon" style="font-size: 0.5rem;"></i>
                                <p>About Section</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link">
                                <i class="fas fa-circle nav-icon" style="font-size: 0.5rem;"></i>
                                <p>Testimonials</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link">
                                <i class="fas fa-circle nav-icon" style="font-size: 0.5rem;"></i>
                                <p>Services</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link">
                                <i class="fas fa-circle nav-icon" style="font-size: 0.5rem;"></i>
                                <p>FAQ</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link">
                                <i class="fas fa-circle nav-icon" style="font-size: 0.5rem;"></i>
                                <p>Blog Posts</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Pages & Links -->
                <li class="nav-item">
                    <a href="{{ route('admin.pages.index') }}" class="nav-link {{ isMenuActive('admin/pages*') }}">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Pages</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.useful-links.index') }}" class="nav-link {{ isMenuActive('admin/useful-links*') }}">
                        <i class="nav-icon fas fa-link"></i>
                        <p>Useful Links</p>
                    </a>
                </li>

                <!-- COMMUNICATION SECTION -->
                <li class="nav-header mt-3">COMMUNICATION</li>

                <li class="nav-item">
                    <a href="{{ route('admin.subscriber') }}" class="nav-link {{ isMenuActive('admin/subscriber*') }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Subscribers</p>
                        <span class="badge badge-primary right">24</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.contact.message') }}" class="nav-link {{ isMenuActive('admin/contact/message*') }}">
                        <i class="nav-icon fas fa-envelope-open-text"></i>
                        <p>Contact Messages</p>
                        <span class="badge badge-danger right">3</span>
                    </a>
                </li>

                <!-- SYSTEM SECTION -->
                <li class="nav-header mt-3">SYSTEM</li>

                <li class="nav-item {{ isMenuExpand('admin/settings*') ? 'menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link {{ isMenuActive('admin/settings*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.web.settings') }}" class="nav-link">
                                <i class="fas fa-circle nav-icon" style="font-size: 0.5rem;"></i>
                                <p>Basic Settings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-circle nav-icon" style="font-size: 0.5rem;"></i>
                                <p>Image Settings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-circle nav-icon" style="font-size: 0.5rem;"></i>
                                <p>Email Configuration</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.currencies.index') }}" class="nav-link {{ isMenuActive('admin/currencies*') }}">
                        <i class="nav-icon fas fa-coins"></i>
                        <p>Currencies</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link {{ isMenuActive('admin/maintenance*') }}">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>Maintenance Mode</p>
                        <span class="badge badge-warning right">OFF</span>
                    </a>
                </li>

                <!-- AUTHENTICATION SECTION -->
                <li class="nav-header mt-3">AUTHENTICATION</li>

                <li class="nav-item {{ isMenuExpand('admin/auth*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-shield-alt"></i>
                        <p>
                            Auth Pages
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-circle nav-icon" style="font-size: 0.5rem;"></i>
                                <p>Login</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-circle nav-icon" style="font-size: 0.5rem;"></i>
                                <p>Registration</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-circle nav-icon" style="font-size: 0.5rem;"></i>
                                <p>Forgot Password</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->

        <!-- Sidebar Footer (Optional) -->
        <div class="sidebar-footer mt-auto p-3 border-top border-secondary">
            <div class="text-center small text-muted">
                <i class="fas fa-circle text-success mr-1" style="font-size: 0.5rem;"></i> v2.0.0
                <hr class="my-2">
                <a href="#" class="text-muted mr-2"><i class="fas fa-user-cog"></i></a>
                <a href="#" class="text-muted mr-2"><i class="fas fa-sign-out-alt"></i></a>
                <a href="#" class="text-muted"><i class="fas fa-question-circle"></i></a>
            </div>
        </div>
    </div>
    <!-- /.sidebar -->
</aside>
