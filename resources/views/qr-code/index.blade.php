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
                                <form class="form-horizontal" method="post" action="{{ route('doQr')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">Name</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                               placeholder="Name" value="{{ old('name') }}">
                                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="body" class="col-sm-2 control-label">Body</label>
                                        <input type="text" id="body" name="body" class="form-control"
                                               placeholder="Body" value="{{ old('body') }}">
                                        @error('body')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <label for="qr_attachment" class="col-sm-12 control-label">QR Attachment</label>
                                        <select class="form-control" name="qr_attachment" id="qr_attachment">
                                            <option value="no">No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>

                                    <hr>

                                    <div class="row pb-3">
                                        <div class="col-3">
                                            <label for="qr_size" class="col-sm-12 control-label">QR Size</label>
                                            <select class="form-control" name="qr_size" id="qr_size">
                                                <option value="">Select Size</option>
                                                <option value="100">100 x 100</option>
                                                <option value="300">300 x 300</option>
                                                <option value="600">600 x 600</option>
                                                <option value="900">900 x 900</option>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label for="image_type" class="col-sm-12 control-label">Image Type</label>
                                            <select class="form-control" name="image_type" id="image_type">
                                                <option value="">Select Type</option>
                                                <option value="png">PNG</option>
                                                <option value="svg">SVG</option>
                                                <option value="eps">EPS</option>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label for="error_correction" class="col-sm-12 control-label">Error Correction</label>
                                            <select class="form-control" name="error_correction" id="error_correction">
                                                <option value="">Select Error Correction</option>
                                                <option value="L">7%</option>
                                                <option value="M">15%</option>
                                                <option value="Q">25%</option>
                                                <option value="H">30%</option>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label for="encoding" class="col-sm-12 control-label">Encoding</label>
                                            <select class="form-control" name="encoding" id="encoding">
                                                <option value="">Select Encoding</option>
                                                <option value="ISO-8859-1">ISO-8859-1</option>
                                                <option value="ISO-8859-2">ISO-8859-2</option>
                                                <option value="ISO-8859-3">ISO-8859-3</option>
                                                <option value="ISO-8859-4">ISO-8859-4</option>
                                                <option value="ISO-8859-5">ISO-8859-5</option>
                                                <option value="ISO-8859-6">ISO-8859-6</option>
                                                <option value="ISO-8859-7">ISO-8859-7</option>
                                                <option value="ISO-8859-8">ISO-8859-8</option>
                                                <option value="ISO-8859-9">ISO-8859-9</option>
                                                <option value="ISO-8859-10">ISO-8859-10</option>
                                                <option value="ISO-8859-11">ISO-8859-11</option>
                                                <option value="ISO-8859-12">ISO-8859-12</option>
                                                <option value="ISO-8859-13">ISO-8859-13</option>
                                                <option value="ISO-8859-14">ISO-8859-14</option>
                                                <option value="ISO-8859-15">ISO-8859-15</option>
                                                <option value="ISO-8859-16">ISO-8859-16</option>
                                                <option value="SHIFT-JIS">SHIFT-JIS</option>
                                                <option value="WINDOWS-1250">WINDOWS-1250</option>
                                                <option value="WINDOWS-1251">WINDOWS-1251</option>
                                                <option value="WINDOWS-1252">WINDOWS-1252</option>
                                                <option value="WINDOWS-1256">WINDOWS-1256</option>
                                                <option value="UTF-16BE">UTF-16BE</option>
                                                <option value="UTF-8">UTF-8</option>
                                                <option value="ASCII">ASCII</option>
                                                <option value="GBK">GBK</option>
                                                <option value="EUC-KR">EUC-KR</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row pb-3">
                                        <div class="col-3">
                                            <label for="qr_margin" class="col-sm-12 control-label">Margin</label>
                                           <input type="number" name="qr_margin" id="qr_margin" class="form-control"
                                                  value="{{ old('qr_margin',0) }}" min="0" max="100" step="1">
                                        </div>
                                        <div class="col-3">
                                            <label for="qr_eye" class="col-sm-12 control-label">QR Eye</label>
                                            <select class="form-control" name="qr_eye" id="qr_eye">
                                                <option value="">Select Eye</option>
                                                <option value="square">Square</option>
                                                <option value="circle">Circle</option>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label for="qr_style" class="col-sm-12 control-label">QR Style</label>
                                            <select class="form-control" name="qr_style" id="qr_style">
                                                <option value="">Select Style</option>
                                                <option value="square">Square</option>
                                                <option value="dot">Dot</option>
                                                <option value="round">Round</option>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label for="color" class="col-sm-12 control-label">QR Color</label>
                                            <input type="color" name="color" id="color" class="form-control"
                                                   value="{{ old('qr-margin') }}">
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row pb-3">
                                        <div class="col-6">
                                            <label for="background_color" class="col-sm-12 control-label">QR Background Color</label>
                                            <input type="color" name="background_color" id="background_color" class="form-control"
                                                   value="{{ old('background_color') }}">
                                        </div>
                                        <div class="col-6">
                                            <label for="background_transparent" class="col-sm-12 control-label">Background Transparent</label>
                                            <input type="number" name="background_transparent" id="background_transparent" class="form-control"
                                                   value="{{ old('background_transparent',0) }}" min="0" max="100" step="1">
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row pb-3">
                                        <div class="col-6">
                                            <label for="eye_color_inner_0" class="col-sm-12 control-label">QR Eye Color Inner 0</label>
                                            <input type="color" name="eye_color_inner_0" id="eye_color_inner_0" class="form-control"
                                                   value="{{ old('eye_color_inner_0') }}">
                                        </div>
                                        <div class="col-6">
                                            <label for="eye_color_outer_0" class="col-sm-12 control-label">QR Eye Color Outer 0</label>
                                            <input type="color" name="eye_color_outer_0" id="eye_color_outer_0" class="form-control"
                                                   value="{{ old('eye_color_outer_0') }}">
                                        </div>
                                    </div>

                                    <div class="row pb-3">
                                        <div class="col-6">
                                            <label for="eye_color_inner_1" class="col-sm-12 control-label">QR Eye Color Inner 1</label>
                                            <input type="color" name="eye_color_inner_1" id="eye_color_inner_1" class="form-control"
                                                   value="{{ old('eye_color_inner_1') }}">
                                        </div>
                                        <div class="col-6">
                                            <label for="eye_color_outer_1" class="col-sm-12 control-label">QR Eye Color Outer 1</label>
                                            <input type="color" name="eye_color_outer_1" id="eye_color_outer_1" class="form-control"
                                                   value="{{ old('eye_color_outer_1') }}">
                                        </div>
                                    </div>

                                    <div class="row pb-3">
                                        <div class="col-6">
                                            <label for="eye_color_inner_2" class="col-sm-12 control-label">QR Eye Color Inner 2</label>
                                            <input type="color" name="eye_color_inner_2" id="eye_color_inner_2" class="form-control"
                                                   value="{{ old('eye_color_inner_2') }}">
                                        </div>
                                        <div class="col-6">
                                            <label for="eye_color_outer_2" class="col-sm-12 control-label">QR Eye Color Outer 2</label>
                                            <input type="color" name="eye_color_outer_2" id="eye_color_outer_2" class="form-control"
                                                   value="{{ old('eye_color_outer_2') }}">
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row pb-3">
                                        <div class="col-4">
                                            <label for="qr_gradient_start" class="col-sm-12 control-label">QR Gradient Start</label>
                                            <input type="color" name="qr_gradient_start" id="qr_gradient_start" class="form-control"
                                                   value="{{ old('qr_gradient_start') }}">
                                        </div>
                                        <div class="col-4">
                                            <label for="qr_gradient_end" class="col-sm-12 control-label">QR Gradient End</label>
                                            <input type="color" name="qr_gradient_end" id="qr_gradient_end" class="form-control"
                                                   value="{{ old('qr_gradient_end') }}">
                                        </div>
                                        <div class="col-4">
                                            <label for="gradient_type" class="col-sm-12 control-label">QR Gradient Type</label>
                                            <select class="form-control" name="gradient_type" id="gradient_type">
                                                <option value="">Select Type</option>
                                                <option value="vertical">Vertical</option>
                                                <option value="horizontal">Horizontal</option>
                                                <option value="diagonal">Diagonal</option>
                                                <option value="inverse_diagonal">Inverse Diagonal</option>
                                                <option value="radial">Radial</option>
                                            </select>
                                        </div>
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
                                    @if (pathinfo(session('code'))['extension'] === 'eps')
                                        QR Code available, <a href="{{ asset('qr_code/' . session('code')) }}">click here</a> to download it.
                                    @else
                                        <img src="{{ asset('qr_code/' . session('code')) }}" alt="{{ session('code') }}" class="img-fluid">
                                        <h6 class="pt-3">{{ session('name') }}</h6>
                                    @endif
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
