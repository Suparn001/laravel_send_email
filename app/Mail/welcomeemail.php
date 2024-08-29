<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class welcomeemail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $request;
    public $filename;
    public $subject;
    //private $details;

    public function __construct($request,$filename)
    {
        $this->request =$request;
        $this->filename = $filename;
        //$this->details  = $details;
    }

    /**
     * Get the message envelope.
     */

    
    public function envelope(): Envelope
    {
        return new Envelope(     // return subject
            subject: "contact form",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content  // return text file/ view file
    {
        return new Content(
            view: 'mail.welcome-email',
            // with:[
            //     'name' =>$this->details['name'],
            //     'product' =>$this->details['product'],
            //     'price' =>$this->details['price']
            // ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];
        if($this->filename){
            $attachments =[
                Attachment::fromPath(public_path('/uploads/'.$this->filename))
            ];
        }
        return $attachments;  // return attachemnts like pdf, word file
    }
}
