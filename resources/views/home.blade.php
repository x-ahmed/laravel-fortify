@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success"
                                role="alert">
                                {{ \Illuminate\Support\Str::replace('-', ' ', session('status')) }}
                            </div>
                        @endif

                        <form class="text-center" action="{{ url('user/two-factor-authentication') }}"
                            method="POST">
                            @csrf

                            @if (auth()->user()->two_factor_secret)
                                @method('DELETE')

                                <div class="mb-3 d-flex justify-content-center align-items-center">
                                    <div>
                                        {!! auth()->user()->twoFactorQrCodeSvg() !!}
                                    </div>
                                    <div>
                                        <h3>{{ __('Recovery Codes') }}</h3>
                                    <ul>
                                        @foreach (auth()->user()->recoveryCodes() as $recovery)
                                            <li>
                                                {{ $recovery }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                </div>

                                <button class="btn btn-danger btn-block"
                                    type="submit">
                                    {{ __('Disable Two Factor Authentication') }}
                                </button>
                            @else
                                <button class="btn btn-primary btn-block"
                                    type="submit">
                                    {{ __('Enable Two Factor Authentication') }}
                                </button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
