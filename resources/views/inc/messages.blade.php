@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div   id="main_alert" class="alert alert-danger">
            {{$error}}
        </div>
    @endforeach
@endif

@if(session('success'))
    <div id="main_alert" class="alert alert-success">
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div id="main_alert" class="alert alert-danger">
        {{session('error')}}
    </div>
@endif