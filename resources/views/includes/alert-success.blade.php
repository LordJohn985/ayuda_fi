@if (Session::has('success'))
    <div class="pull-right">
        <div id="alert-get"  data-has-success="true" style="display:none">{{Session::get('success'), Session::forget('success')}}</div>
    </div>
@endif