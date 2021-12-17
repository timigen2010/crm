@component('mail::message')
    # Password Reset

    Пожалуйста перейдите по этой ссылке для восстановления пароля:

    @component('mail::button', ['url' => $redirectUrl . "?confirmToken=" . $confirmToken])
        Восстановление пароля
    @endcomponent

    Спасибо,
    {{ config('app.name') }}
@endcomponent
