@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{websiteTitle('Change Password')}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle('Change Password')}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="keywords" content="{{general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset(general()->logo())}}" />
<meta name="url" property="og:url" content="{{route('customer.changePassword')}}" />
<link rel="canonical" href="{{route('customer.changePassword')}}">
@endsection

@section('contents')

@include(welcomeTheme().'layouts.pageHero', [
    'ttTitle'  => 'Change Password',
    'ttIntro'  => 'Use a strong password that you don\'t use anywhere else.',
    'ttCrumbs' => ['My Account' => route('customer.dashboard'), 'Change Password' => null],
])

<section class="tt-acc">
    <div class="container">
        <div class="tt-acc-grid">
            @include(welcomeTheme().'.customer.includes.accountNav')

            <div class="tt-acc-main">
                @include(welcomeTheme().'.alerts')

                <form method="POST" action="{{ route('customer.changePassword') }}" class="tt-acc-card tt-acc-form">
                    @csrf
                    <div class="tt-acc-card-head">
                        <h3>Update Password</h3>
                        <span class="tt-acc-count"><i class="fa-solid fa-shield-halved"></i> Secure</span>
                    </div>
                    <div class="tt-acc-card-body">
                        <div class="tt-acc-fields tt-acc-fields--narrow">
                            <div class="tt-acc-field is-wide">
                                <label>Current Password <span>*</span></label>
                                <div class="tt-acc-pass">
                                    <input type="password" class="form-control" name="current_password" placeholder="Enter current password" required autocomplete="current-password">
                                    <button type="button" class="tt-acc-eye" aria-label="Show password"><i class="fa-solid fa-eye"></i></button>
                                </div>
                                @if ($errors->has('current_password'))<p class="tt-acc-error">{{ $errors->first('current_password') }}</p>@endif
                            </div>
                            <div class="tt-acc-field is-wide">
                                <label>New Password <span>*</span></label>
                                <div class="tt-acc-pass">
                                    <input type="password" class="form-control" name="password" placeholder="Enter new password" required autocomplete="new-password">
                                    <button type="button" class="tt-acc-eye" aria-label="Show password"><i class="fa-solid fa-eye"></i></button>
                                </div>
                                @if ($errors->has('password'))<p class="tt-acc-error">{{ $errors->first('password') }}</p>@endif
                            </div>
                            <div class="tt-acc-field is-wide">
                                <label>Confirm New Password <span>*</span></label>
                                <div class="tt-acc-pass">
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Re-enter new password" required autocomplete="new-password">
                                    <button type="button" class="tt-acc-eye" aria-label="Show password"><i class="fa-solid fa-eye"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tt-acc-card-foot">
                        <a href="{{ route('customer.dashboard') }}" class="tt-acc-btn tt-acc-btn--ghost">Cancel</a>
                        <button type="submit" class="tt-acc-btn"><i class="fa-solid fa-lock"></i> Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
@push('js')
<script>
document.querySelectorAll('.tt-acc-eye').forEach(function (btn) {
    btn.addEventListener('click', function () {
        var input = btn.previousElementSibling;
        var show = input.type === 'password';
        input.type = show ? 'text' : 'password';
        btn.querySelector('i').className = show ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye';
    });
});
</script>
@endpush
