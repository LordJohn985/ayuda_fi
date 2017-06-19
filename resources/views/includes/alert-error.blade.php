@if (Session::has('error'))

    <div class="col-md-6 pull-right">
        <div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>{{ Session::get('error') }}</strong>
        </div>
    </div>
@endif
@if (Session::has('error-db'))
    <div class="col-md-6 pull-right">
        <div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>{{ Session::get('error-db') }}</strong>
        </div>
    </div>
@endif