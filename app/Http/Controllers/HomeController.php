<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use App\Models\Product;
use App\Models\AboutUs;
// use Illuminate\Database\Eloquent\Model;


class HomeController extends Controller
{
    // public function index()
    // {
    //     return view('home');
    // }

    public function index()
{
    $products = Product::all();
    $about = AboutUs::first();
    return view('home', compact('products', 'about'));
}
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = config('mail.mailers.smtp.host');
            $mail->SMTPAuth   = true;
            $mail->Username   = config('mail.mailers.smtp.username');
            $mail->Password   = config('mail.mailers.smtp.password');
            $mail->SMTPSecure = config('mail.mailers.smtp.encryption');
            $mail->Port       = config('mail.mailers.smtp.port');

            // Recipients
            $mail->setFrom($request->email, $request->name);
            $mail->addAddress(config('mail.from.address'));

            // Content
            $mail->isHTML(true);
            $mail->Subject = $request->subject;
            $mail->Body    = view('emails.contact', [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone ?? 'N/A',
                'message' => $request->message
            ])->render();

            $mail->send();

            return response()->json([
                'success' => true,
                'message' => 'Your message has been sent!'
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "Message could not be sent. Error: {$mail->ErrorInfo}"
            ], 500);
        }
    }
}
