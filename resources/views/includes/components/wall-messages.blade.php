@if($messages->count() > 0)
<hr>
<h2 class="margin-bottom-20">Comments</h2>
@endif

<div id="wall" data-item="{{$item_id}}" data-controller="{{$controller}}">
    @foreach($messages as $message)
        @include('includes.components.wall-message', ['message' => $message])
    @endforeach
</div>

@if($messages->count() > 0)
<div style="text-align:center">
    <a href="javascript:;" onclick="wallPaginator.loadMoreMessages(this)">show more</a>
</div>
<hr>
@endif
