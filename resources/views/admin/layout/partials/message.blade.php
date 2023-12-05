@if(Session::has('error'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
    <h5><i class="icon fas fa-ban"></i> Error!</h5>{{Session::get('error')}}
</div>
@endif

@if(Session::has('warning'))
<div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
    <h5><i class="icon fas fa-exclamation-triangle"></i> Warning! </h5> {{Session::get('warning')}}
</div>
@endif


@if(Session::has('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
    <h5><i class="icon fas fa-check"></i> Complete! </h5> {{Session::get('success')}}
</div>
@endif