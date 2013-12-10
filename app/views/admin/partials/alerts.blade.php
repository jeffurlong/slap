<div class="alerts">
    @if (Session::has('errors'))
        <div class="errors">
            @foreach ($errors->all('<div class="error">:message</div>') as $error)
                {{ $error }}
            @endforeach
        </div>
    @elseif (Session::has('alert'))
        <div class="alert">{{ Session::get('alert') }}</div>
    @endif
</div>
