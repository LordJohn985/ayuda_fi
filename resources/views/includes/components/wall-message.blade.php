<div class="row blog-comments margin-bottom-30">

    <div class="col-sm-2 sm-margin-bottom-40">
        <img alt="" src="{{$message->from->photo()}}" />
    </div>

    <div class="col-sm-10">

        <div class="comments-itself">

            <h4>
                {{$message->from->full_name()}}
                <span>
                    {{$message->created_at->diffForHumans()}}
                    @if(!$message->isReply())
                        /
                        <a href="javascript:;" rel="{{$message->id}}" onclick="replyMessage(this)">Reply</a>
                    @endif
                </span>
            </h4>
            <p>{{$message->text()}}</p>
        </div>
    </div>

</div>



<div id="wall{{$message->id}}" class="wall-message">
    @foreach($message->replies(2) as $reply)
        @include('includes.components.wall-reply', ['reply' => $reply])
    @endforeach
</div>


@if($message->numberOfReplies() > 2)
    <div style="text-align:right">
        <a href="javascript:;" data-message="{{$message->id}}" onclick="wallPaginator.loadReplies(this)" >show all</a>
    </div>
@endif