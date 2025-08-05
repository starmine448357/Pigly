<div class="{{ $cardClass ?? 'auth-card' }}">
    <h1 class="auth-title">{{ $title }}</h1>

    @isset($subtitle)
        <p class="auth-subtitle">{{ $subtitle }}</p>
    @endisset

    @isset($description)
        <p class="auth-description">{{ $description }}</p>
    @endisset

    <form method="POST" action="{{ $action }}" novalidate>
        @csrf
        {{ $slot }}

        <button type="submit" class="auth-button">
            {{ $buttonText }}
        </button>
    </form>

    @isset($footer)
        <div class="auth-footer">{!! $footer !!}</div>
    @endisset
</div>
