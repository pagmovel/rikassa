<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public function __construct(public readonly array $data)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        // dd(config('mail.mailers'));

        return new Envelope(
            from: new Address($this->data['fromEmail'], $this->data['fromName']),
            subject: $this->data['subject'],
//            replyTo:[
//                new Address(env('MAIL_ADDRESS_RECEIVE'), env('MAIL_NAME_RECEIVE')),
//            ],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // return new Content(
        //     html: view('mails.enviar_inscricao', ['data' => $this->data['message']])->render(),
        // );

        return new Content(
            // html: view('mails.enviar_inscricao', ['data' => $this->data['message']])->render(),
            // $nome_simples = explode( " ", $this->data['message']['name'] );
            // $nome_simples = $nome_simples[0] .' '.end($nome_simples);
            view: 'mails.enviar_confirmacao_inscricao',
            with: [
                'dados' => $this->data['message'],
                'nome'  => $this->data['message']['nome'],
                'email'  => $this->data['message']['email'],
                'url'  => $this->data['url'],
                'nome_reduzido' => implode(' ', [$first = current($parts = explode(' ', trim($this->data['message']['nome']))), $last = end($parts)]),
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
