@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        <div class="alert alert-{{ $message['level'] }}
            {{ $message['important'] ? 'alert-important alert-dismissible fade show alert-floatable' : '' }}"
        role="alert">
            <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-inner--text">
                <strong>Alert!</strong>
                {!! $message['message'] !!}
            </span>
            @if ($message['important'])
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            @endif
        </div>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
