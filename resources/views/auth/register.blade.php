@extends(general()->theme.'.layouts.app') @section('title')
<title>{{ websiteTitle('Create Account') }}</title>
@endsection @section('SEO')
<meta name="description" content="{!!general()->meta_description!!}" />
<meta name="keywords" content="{{general()->meta_keyword}}" />
<meta property="og:title" content="{{general()->meta_title}}" />
<meta property="og:description" content="{!!general()->meta_description!!}" />
<meta property="og:url" content="{{route('register')}}" />
<meta name="robots" content="noindex" />
@endsection

@section('contents')
<div class="tt-auth">
    <div class="container">
        <div class="tt-auth-card">
            @include('auth.includes.authAside', ['ttAsideTitle' => 'Create your account', 'ttAsideText' => 'It takes less than a minute, and makes ordering and tracking much easier.'])
            <div class="tt-auth-main">
                <h1>Create account</h1>
                <p class="tt-auth-sub">Fill in your details to get started.</p>

                @include(general()->theme.'.alerts')

                <form action="{{ route('register') }}" method="post" class="tt-auth-form">
                    @csrf
                    <div class="tt-fg">
                        <label for="name">Full name <em>*</em></label>
                        <div class="tt-icon-input"><i class="fas fa-user"></i>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" placeholder="Your name" required autocomplete="name">
                        </div>
                        @error('name')<p class="tt-field-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="tt-fg">
                        <label for="email">Email address <em>*</em></label>
                        <div class="tt-icon-input"><i class="fas fa-envelope"></i>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="you@example.com" required autocomplete="email">
                        </div>
                        @error('email')<p class="tt-field-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="tt-fg">
                        <label for="password">Password <em>*</em></label>
                        <div class="tt-icon-input"><i class="fas fa-lock"></i>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Choose a password" required autocomplete="new-password">
                        </div>
                        @error('password')<p class="tt-field-error">{{ $message }}</p>@enderror
                    </div>
                    <p class="tt-auth-note">Your personal data is used to manage your account and orders, as described in our <a href="{{ route('pageView','privacy-policy') }}">privacy policy</a>.</p>
                    <button type="submit" class="tt-btn tt-btn-lg tt-btn-block">Create account <i class="fas fa-arrow-right"></i></button>
                </form>
                <p class="tt-auth-switch">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
