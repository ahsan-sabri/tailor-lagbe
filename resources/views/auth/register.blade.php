@extends('layouts.app')

@section('styles')
    <style>
        .fade-enter-active,
        .fade-leave-active {
            transition: opacity .5s
        }

        .fade-enter,
        .fade-leave-to {
            opacity: 0
        }

    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}"
                            id="reg-form">
                            @csrf

                            {{-- common inputs --}}
                            {{-- name --}}
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                        value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- email --}}
                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                        value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- mobile --}}
                            <div class="form-group row">
                                <label for="mobile"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Mobile no') }}</label>

                                <div class="col-md-6">
                                    <input id="mobile" type="text"
                                        class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile"
                                        value="{{ old('mobile') }}" required>

                                    @if ($errors->has('mobile'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{-- user type --}}
                            @php
                                $roles = config('constants.roles');
                                unset($roles['admin']);
                            @endphp
                            <div class="form-group row">
                                <label for="user_type"
                                    class="col-md-4 col-form-label text-md-right">{{ __('User Type') }}</label>

                                <div class="col-md-6">
                                    <select name="user_type"
                                        class="form-control {{ $errors->has('user_type') ? ' is-invalid' : '' }}"
                                        id="user_type" v-on:change="onSelectUserType" v-model="type" required>
                                        @foreach ($roles as $key => $role)
                                            <option value="{{ $key }}">{{ $role }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('user_type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('user_type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- this section is visible depending upon user type selection --}}
                            <transition name="fade">
                                {{-- store inputs --}}
                                <div id="store-input" v-if="commonInput">
                                    {{-- store owner name --}}
                                    <div class="form-group row" v-show="ownerName">
                                        <label for="owner_name"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Owner Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="owner_name" type="text"
                                                class="form-control{{ $errors->has('owner_name') ? ' is-invalid' : '' }}"
                                                name="owner_name" value="{{ old('owner_name') }}">

                                            @if ($errors->has('owner_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('owner_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- shop name --}}
                                    <div class="form-group row">
                                        <label for="shop_name"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Shop Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="shop_name" type="text"
                                                class="form-control{{ $errors->has('shop_name') ? ' is-invalid' : '' }}"
                                                name="shop_name" value="{{ old('shop_name') }}" required>

                                            @if ($errors->has('shop_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('shop_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- service --}}
                                    <div class="form-group row">
                                        <label for="service"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Service for') }}</label>

                                        <div class="col-md-6" id="service">
                                            <div class="row pl-3 pt-2" >
                                                <div class="col-sm-3">
                                                    <input type="radio" name="service" class="form-check-input" id="male"
                                                        value="1">
                                                    <label for="male" class="form-check-label">Male</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="radio" id="female" name="service" class="form-check-input"
                                                        value="2">
                                                    <label for="female" class="form-check-label">Female</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="radio" id="both" name="service" class="form-check-input"
                                                        value="0">
                                                    <label for="both" class="form-check-label">Both</label>
                                                </div>
                                            </div>

                                            @if ($errors->has('service'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('service') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- location --}}
                                    <div class="form-group row">
                                        <label for="location"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label>

                                        <div class="col-md-6">
                                            <input id="location" type="text"
                                                class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}"
                                                name="location" value="{{ old('location') }}" required>

                                            @if ($errors->has('tin'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('location') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- TIN --}}
                                    <div class="form-group row">
                                        <label for="tin" class="col-md-4 col-form-label text-md-right">{{ __('TIN') }}</label>
                                        <div class="col-md-6">
                                            <input id="tin" type="text"
                                                class="form-control{{ $errors->has('tin') ? ' is-invalid' : '' }}"
                                                name="tin" value="{{ old('tin') }}" required>

                                            @if ($errors->has('tin'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('tin') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- website --}}
                                    <div class="form-group row">
                                        <label for="website"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Website') }}</label>

                                        <div class="col-md-6">
                                            <input id="website" type="text"
                                                class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}"
                                                name="website" value="{{ old('website') }}">

                                            @if ($errors->has('website'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('website') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </transition>

                            {{-- logo or image --}}
                            <div class="form-group row">
                                <label for="image"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Image / Logo') }}</label>

                                <div class="col-md-6">
                                    <input id="image" type="file"
                                        class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}"
                                        name="image">

                                    @if ($errors->has('image'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{-- password  --}}
                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{-- confirm password  --}}
                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')

    <script>
        new Vue({
            el: "#reg-form",
            data: {
                type: 'customer',
                commonInput: false,
                ownerName: false,
                // storeInput: false,
                // tailorInput: false
            },
            methods: {
                onSelectUserType: function() {
                    if (this.type == 'store' || this.type == 'tailor') {
                        this.commonInput = true;
                    }
                    if (this.type == 'tailor') {
                        this.ownerName = false;
                    }
                    if (this.type == 'store') {
                        this.ownerName = true;
                    }
                    if (this.type == 'customer') {
                        this.commonInput = false;
                    }
                }
            },
            mounted() {
                console.log('mounted');
            }
        });

    </script>

@endsection
