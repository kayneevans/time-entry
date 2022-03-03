<!DOCTYPE html>
<html lang="en">

@include('inc.head')

<body>
    @include('inc.nav')

    @include('inc.messages')

    <div class="mt-3 mb-3">
    @yield('content')

    

    </div>
    @include('inc.footer')
    @include('inc.footerjs')

</body>

</html>