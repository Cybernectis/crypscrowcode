<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMagicMail extends Mailable
{
    use Queueable, SerializesModels;
    public $mailData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    } 

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->mailData;

        return $this->from($data['user_email'], $data['user_name'])
                    ->subject($data['subject'])
                    ->view('frontends.emails.magiclink')
                    ->with(array('name'=>$data['name'], 'headerMessage'=> $data['headerMessage'], 'message1'=> $data['message1'], "dataurl"=>$data['dataurl']));
    }
}
