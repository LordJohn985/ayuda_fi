@if (Session::has('success'))
    <div class="col-md-6 pull-right">
        <div class="alert alert-success fade in">
            <strong>{{ Session::get('success') }}</strong>
        </div>
    </div>
@endif