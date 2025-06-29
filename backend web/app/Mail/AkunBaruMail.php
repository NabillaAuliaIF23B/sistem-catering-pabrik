<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AkunBaruMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function build()
    {
        return $this->subject('Akun Baru - PT Catering Days')
            ->view('emails.akun_baru')
            ->with([
                'nama' => $this->details['nama'],
                'username' => $this->details['username'],
                'password' => $this->details['password'],
            ]);
    }
}
