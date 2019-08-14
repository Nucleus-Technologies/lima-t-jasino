<a href="{{ route('admin.notification') }}" class="nav-link nav-link-icon nav-notification">
    <i class="ni ni-bell-55"></i>

    @if (number_notif_unread(Auth::user()->id, 'admin') != 0)
        <span class="badge badge-pill badge-danger">
            {{ number_notif_unread(Auth::user()->id, 'admin') }}
        </span>
    @endif
</a>
