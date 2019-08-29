<a href="{{ route('notification') }}" class="icons nav-notification">
    <i class="fas fa-bell" aria-hidden="true"></i>

    @if (Auth::check() && number_notif_unread(Auth::user()->id, 'user') != 0)
        <span class="badge badge-pill badge-danger">
            {{ number_notif_unread(Auth::user()->id, 'user') }}
        </span>
    @endif
</a>
