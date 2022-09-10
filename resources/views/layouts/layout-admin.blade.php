@include('fixed.admin.head')
<body>
<div class="wrapper">
    @include('fixed.admin.navigation')
    @include('fixed.admin.navigation-side')
    <div class="content-wrapper" style="background-color:#343a40">
        @include('fixed.notification')

        @yield('content')
    </div>
    @include('fixed.admin.footer')
    @include('fixed.admin.script')
</div>

</body>
</html>
