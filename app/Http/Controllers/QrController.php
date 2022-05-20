<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Spatie\Color\Hex;

class QrController extends Controller
{
    public function index()
    {
        return view('qr-code.index');
    }

    public function quBuild(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $name = $request->input('name');
        $image_type = $request->input('image_type') ?? 'png';
        $code = Str::slug($name) . '.' . $image_type;
        $body = $request->input('body');
        $qr_attachment = $request->input('qr_attachment');
        $size = $request->input('qr_size') ?? '300';
        $error_correction = $request->input('error_correction') ?? 'H';
        $encoding = $request->input('encoding') ?? 'UTF-8';
        $qr_margin = $request->input('qr_margin') ?? '0';
        $qr_style = $request->input('qr_style') ?? 'square';
        $qr_eye = $request->input('qr_eye') ?? 'square';
        $color = Hex::fromString($request->input('color') ?? '#000000')->toRgb();
        $background_color = Hex::fromString($request->input('background_color') ?? '#000000')->toRgb();
        $background_transparent = $request->input('background_transparent') ?? '25';

        $eye_color_inner_0 = Hex::fromString($request->input('eye_color_inner_0') ?? '#000000')->toRgb();
        $eye_color_outer_0 = Hex::fromString($request->input('eye_color_outer_0') ?? '#000000')->toRgb();
        $eye_color_inner_1 = Hex::fromString($request->input('eye_color_inner_1') ?? '#000000')->toRgb();
        $eye_color_outer_1 = Hex::fromString($request->input('eye_color_outer_1') ?? '#000000')->toRgb();
        $eye_color_inner_2 = Hex::fromString($request->input('eye_color_inner_2') ?? '#000000')->toRgb();
        $eye_color_outer_2 = Hex::fromString($request->input('eye_color_outer_2') ?? '#000000')->toRgb();

        $qr_gradient_start  = Hex::fromString($request->input('qr_gradient_start') ?? '#000000')->toRgb();
        $qr_gradient_end  = Hex::fromString($request->input('qr_gradient_end') ?? '#000000')->toRgb();
        $gradient_type   = $request->input('gradient_type') ?? 'vertical';

        $qr = QrCode::format($image_type)
            ->encoding($encoding)
            ->errorCorrection($error_correction)
            ->color($color->red(), $color->green(), $color->blue())
            ->size($size)
            ->margin($qr_margin)
            ->style($qr_style)
            ->eye($qr_eye)
            ->backgroundColor($background_color->red(), $background_color->green(), $background_color->blue(), $background_transparent)
            ->eyeColor(0,
                $eye_color_inner_0->red(),
                $eye_color_inner_0->green(),
                $eye_color_inner_0->blue(),
                $eye_color_outer_0->red(),
                $eye_color_outer_0->green(),
                $eye_color_outer_0->blue()
            )
            ->eyeColor(1,
                $eye_color_inner_1->red(),
                $eye_color_inner_1->green(),
                $eye_color_inner_1->blue(),
                $eye_color_outer_1->red(),
                $eye_color_outer_1->green(),
                $eye_color_outer_1->blue()
            )
            ->eyeColor(2,
                $eye_color_inner_2->red(),
                $eye_color_inner_2->green(),
                $eye_color_inner_2->blue(),
                $eye_color_outer_2->red(),
                $eye_color_outer_2->green(),
                $eye_color_outer_2->blue()
            )
            ->gradient(
                $qr_gradient_start->red(),
                $qr_gradient_start->green(),
                $qr_gradient_start->blue(),
                $qr_gradient_end->red(),
                $qr_gradient_end->green(),
                $qr_gradient_end->blue(),
                $gradient_type
            );

            if ($qr_attachment == 'yes'){
                $qr->merge('../public/logo.png', .3, true);
            }

            $qr->generate($body, '../public/qr_code/' . $code);

        return back()->with([
            'status' => 'QR Code Generated Successfully',
            'code' => $code,
            'name' => $name
        ]);
    }

    public function email()
    {
        return view('qr-code.email');
    }

    public function doEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $email = $request->input('email') ?? 'test@example.com';
        $subject = $request->input('subject') ?? 'test subject';
        $message = $request->input('message') ?? 'test message';

        $code = QrCode::email($email, $subject, $message);

        return back()->with([
            'status' => 'QR Code Generated Successfully',
            'code' => $code,
            'email' => $email
        ]);
    }

    public function phone()
    {
        return view('qr-code.phone');
    }

    public function doPhone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pin' => 'required',
            'number' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $pin = $request->input('pin') ?? '0020';
        $number = $request->input('number') ?? '1153225410';

        $code = QrCode::phoneNumber($pin . $number);

        return back()->with([
            'status' => 'QR Code Generated Successfully',
            'code' => $code,
            'number' => $pin . '-' .$number
        ]);
    }

    public function sms()
    {
        return view('qr-code.sms');
    }

    public function doSms(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pin' => 'required',
            'number' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $pin = $request->input('pin') ?? '0020';
        $number = $request->input('number') ?? '1153225410';
        $message = $request->input('message') ?? 'this is test message';

        $code = QrCode::SMS($pin . $number, $message);

        return back()->with([
            'status' => 'QR Code Generated Successfully',
            'code' => $code,
            'number' => $pin . '-' .$number
        ]);
    }

    public function wifi()
    {
        return view('qr-code.wifi');
    }

    public function doWifi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ssid' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $ssid = $request->input('ssid');
        $encryption = $request->input('encryption');
        $password = $request->input('password');
        $hidden = $request->input('hidden');


            $code = QrCode::wiFi([
                'encryption' => $encryption,
                'ssid' => $ssid,
                'password' => $password,
                'hidden' => $hidden
            ]);




        return back()->with([
            'status' => 'QR Code Generated Successfully',
            'code' => $code,
        ]);
    }
}
