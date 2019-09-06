<a href="{{ route('notification') }}" class="icons nav-notification">
    <i class="fas fa-bell" aria-hidden="true"></i>

    @if (number_notif_unread('user') != 0)
        <span class="badge badge-pill badge-danger">
            {{ number_notif_unread('user') }}
        </span>
    @endif
</a>
