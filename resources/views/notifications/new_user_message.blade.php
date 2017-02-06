<div class="card form-group">
    <div class="card-block">
        [ {{ $notification->created_at }} ]
        来自 <a href="{{ route('users.show', $notification->data['id']) }}">{{ $notification->data['name'] }}</a> 的一条新私信。
    </div>
</div>