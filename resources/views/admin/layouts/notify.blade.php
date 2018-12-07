@if(Session::has('success_msg'))
    <div class="alert alert-success">
        <strong>{{trans('messages.success')}}!</strong> {!! Session::get('success_msg') !!}
    </div>
@endif

@if(Session::has('error_msg'))
    <div class="alert alert-danger">
        <strong>{{trans('messages.error')}}!</strong> {!! Session::get('error_msg') !!}
    </div>
@endif
