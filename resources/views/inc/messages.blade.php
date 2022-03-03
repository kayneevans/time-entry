@if(count($errors) > 0)
    @foreach($errors->all() as $error)
    <div class="alert alert-danger text-center" id="message">
        {{$error}}
    </div>
    @endforeach
@endif

@if(session('success'))
    <div class="alert alert-success text-center" id="message">
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger text-center" id="message">
        {{session('error')}}
    </div>
@endif