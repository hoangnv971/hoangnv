  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="/assets/admin/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="form-inline mt-3">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @foreach($sidebar as $routeName => $navItem)
            <li class="nav-item">
                <a href="{{route($routeName)}}" class="nav-link @if($routeActive == $routeName) active @endif">
                  {!!$navItem['icon'] ?? ''!!}
                  <p>
                    {{$navItem['name']}}
                    @if(!empty($navItem['childs']))
                        <i class="right fas fa-angle-left"></i>
                    @endif
                  </p>
                </a>
            </li>
          @endforeach
        </ul>
      </nav>
    </div>
  </aside>
