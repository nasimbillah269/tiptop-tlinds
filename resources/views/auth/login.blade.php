@extends(general()->theme.'.layouts.app') @section('title')
<title>{{ websiteTitle('Log In') }}</title>
@endsection @section('SEO')
<meta name="description" content="{!!general()->meta_description!!}" />
<meta name="keywords" content="{{general()->meta_keyword}}" />
<meta property="og:title" content="{{general()->meta_title}}" />
<meta property="og:description" content="{!!general()->meta_description!!}" />
<meta property="og:url" content="{{route('login')}}" />
<meta name="robots" content="noindex" />
@endsection

@section('contents')
<div class="tt-auth">
    <div class="container">
        <div class="tt-auth-card">
            @include('auth.includes.authAside', ['ttAsideTitle' => 'Welcome back', 'ttAsideText' => 'Log in to track orders, save favourites and check out faster.'])
            <div class="tt-auth-main">
                <h1>Log in</h1>
                <p class="tt-auth-sub">Use the email address you registered with.</p>

                @foreach(['username', 'password'] as $f)
                    @if($errors->has($f))<div class="tt-auth-alert"><i class="fas fa-circle-exclamation"></i> {{ $errors->first($f) }}</div>@endif
                @endforeach
                @if(session('loginfail'))<div class="tt-auth-alert"><i class="fas fa-circle-exclamation"></i> {{ session('loginfail') }}</div>@endif
                @if(session('loginfailP'))<div class="tt-auth-alert"><i class="fas fa-circle-exclamation"></i> {{ session('loginfailP') }}</div>@endif

                <form action="{{ route('login') }}" method="post" class="tt-auth-form">
                    @csrf
                    <div class="tt-fg">
                        <label for="username">Email address</label>
                        <div class="tt-icon-input"><i class="fas fa-envelope"></i>
                            <input type="text" id="username" required class="form-control" value="{{ old('username') }}" name="username" placeholder="you@example.com" autocomplete="username">
                        </div>
                    </div>
                    <div class="tt-fg">
                        <label for="password">Password</label>
                        <div class="tt-icon-input"><i class="fas fa-lock"></i>
                            <input class="form-control" id="password" required type="password" name="password" placeholder="Your password" autocomplete="current-password">
                        </div>
                    </div>
                    <div class="tt-auth-row">
                        <label class="tt-check"><input type="checkbox" name="remember" value="1"> Remember me</label>
                        <a href="{{ route('forgotPassword') }}">Forgot password?</a>
                    </div>
                    <button type="submit" class="tt-btn tt-btn-lg tt-btn-block" name="login">Log in <i class="fas fa-arrow-right"></i></button>
                </form>
                <p class="tt-auth-switch">Don't have an account? <a href="{{ route('register') }}">Create one</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
