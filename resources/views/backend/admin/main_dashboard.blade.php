@include('backend.admin.body.css')
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
   @include('backend.admin.body.sidebar')
        <!--end sidebar wrapper -->
        <!--start header -->
        @include('backend.admin.body.header')
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                @yield('content')
            </div>
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
     @include('backend.admin.body.footer')
    </div>
    <!--end wrapper-->
    <!--start switcher-->
   @include('backend.admin.body.colorSwitch')
  @include('backend.admin.body.js')
