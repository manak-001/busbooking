<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('page_title')</title>

  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('assets/bootstrap/css/style.css')}}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />

  <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">   -->
  <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" /> -->
  <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"/> -->
  @yield('css')
  <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">NiceAdmin</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a><!-- End Notification Icon -->


        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>



            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>David Muldon</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>8 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->
        <?php
        $language = DB::table('language')->get();
        ?>
        <div class="mr-5 mt-1">
          <select class="form-select switchLanguage " name="language">
            @foreach($language as $value)
            <option value="{{$value->code}}">{{$value->name}}</option>
            @endforeach
          </select>
        </div>
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Kevin Anderson</h6>
              <span>Web Designer</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{route('admin.logout')}}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.html">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#manage_user" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Manage user</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="manage_user" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('admin.users')}}">
              <i class="bi bi-circle"></i><span>All User</span>
            </a>
          </li>
          <li>
            <a href="components-accordion.html">
              <i class="bi bi-circle"></i><span>Active User</span>
            </a>
          </li>
          <li>
            <a href="components-badges.html">
              <i class="bi bi-circle"></i><span>Banded User</span>
            </a>
          </li>
          <li>
            <a href="components-breadcrumbs.html">
              <i class="bi bi-circle"></i><span>Breadcrumbs</span>
            </a>
          </li>
          <li>
            <a href="components-buttons.html">
              <i class="bi bi-circle"></i><span>Email Unverified</span>
            </a>
          </li>
          <li>
            <a href="components-cards.html">
              <i class="bi bi-circle"></i><span>Emal To All</span>
            </a>
          </li>

        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#payment_history" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Payment History</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="payment_history" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="forms-elements.html">
              <i class="bi bi-circle"></i><span>Pending Payment</span>
            </a>
          </li>
          <li>
            <a href="forms-layouts.html">
              <i class="bi bi-circle"></i><span>Success Payment</span>
            </a>
          </li>
          <li>
            <a href="forms-editors.html">
              <i class="bi bi-circle"></i><span>Form Editors</span>
            </a>
          </li>
          <li>
            <a href="forms-validation.html">
              <i class="bi bi-circle"></i><span>Reject Payment</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <!-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="tables-general.html">
              <i class="bi bi-circle"></i><span>General Tables</span>
            </a>
          </li>
          <li>
            <a href="tables-data.html">
              <i class="bi bi-circle"></i><span>All Payment</span>
            </a>
          </li>
        </ul>
      </li> -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#booking_history" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Booking Hostory</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="booking_history" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('admin.bookinghistory','pending')}}">
              <i class="bi bi-circle"></i><span>Pending Ticket</span>
            </a>
          </li>
          <li>
            <a href="{{route('admin.bookinghistory','bookedTicket')}}">
              <i class="bi bi-circle"></i><span>Booked Ticket</span>
            </a>
          </li>
          <li>
            <a href="{{route('admin.bookinghistory','rejectTicket')}}">
              <i class="bi bi-circle"></i><span>Reject Ticket</span>
            </a>
          </li>
          <li>
            <a href="{{route('admin.bookinghistory')}}">
              <i class="bi bi-circle"></i><span>All Ticket</span>
            </a>
          </li>
        </ul>
      </li><!-- End Charts Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#payment_gateway" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Payment Gateway</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="payment_gateway" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="icons-bootstrap.html">
              <i class="bi bi-circle"></i><span>AutoMatic Gateway</span>
            </a>
          </li>
          <li>
            <a href="icons-remix.html">
              <i class="bi bi-circle"></i><span>Manaual Gateway</span>
            </a>
          </li>

        </ul>
      </li><!-- End Icons Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#support_ticket" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Support Ticket</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="support_ticket" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('admin.supportTicket')}}">
              <i class="bi bi-circle"></i><span>All Ticket</span>
            </a>
          </li>
          <li>
            <a href="{{route('admin.supportTicket.create')}}">
              <i class="bi bi-circle"></i><span>Pending Ticket</span>
            </a>
          </li>
          <li>
            <a href="icons-remix.html">
              <i class="bi bi-circle"></i><span>Closed Ticket</span>
            </a>
          </li>
          <li>
            <a href="icons-remix.html">
              <i class="bi bi-circle"></i><span>Answered Ticket</span>
            </a>
          </li>

        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#report" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Report</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="report" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="icons-bootstrap.html">
              <i class="bi bi-circle"></i><span>Login Histroy</span>
            </a>
          </li>
          <li>
            <a href="icons-remix.html">
              <i class="bi bi-circle"></i><span>Email History</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- <li class="nav-heading">Pages</li> -->
      <h6>Transport Manager</h6>
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('admin.counter.index')}}">
          <i class="bi bi-person"></i>
          <span>Counter</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#manage_fleet" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Manage Fleets</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="manage_fleet" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('admin.layout')}}">
              <i class="bi bi-circle"></i><span>Seat Layout</span>
            </a>
          </li>
          <li>
            <a href="{{route('admin.fleetType')}}">
              <i class="bi bi-circle"></i><span>Fleet Type</span>
            </a>
          </li>
          <li>
            <a href="icons-remix.html">
              <i class="bi bi-circle"></i><span>Vehicles</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#manag_trip" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Manage Trpis</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="manag_trip" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('admin.route')}}">
              <i class="bi bi-circle"></i><span>Route</span>
            </a>
          </li>
          <li>
            <a href="{{route('admin.schedule')}}">
              <i class="bi bi-circle"></i><span>Schedule</span>
            </a>
          </li>
          <li>
            <a href="{{route('admin.ticket')}}">
              <i class="bi bi-circle"></i><span>Ticket Price</span>
            </a>
          </li>
          <li>
            <a href="{{route('admin.trip')}}">
              <i class="bi bi-circle"></i><span>Trip</span>
            </a>
          </li>
          <li>
            <a href="icons-remix.html">
              <i class="bi bi-circle"></i><span>Assigned vehicle</span>
            </a>
          </li>
        </ul>
      </li>
      <h6>Seeting</h6>
      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.html">
          <i class="bi bi-envelope"></i>
          <span>General Seeting</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.html">
          <i class="bi bi-card-list"></i>
          <span>Logo & Favicon</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-login.html">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Extenstion</span>
        </a>
      </li><!-- End Login Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-error-404.html">
          <i class="bi bi-dash-circle"></i>
          <span>Seo Manager</span>
        </a>
      </li><!-- End Error 404 Page Nav -->
      <h6>Frontend Manger</h6>
      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-error-404.html">
          <i class="bi bi-dash-circle"></i>
          <span>Manage Template</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-error-404.html">
          <i class="bi bi-dash-circle"></i>
          <span>Manage Pages</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#Manage_section" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Manage Section </span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="Manage_section" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('admin.about')}}">
              <i class="bi bi-circle"></i><span>About Us</span>
            </a>
          </li>
          <li>
            <a href="{{route('admin.language')}}">
              <i class="bi bi-circle"></i><span>Language</span>
            </a>
          </li>
          <li>
            <a href="icons-bootstrap.html">
              <i class="bi bi-circle"></i><span>Banner Section</span>
            </a>
          </li>
          <li>
            <a href="icons-bootstrap.html">
              <i class="bi bi-circle"></i><span>Blog</span>
            </a>
          </li>
          <li>
            <a href="icons-bootstrap.html">
              <i class="bi bi-circle"></i><span>Breadcrumbs</span>
            </a>
          </li>
          <li>
            <a href="icons-bootstrap.html">
              <i class="bi bi-circle"></i><span>Banner Section</span>
            </a>
          </li>
          <li>
            <a href="{{route('admin.contact')}}">
              <i class="bi bi-circle"></i><span>Contact</span>
            </a>
          </li>
          <li>
            <a href="icons-bootstrap.html">
              <i class="bi bi-circle"></i><span>Cookies Policy</span>
            </a>
          </li>
          <li>
            <a href="icons-bootstrap.html">
              <i class="bi bi-circle"></i><span>FAQ</span>
            </a>
          </li>
          <li>
            <a href="icons-bootstrap.html">
              <i class="bi bi-circle"></i><span>Contact</span>
            </a>
          </li>
          <li>
            <a href="icons-bootstrap.html">
              <i class="bi bi-circle"></i><span>Footer Section</span>
            </a>
          </li>
          <li>
            <a href="{{route('admin.profile')}}">
              <i class="bi bi-circle"></i><span>Forgot Password</span>
            </a>
          </li>
          <li>
            <a href="icons-bootstrap.html">
              <i class="bi bi-circle"></i><span>Policies</span>
            </a>
          </li>
          <li>
            <a href="icons-bootstrap.html">
              <i class="bi bi-circle"></i><span>Sign In</span>
            </a>
          </li>
          <li>
            <a href="icons-bootstrap.html">
              <i class="bi bi-circle"></i><span>Sign In</span>
            </a>
          </li>
          <li>
            <a href="icons-bootstrap.html">
              <i class="bi bi-circle"></i><span>Sign Up</span>
            </a>
          </li>
          <li>
            <a href="icons-bootstrap.html">
              <i class="bi bi-circle"></i><span>Social Link</span>
            </a>
          </li>
          <li>
            <a href="icons-bootstrap.html">
              <i class="bi bi-circle"></i><span>Tesimoni</span>
            </a>
          </li>

        </ul>
      </li>
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
    <div class="row">
      @yield('content')
    </div>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <!-- <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      All the links in the footer should remain intact. -->
  <!-- You can delete the links only if you purchased the pro version. -->
  <!-- Licensing information: https://bootstrapmade.com/license/ -->
  <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
  <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer>-->

  <!-- <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a> -->
  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="{{asset('assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/bootstrap/js/chart.min.js')}}"></script>
  <script src="{{asset('assets/bootstrap/js/echarts.min.js')}}"></script>
  <script src="{{asset('assets/bootstrap/js/assets/vendor/quill/quill.min.js')}}"></script>
  <script src="{{asset('assets/bootstrap/js/assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('assets/bootstrap/js/assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('assets/bootstrap/js/assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Template Main JS File -->
  <!-- <script src="{{asset('assets/js/main.js')}}"></script> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="/assets/js/custom.js"></script>

  <?php
  if (\Session::has('success')) {

  ?>
    <script>
      successMsg("{{\Session::get('success')}}");
    </script>
  <?php
    \Session::forget('success');
  }
  ?>
  
  <script>
    $("body").on("change", ".switchLanguage", function () {
               var lang = $(this).val();

               if (lang) {
                   location.href = "/admin/language/switch/" + lang;
               }
           });
    </script>
  @yield('script')
</body>

</html>