<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('includes.head')

    <title>Fobia - Fashion Admin Template</title>
  </head>
  <body>
    

 <!--start wrapper-->
    <div class="wrapper">
       <!--start sidebar -->
    <aside class="sidebar-wrapper" data-simplebar="true">
    @include('includes.leftmenu')
      <!--end navigation-->
    </aside>
    <!--end sidebar -->

    <!--start top header-->
    <header class="top-header">
    @include('includes.topnav')
    </header>
    <!--end top header-->


    

        <!-- start page content wrapper-->
        <div class="page-content-wrapper">
          <!-- start page content-->
         <div class="page-content">

         @yield('content')



          </div>
          <!-- end page content-->
         </div>
         


         

     </div>
  <!--end wrapper-->


  


    <!-- JS Files-->
    @include('includes.footer')


    @stack('scripts')

    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    
  </body>
</html>