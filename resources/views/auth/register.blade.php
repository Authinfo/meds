@extends('layouts.app')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card mx-4">
            <div class="card-body p-4">

                <form method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <h1>{{ trans('panel.site_title') }}</h1>
                    Sudah Punya Account?<p class="text-muted"><a href="{{ route('login') }}">{{ trans('global.login') }}</a></p>

                    <label for="name"> Nama Lengkap</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user fa-fw"></i>
                            </span>
                        </div>
                        <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" required autofocus placeholder="{{ trans('global.user_name') }}" value="{{ old('name', null) }}">
                        @if($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>

                    <label for="email">Alamat Email</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-envelope fa-fw"></i>
                            </span>
                        </div>
                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <label for="number">Nomor Handphone</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-phone fa-fw"></i>
                            </span>
                        </div>
                        <input type="number" name="number" class="form-control{{ $errors->has('number') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.phone') }}" value="{{ old('number', null) }}">
                        @if($errors->has('number'))
                            <div class="invalid-feedback">
                                {{ $errors->first('number') }}
                            </div>
                        @endif
                    </div>

                    <label for="idtype">Jenis Identitas</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-genderless fa-fw"></i>
                            </span>
                        </div>
                        <select class="form-control {{ $errors->has('idtype') ? 'is-invalid' : '' }}" name="idtype" id="idtype" required>
                            <option value disabled {{ old('idtype', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach(App\Models\User::IDTYPE_SELECT as $key => $label)
                                <option value="{{ $key }}" {{ old('idtype', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('idtype'))
                            <div class="invalid-feedback">
                                {{ $errors->first('idtype') }}
                            </div>
                        @endif
                    </div>

                    <label for="noid">Nomor Identitas</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-id-card fa-fw"></i>
                            </span>
                        </div>
                        <input type="text" name="noid" class="form-control{{ $errors->has('noid') ? ' is-invalid' : '' }}" required autofocus placeholder="Nomor Identitas" value="{{ old('noid', null) }}">
                        @if($errors->has('noid'))
                            <div class="invalid-feedback">
                                {{ $errors->first('noid') }}
                            </div>
                        @endif
                    </div>

                    <label for="alamat">Alamat Sesuai Identitas</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-location-arrow fa-fw"></i>
                            </span>
                        </div>
                        <input type="text" name="alamat" class="form-control{{ $errors->has('alamat') ? ' is-invalid' : '' }}" required autofocus placeholder="Alamat" value="{{ old('alamat', null) }}">
                        @if($errors->has('alamat'))
                            <div class="invalid-feedback">
                                {{ $errors->first('alamat') }}
                            </div>
                        @endif
                    </div>

                    <label for="dob">Tanggal Lahir</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-calendar fa-fw"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control date {{ $errors->has('dob') ? 'is-invalid' : '' }}" name="dob" id="dob" placeholder="D-M-Y // 12-09-1999" value="{{ old('dob') }}" required>
                        @if($errors->has('dob'))
                            <div class="invalid-feedback">
                                {{ $errors->first('dob') }}
                            </div>
                        @endif
                    </div>

                    <label for="jk">Jenis Kelamin</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user fa-fw"></i>
                            </span>
                        </div>
                        <select class="form-control {{ $errors->has('jk') ? 'is-invalid' : '' }}" name="jk" id="jk" required>
                            <option value disabled {{ old('jk', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach(App\Models\User::JK_SELECT as $key => $label)
                                <option value="{{ $key }}" {{ old('jk', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('jk'))
                            <div class="invalid-feedback">
                                {{ $errors->first('jk') }}
                            </div>
                        @endif
                    </div>

                    <label for="password">Kata Sandi</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-lock fa-fw"></i>
                            </span>
                        </div>
                        <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">
                        @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-lock fa-fw"></i>
                            </span>
                        </div>
                        <input type="password" name="password_confirmation" class="form-control" required placeholder="{{ trans('global.login_password_confirmation') }}">
                    </div>

                    <button class="btn btn-block btn-primary">
                        {{ trans('global.register') }}
                    </button>
                </form>

            </div>
        </div>

    </div>
</div>

@endsection
