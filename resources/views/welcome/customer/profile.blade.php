@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{websiteTitle('Profile Edit')}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle('Profile Edit')}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="keywords" content="{{general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset(general()->logo())}}" />
<meta name="url" property="og:url" content="{{route('customer.profile')}}" />
<link rel="canonical" href="{{route('customer.profile')}}">
@endsection

@section('contents')

@include(welcomeTheme().'layouts.pageHero', [
    'ttTitle'  => 'Account Details',
    'ttIntro'  => 'Keep your personal information and delivery address up to date.',
    'ttCrumbs' => ['My Account' => route('customer.dashboard'), 'Account Details' => null],
])

<section class="tt-acc">
    <div class="container">
        <div class="tt-acc-grid">
            @include(welcomeTheme().'.customer.includes.accountNav')

            <div class="tt-acc-main">
                @include(welcomeTheme().'.alerts')

                <form method="POST" action="{{ route('customer.profile') }}" enctype="multipart/form-data" class="tt-acc-card tt-acc-form">
                    @csrf
                    <div class="tt-acc-card-head">
                        <h3>Profile Photo</h3>
                    </div>
                    <div class="tt-acc-card-body">
                        <div class="tt-acc-photo">
                            <img src="{{ asset($user->image()) }}" alt="{{ $user->name }}" id="ttAccPhotoPreview" />
                            <div>
                                <label class="tt-acc-upload">
                                    <input type="file" name="image" accept="image/*" onchange="if(this.files[0]){document.getElementById('ttAccPhotoPreview').src=URL.createObjectURL(this.files[0]);}" />
                                    <i class="fa-solid fa-camera"></i> Change Photo
                                </label>
                                <p class="tt-acc-hint">JPG, PNG or GIF. Max 2MB.</p>
                                @if ($errors->has('image'))<p class="tt-acc-error">{{ $errors->first('image') }}</p>@endif
                            </div>
                        </div>
                    </div>

                    <div class="tt-acc-card-head tt-acc-card-head--split">
                        <h3>Personal Information</h3>
                    </div>
                    <div class="tt-acc-card-body">
                        <div class="tt-acc-fields">
                            <div class="tt-acc-field is-wide">
                                <label>Full Name <span>*</span></label>
                                <input required class="form-control" value="{{ old('name') ?: $user->name }}" name="name" type="text" placeholder="Enter your name">
                                @if ($errors->has('name'))<p class="tt-acc-error">{{ $errors->first('name') }}</p>@endif
                            </div>
                            <div class="tt-acc-field">
                                <label>Email <span>*</span></label>
                                <input required class="form-control" value="{{ old('email') ?: $user->email }}" name="email" type="email" placeholder="Enter your email">
                                @if ($errors->has('email'))<p class="tt-acc-error">{{ $errors->first('email') }}</p>@endif
                            </div>
                            <div class="tt-acc-field">
                                <label>Mobile <span>*</span></label>
                                <input required class="form-control" value="{{ old('mobile') ?: $user->mobile }}" name="mobile" type="text" placeholder="Enter your mobile">
                                @if ($errors->has('mobile'))<p class="tt-acc-error">{{ $errors->first('mobile') }}</p>@endif
                            </div>
                        </div>
                    </div>

                    <div class="tt-acc-card-head tt-acc-card-head--split">
                        <h3>Address</h3>
                    </div>
                    <div class="tt-acc-card-body">
                        <div class="tt-acc-fields tt-acc-fields--3">
                            <div class="tt-acc-field">
                                <label>District</label>
                                <select class="form-control" name="district">
                                    <option value="">Select option</option>
                                    @foreach(geoData(3) as $data)
                                    <option value="{{ $data->id }}" {{ $user->district == $data->id ? 'selected' : '' }}>{{ $data->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('district'))<p class="tt-acc-error">{{ $errors->first('district') }}</p>@endif
                            </div>
                            <div class="tt-acc-field">
                                <label>City / Thana</label>
                                <select class="form-control" name="city">
                                    <option value="">Select option</option>
                                    @if($user->district)
                                    @foreach(geoData(4, $user->district) as $data)
                                    <option value="{{ $data->id }}" {{ $user->city == $data->id ? 'selected' : '' }}>{{ $data->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('city'))<p class="tt-acc-error">{{ $errors->first('city') }}</p>@endif
                            </div>
                            <div class="tt-acc-field">
                                <label>Postal Code</label>
                                <input type="text" class="form-control" name="postal_code" value="{{ old('postal_code') ?: $user->postal_code }}" placeholder="Postal code">
                                @if ($errors->has('postal_code'))<p class="tt-acc-error">{{ $errors->first('postal_code') }}</p>@endif
                            </div>
                            <div class="tt-acc-field is-wide">
                                <label>Street Address</label>
                                <input class="form-control" value="{{ old('address') ?: $user->address_line1 }}" name="address" type="text" placeholder="House, road, area">
                                @if ($errors->has('address'))<p class="tt-acc-error">{{ $errors->first('address') }}</p>@endif
                            </div>
                        </div>
                    </div>

                    <div class="tt-acc-card-foot">
                        <a href="{{ route('customer.dashboard') }}" class="tt-acc-btn tt-acc-btn--ghost">Cancel</a>
                        <button type="submit" class="tt-acc-btn"><i class="fa-solid fa-check"></i> Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
