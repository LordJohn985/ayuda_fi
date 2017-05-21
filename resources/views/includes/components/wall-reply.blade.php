<div class="row blog-comments blog-comments-reply margin-bottom-30">
    <div class="col-sm-2 sm-margin-bottom-40">
        <img alt="" src="{{$reply->from->photo()}}">
    </div>
    <div class="col-sm-10">
        <div class="comments-itself">
            <h4>
                {{$reply->from->full_name()}}
                <span>{{$reply->created_at->diffForHumans()}}</span>
            </h4>
            <p>{{$reply->text()}}</p>
        </div>
    </div>
</div>