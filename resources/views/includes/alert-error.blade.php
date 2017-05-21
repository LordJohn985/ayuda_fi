@if (Session::has('error'))

    <div class="col-md-6 pull-right">
        <div class="alert alert-error fade in">
            <strong>{{ Session::get('error') }}</strong>
        </div>
    </div>
@endif
@if (Session::has('error-db'))
    <div class="col-md-6 pull-right">
        <div class="alert alert-error fade in">
            <strong>{{ Session::get('error-db') }}</strong>
        </div>
    </div>
@endif