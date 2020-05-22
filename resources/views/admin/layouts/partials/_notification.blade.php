<a href="{{ route('admin.notification') }}" class="nav-link nav-link-icon nav-notification">
    <i class="fas fa-bell"></i>

    @if (number_notif_unread('admin') != 0)
        <span class="badge badge-pill badge-danger">
            {{ number_notif_unread('admin') }}
        </span>
    @endif
</a>
