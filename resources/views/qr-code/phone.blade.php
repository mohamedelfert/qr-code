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
                                <form class="form-horizontal" method="post" action="{{ route('do_phone')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="pin" class="col-sm-2 control-label">Pin</label>
                                        <select name="pin" id="pin" class="form-control">
                                            <option value="0020">0020</option>
                                            <option value="968">968</option>
                                        </select>
                                        @error('pin')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="number" class="col-sm-2 control-label">Number</label>
                                        <input type="text" id="number" name="number" class="form-control"
                                               placeholder="Number" value="{{ old('number') }}">
                                        @error('number')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit" value="submit">Generate QR Code
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="col-4 text-center">
                                @if (session('code'))
                                    {{ session('code') }}
                                    <h6 class="pt-3">{{ session('number') }}</h6>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
