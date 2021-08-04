<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">ادارة مستودع أدوية</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
            <a href="{{route('admin.index')}}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
              <p>
              الرئيسية
              
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview ">
            <a href="#" class="nav-link ">
            <i class="nav-icon fas fa-th"></i>
              <p>
              المستخدمين
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @if(Auth::user()->hasPermission('read_users'))
              <li class="nav-item">
                <a href="{{route('admin.users.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> قائمة المستخدمين</p>
                </a>
              </li>
              @endif
              @if(Auth::user()->hasPermission('create_users'))
              <li class="nav-item">
                <a href="{{route('admin.users.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>اضافة مستخدم جديد</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          <li class="nav-item has-treeview ">
            <a href="#" class="nav-link ">
            <i class="nav-icon fas fa-th"></i>
              <p>
              الأدوية
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @if(Auth::user()->hasPermission('read_drugs'))
              <li class="nav-item">
                <a href="{{route('admin.drugs.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> قائمة الأدوية</p>
                </a>
              </li>
              @endif
              @if(Auth::user()->hasPermission('create_drugs'))
              <li class="nav-item">
                <a href="{{route('admin.drugs.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>اضافة دواء جديد</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          <li class="nav-item has-treeview ">
            <a href="#" class="nav-link ">
            <i class="nav-icon fas fa-th"></i>
              <p>
              الصرف
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(Auth::user()->hasPermission('read_dispense_drugs'))
              <li class="nav-item">
                <a href="{{route('admin.drugs.dispense.list')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> عمليات الصرف  </p>
                </a>
              </li>
              @endif
              @if(Auth::user()->hasPermission('dispense_drugs'))
              <li class="nav-item">
                <a href="{{route('admin.drugs.dispense')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>صرف الأدوية  </p>
                </a>
              </li>
              @endif
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>