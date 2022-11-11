<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Shop | @yield('title')</title>
  @include('Admin::layouts.links')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="/assets/admin/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>


  @include('Admin::layouts.navbar')
  <x-admin-sidebar/>

  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@yield('title')</h1>
          </div>
          @yield('bread-crumb')
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
          @yield('content')
      </div>
    </section>
  </div>
  @include('Admin::layouts.footer')


  <aside class="control-sidebar control-sidebar-dark">

  </aside>

</div>

@include('Admin::layouts.scripts')

</body>
</html>
