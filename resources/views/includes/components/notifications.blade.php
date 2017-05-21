
<li id="notification-button">
    <div class="notification-icon show-notifications">
        <a class="notification-bell-img " ><img  src="{{URL::asset('assets/img/notification-bell.png')}}"> </a>
        @if($notifications->count()> 0)
            <div class="notification-number" id="notification-number">{{$notifications->count() }}</div>
        @endif
    </div>
    <div class="notification-list-wrapper">
        <div class="notification-list animated fadeInDown">
            @if($notifications->count()> 0)
                @foreach($notifications as $notification)
                    <div class="notification-item" data-notification="{{$notification->id}}">
                        <a href="{{$notification->url}}">
                            <img class="notification-img" src="{{$notification->image}}">
                            <div class="notification-text">
                                {{$notification->text}}
                            </div>
                            <div class="read-check">
                                <a id="read-notification-{{$notification->id}}" class="check-notification" href="javascript:;" onclick="readNotification({{$notification->id}})">
                                    X
                                </a>
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <div class="notification-item" >

                    <div class="notification-text">
                        <h4> 0 New notifications</h4>
                    </div>

                </div>
            @endif
        </div>
    </div>
</li>

