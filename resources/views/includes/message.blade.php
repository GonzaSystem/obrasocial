@if(session('message'))
    <div class="alert alert-success text-center">
        {{ session('message') }}
    </div>
@elseif(session('error'))
    <div class="alert alert-danger text-center">
        {{session('error')}}
    </div>
@elseif(isset($error))
    <div class="alert alert-danger text-center">
        {{$error ?? ''}}
    </div>
@endif
