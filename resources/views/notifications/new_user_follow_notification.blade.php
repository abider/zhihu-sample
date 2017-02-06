<div class="card form-group">
    <div class="card-block">
        [ {{ $notification->created_at }} ]
        <a href="{{ route('users.show', $notification->data['id']) }}">{{ $notification->data['name'] }}</a> 关注了你。
    </div>
</div>