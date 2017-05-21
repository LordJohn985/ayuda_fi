@extends('layouts.admin.base')
@section('content')
<table  class="table table-striped table-hover">
    <thead>
    <tr>
        <th>Author</th>
        <th>Title</th>
        <th>Content</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach( $publications as $publication)
        <tr>
            <td>{{$publication->user->name}}</td>
            <td>{{$publication->title}}</td>
            <td>{{$publication->content}}</td>
            <td>
                <a href="dashboard/publications/edit/{{$publication->id}}">Edit</a>
                <a href="dashboard/publications/delete/{{$publication->id}}">Delete</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $publications->links()}}
@endsection