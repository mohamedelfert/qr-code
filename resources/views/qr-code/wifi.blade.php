@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex">
                        {{ __('Qr Code Builder') }}
                        <div class="ml-auto">
                            <a href="{{ route('qr_builder') }}">QR Builder</a> -
                            <a href="{{ route('qr_phone') }}">Phone</a> -
                            <a href="{{ route('qr_email') }}">Email</a> -
                            <a href="{{ route('qr_sms') }}">SMS</a> -
                            <a href="{{ route('qr_wifi') }}">WIFI</a>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-8">
                                <form class="form-horizontal" method="post" action="{{ route('do_wifi')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="ssid" class="col-sm-2 control-label">SSID</label>
                                        <input type="text" id="ssid" name="ssid" class="form-control"
                                               placeholder="SSID" value="{{ old('ssid') }}">
                                        @error('ssid')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="encryption" class="col-sm-12 control-label">Encryption</label>
                                        <select class="form-control" name="encryption" id="encryption">
                                            <option value="WPA/WEP">WPA/WEP</option>
                                            <option value="WPA">WPA</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="col-sm-2 control-label">Password</label>
                                        <input type="text" id="password" name="password" class="form-control"
                                               placeholder="Password" value="{{ old('password') }}">
                                        @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="hidden" class="col-sm-12 control-label">Hidden</label>
                                        <select class="form-control" name="hidden" id="hidden">
                                            <option value="False">No</option>
                                            <option value="True">Yes</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit" value="submit">Generate QR Code
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="col-4 text-center">
                                @if (session('code'))
                                    {{ session('code') }}
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
