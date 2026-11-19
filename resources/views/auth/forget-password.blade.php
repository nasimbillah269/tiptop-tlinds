@extends(general()->theme.'.layouts.app') @section('title')
<title>{{ websiteTitle('Reset Password') }}</title>
@endsection @section('SEO')
<meta name="description" content="{!!general()->meta_description!!}" />
<meta name="keywords" content="{{general()->meta_keyword}}" />
<meta property="og:title" content="{{general()->meta_title}}" />
<meta property="og:description" content="{!!general()->meta_description!!}" />
<meta property="og:url" content="{{route('forgotPassword')}}" />
<meta name="robots" content="noindex" />
@endsection

@section('contents')
<div class="tt-auth">
    <div class="container">
        <div class="tt-auth-card">
            @include('auth.includes.authAside', ['ttAsideTitle' => 'Forgot your password?', 'ttAsideText' => 'No problem. We will email you a link to set a new one.'])
            <div class="tt-auth-main">
                <h1>Reset password</h1>
                <p class="tt-auth-sub">Enter the email address on your account and we will send you a reset link.</p>

                @include(general()->theme.'.alerts')

                <form method="POST" action="{{ route('forgotPassword') }}" class="tt-auth-form">
                    @csrf
                    <div class="tt-fg">
                        <label for="emailormobile">Email address <em>*</em></label>
                        <div class="tt-icon-input"><i class="fas fa-envelope"></i>
                            <input type="email" id="emailormobile" name="emailormobile" value="{{ old('emailormobile') }}" class="form-control" placeholder="you@example.com" required autocomplete="email">
                        </div>
                        @error('emailormobile')<p class="tt-field-error">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="tt-btn tt-btn-lg tt-btn-block">Send reset link <i class="fas fa-paper-plane"></i></button>
                </form>
                <p class="tt-auth-switch">Remembered it? <a href="{{ route('login') }}">Back to log in</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
