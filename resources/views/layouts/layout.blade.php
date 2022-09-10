<!DOCTYPE html>
<html lang="en">

    @include('fixed.head')

<body>

  <!-- Navigation -->
  @include('fixed.navigation')
  @include('fixed.notification')

  <!-- Page Content -->
  @yield('content')

  <!-- Footer -->
  @include('fixed.footer')

  <!-- Bootstrap core JavaScript -->
  @include('fixed.scripts')

</body>

</html>
