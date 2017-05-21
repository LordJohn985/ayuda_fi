@extends('layouts.admin.base')
@section('content')
<table  class="table table-striped table-hover">
    <thead>
    <tr>
        <th>Name</th>
    </tr>
    </thead>
    <tbody>
    @foreach( $categories as $category)
        <tr data-id = "{{$category->id}}">
            <td>{{$category->name}}</td>
            <td>
                <a href="/dashboard/categories/edit/{{$category->id}}">Edit</a>
                <a href="" class="btn-delete">Delete</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $categories->links()}}
<form action="/dashboard/categories/delete/" method="GET" id="form-delete">
    <input type="hidden" name="_method" value="GET">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
</form>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('.btn-delete').click(function(e){
                e.preventDefault();
                var row = $(this).parents('tr');
                var id = row.data('id');
                var form = $('#form-delete');
                var url = form.attr('action');
                url += id;
                data = form.serialize();
                var notification_msg=$('#notification-msg');
                var notification_container=$('#notifications');
                notification_container.fadeIn();
                $.post(url,data,function(result){
                }).success(function(){
                    notification_msg.text('the category has been deleted');
                    notification_container.addClass('alert alert-success');
                    row.fadeOut();
                }).fail(function(){
                    notification_msg.text('the category has not been deleted');
                    notification_container.addClass('alert alert-danger');
                });
                console.log(url);
            });
        });
    </script>
@endsection