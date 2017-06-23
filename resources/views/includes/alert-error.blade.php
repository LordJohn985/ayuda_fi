@if (Session::has('error'))
    <div class="pull-right">
        <div id="alert-get"  data-has-error="true" style="display:none">{{Session::get('error'), Session::forget('error')}}</div>
    </div>
@endif