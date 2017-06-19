@if (Session::has('success'))
    <div class="pull-right">
        <div id="alert-get"  data-has-success="true" style="display:none">{{Session::get('success')}}</div>
    </div>
@endif