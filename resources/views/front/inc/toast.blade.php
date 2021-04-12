<div class="toast fade hide" role="alert" data-autohide="false" aria-live="assertive" aria-atomic="true" data-toggle="toast">
    <div class="toast-header">
        <img src="{{asset('img/logo.png')}}" alt="brand-logo" height="16" class="mr-2">
        <strong class="mr-auto">Zaproszenie</strong>
        <small class="text-muted">2 seconds ago</small>
        <button type="button" class="ml-2 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="toast-body">
        Zaproszenie dla {{$user->name}} na adres {{$user->email}} zostało wysłane pomyślnie.
    </div>
</div>