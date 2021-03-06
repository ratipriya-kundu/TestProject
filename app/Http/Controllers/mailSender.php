<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\OAuth2\Client\Provider\Google;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class mailSender extends Controller
{

    private $email;
    private $name;
    private $client_id;
    private $client_secret;
    private $token;
    private $provider;

    public function __construct()
    {
        $this->email            = 'ratipriyakundu5@gmail.com'; // ex. example@gmail.com
        $this->email_name       = 'Rati';     // ex. Abidhusain
        $this->client_id        = env('GMAIL_API_CLIENT_ID');
        $this->client_secret    = env('GMAIL_API_CLIENT_SECRET');
        $this->provider         = new Google(
            [
                'clientId'      => '319021979127-5476ilcbkth9od13533bnapjgrnjtu8c.apps.googleusercontent.com',
                'clientSecret'  => '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',
                'accessType'    => 'offline'
                
            ]
        );

    }

    public function sendMail(Request $request) {


        
        $this->token = $request->mailToken;

        $mail = new PHPMailer(true);
        
        try {
            
            $mail->isSMTP();
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->SMTPAuth = true;
            $mail->AuthType = 'XOAUTH2';
            $mail->setOAuth(
                new OAuth(
                    [
                        'provider'          => $this->provider,
                        'clientId'          => '319021979127-5476ilcbkth9od13533bnapjgrnjtu8c.apps.googleusercontent.com',
                        'clientSecret'      => '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',
                        'refreshToken'      => 'ya29.a0ARrdaM98XP_yf64CzUEMD-KPqVD9IV_zhvSQHfSXztg82cDITbBuudBTI0_-rUTaOP5mb67yAqDNDihxqCyPZye1igZQsqG-vrO8ehJZ-hipSXljB7th6KTys9cAH2Veg9hTebBu2OV6Z3nV6LkR6XGz2scsOA',
                        'userName'          => 'imaluopp@gmail.com',
                        'accessType'    => 'offline'
                    ]
                )
            );

            $mail->setFrom('imaluopp@gmail.com', 'Imal');
            
            $mail->addAddress('ratipriyakundu5@gmail.com', 'Rati');
            $mail->Subject = 'Laravel PHPMailer OAuth2 Integration';
            $mail->CharSet = PHPMailer::CHARSET_UTF8;
            $body = 'Hello <b>Everyone</b>,<br><br>We successfully completed our PHPMailer Integration in Laravel Project with Gmail OAuth2.<br><br>Thank you,<br><b>Abidhusain Chidi</b>';
            $mail->msgHTML($body);
            $mail->AltBody = 'This is a plain text message body';
            if( $mail->send() ) {
                return response()->json(['status'=>'success']);
            } else {
                return response()->json(['status'=>'no']);
            }
            
        } catch(Exception $e) {
            return response()->json(['status'=>'no']);
            //return redirect()->back()->with('error', 'Exception: ' . $e->getMessage());
        }
    }
}
