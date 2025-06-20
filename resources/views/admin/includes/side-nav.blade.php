  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
          <img src="{{ asset('public/backend') }}/img/AdminLTELogo.png" alt="AdminLTE Logo"
              class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Starter Kits</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <li class="nav-item">
                      <a href="{{ route('admin.dashboard') }}" class="nav-link {{ isMenuActive('admin/dashboard*') }}">
                          <i class="nav-icon fas fa-th"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>

                  <li class="nav-header">AUTHORIZATIONS</li>

                  <li class="nav-item {{ isMenuExpand('admin/manage-admins*') }}">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-user-cog"></i>
                          <p>
                              Manage Admin
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('admin.manage-admins.roles.index') }}" class="nav-link {{ isMenuActive('admin/manage-admins/roles*') }}">
                                  <i class="fas fa-angle-right nav-icon"></i>
                                  <p>Roles</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('admin.manage-admins.index') }}" class="nav-link {{ isMenuActive('admin/manage-admins*') }}">
                                  <i class="fas fa-angle-right nav-icon"></i>
                                  <p>Admins</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('admin.manage-admins.user.index') }}" class="nav-link {{ isMenuActive('admin/manage-admins*') }}">
                                  <i class="fas fa-angle-right nav-icon"></i>
                                  <p>Users</p>
                              </a>
                          </li>
                      </ul>
                  </li>

                  <li class="nav-item">
                    <a href="{{ route('admin.subscriber') }}" class="nav-link {{ isMenuActive('admin/subscriber*') }}">
                         <i class="fa fa-user"></i>
                        <p>
                            Subscribers
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.contact.message') }}" class="nav-link {{ isMenuActive('admin/contact/message*') }}">
                        <i class="fa fa-user"></i>
                        <p>
                            Contact Message
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ isMenuExpand('admin/manage-admins*') }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            UI
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.manage-admins.index') }}" class="nav-link {{ isMenuActive('admin/manage-admins*') }}">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Banner</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.manage-admins.user.index') }}" class="nav-link {{ isMenuActive('admin/manage-admins*') }}">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>About</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.web.settings') }}" class="nav-link {{ isMenuActive('admin/manage-admins*') }}">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Testimonial</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.web.settings') }}" class="nav-link {{ isMenuActive('admin/manage-admins*') }}">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Services</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.web.settings') }}" class="nav-link {{ isMenuActive('admin/manage-admins*') }}">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Faq</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.web.settings') }}" class="nav-link {{ isMenuActive('admin/manage-admins*') }}">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Blog</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.web.settings') }}" class="nav-link {{ isMenuActive('admin/manage-admins*') }}">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Login</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.web.settings') }}" class="nav-link {{ isMenuActive('admin/manage-admins*') }}">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Registration</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ isMenuExpand('admin/manage-admins*') }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.manage-admins.index') }}" class="nav-link {{ isMenuActive('admin/manage-admins*') }}">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Basic Settings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.manage-admins.user.index') }}" class="nav-link {{ isMenuActive('admin/manage-admins*') }}">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Web Section</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.web.settings') }}" class="nav-link {{ isMenuActive('admin/manage-admins*') }}">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Web Setting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.web.settings') }}" class="nav-link {{ isMenuActive('admin/manage-admins*') }}">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Mail Configaretion</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.pages.index') }}" class="nav-link {{ isMenuActive('admin.pages*') }}">
                        <i class="fa fa-user"></i>
                        <p>
                            Pages
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link {{ isMenuActive('admin.pages*') }}">
                        <i class="fa fa-user"></i>
                        <p>
                            Useful Links
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.contact.message') }}" class="nav-link {{ isMenuActive('admin/contact/message*') }}">
                        <i class="fa fa-user"></i>
                        <p>
                            Maintenance Mode
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.contact.message') }}" class="nav-link {{ isMenuActive('admin/contact/message*') }}">
                        <i class="fa fa-user"></i>
                        <p>
                            Mail Configaretion
                        </p>
                    </a>
                </li>



              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
