@php
    use Illuminate\Support\Facades\Request;
@endphp
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
          @php
            if (Request::url() === url('/')) {
                echo 'Quotation Requests';
            } elseif (Request::url() === url('/confirmedbookings')) {
                echo 'Confirmed Quotation Requests';
            } elseif (Request::url() === url('/completedbookings')) {
                echo 'Completed Quotation Requests';
            } elseif (Request::url() === url('/clients')) {
                echo 'Clients';
            } elseif (Request::url() === url('/drivers')) {
                echo 'Drivers';
            } elseif (Request::url() === url('/vehicles')) {
                echo 'Vehicles';
            } elseif (Request::url() === url('/reminders')) {
                echo 'Reminder Settings';
            } elseif (Request::url() === url('/reports')) {
                echo 'Reports';
            } elseif (Request::url() === url('/invoices')) {
                echo 'Invoices';
            } elseif (Request::url() === url('/settings')) {
                echo 'Settings';
            } elseif (Request::url() === url('/driverjoblist')) {
                echo 'Driver Job List';
            } else {
                echo '';
            }
          @endphp
        </title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-primary">
          <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="https://admin.executive-chauffeur.com/images/executive-chauffeurslogon.GIF" width="130px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link {{ Request::url() === url('/') ? 'active' : '' }}" aria-current="page" href="{{url('/')}}" title="Quotation Request"><i class="fa fa-book" style="font-size:30px"></i></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ Request::url() === url('/confirmedbookings') ? 'active' : '' }}" href="{{url('/confirmedbookings')}}" title="Confirmed Bookings"><i class="fa fa-check-square" style="font-size:30px"></i></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ Request::url() === url('/completedbookings') ? 'active' : '' }}" href="{{url('/completedbookings')}}" title="Completed Bookings"><i class="fa fa-th-list" style="font-size:30px"></i></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ Request::url() === url('/clients') ? 'active' : '' }}" href="{{url('/clients')}}" title="Clients"><i class="fa fa-user" style="font-size:30px"></i></i></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ Request::url() === url('/drivers') ? 'active' : '' }}" href="{{url('/drivers')}}" title="Drivers"><i class="fa fa-id-card" style="font-size:30px"></i></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ Request::url() === url('/vehicles') ? 'active' : '' }}" href="{{url('/vehicles')}}" title="Vehicles"><i class="fa fa-car" style="font-size:30px"></i></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ Request::url() === url('/reminders') ? 'active' : '' }}" href="{{url('/reminders')}}" title="Reminder Settings"><i class="fa fa-clock-o" style="font-size:30px"></i></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ Request::url() === url('/reports') ? 'active' : '' }}" href="{{url('/reports')}}" title="Reports"><i class="fa fa-file-text" style="font-size:30px"></i></i></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ Request::url() === url('/invoices') ? 'active' : '' }}" href="{{url('/invoices')}}" title="Invoices"><i class="fa fa-file-text-o" style="font-size:30px"></i></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ Request::url() === url('/settings') ? 'active' : '' }}" href="{{url('/settings')}}" title="Settings"><i class="fa fa-cog" style="font-size:30px"></i></a>
                </li>
              </ul>
            </div>
          </div>
        </nav>