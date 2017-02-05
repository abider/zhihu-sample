<li class="list-group-item">
    <a href="{{ route('users.show', $notification->data['id']) }}">
        {{ $notification->data['name'] }}
    </a>
    关注了你。
</li>