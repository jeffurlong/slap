<div class="alerts">
    @if (Session::has('errors'))
        <div class="errors">
            @foreach ($errors->all('<div class="error">:message</div>') as $error)
                {{ $error }}
            @endforeach
        </div>
    @elseif (Session::has('message'))
        <div class="messages">
             <div class="message">{{ Session::get('message') }}</div>
        </div>
    @endif
</div>
