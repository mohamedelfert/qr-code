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
                                <form class="form-horizontal" method="post" action="{{ route('do_email')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">Email</label>
                                        <input type="email" id="email" name="email" class="form-control"
                                               placeholder="Email" value="{{ old('email') }}">
                                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="subject" class="col-sm-2 control-label">Subject</label>
                                        <input type="text" id="subject" name="subject" class="form-control"
                                               placeholder="Subject" value="{{ old('subject') }}">
                                        @error('subject')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="message" class="col-sm-2 control-label">Message</label>
                                        <textarea class="form-control" id="message" name="message"
                                                  placeholder="Enter Your Message">{{ old('message') }}</textarea>
                                        @error('message')<span class="text-danger">{{ $message }}</span>@enderror
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
                                    <h6 class="pt-3">{{ session('email') }}</h6>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
