<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Facades\Storage;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class DadosCadastrais extends Mailable
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
        return new Envelope(
            from: new Address($this->data['fromEmail'], $this->data['fromName']),
            subject: $this->data['subject'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            // html: view('mails.enviar_inscricao', ['data' => $this->data['message']])->render(),
            // $nome_simples = explode( " ", $this->data['message']['name'] );
            // $nome_simples = $nome_simples[0] .' '.end($nome_simples);
            view: 'mails.adm.cadastro',
            with: [
                'dados' => $this->data['message'],
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
        $fotoPath = 'app'.DIRECTORY_SEPARATOR.'fotos'.DIRECTORY_SEPARATOR . $this->data['message']->foto;
        // $normalizedPath = str_replace('/', DIRECTORY_SEPARATOR, $fotoPath);
        $filePath = storage_path($fotoPath);

        if (!file_exists($filePath)) {
            throw new \Exception("O arquivo não existe: {$filePath}");
        }

        if (!is_readable($filePath)) {
            throw new \Exception("O arquivo não tem permissão de leitura: {$filePath}");
        }


        return [
            // Attachment::fromPath(storage_path('app/fotos/' . $this->data['message']->foto))
            Attachment::fromPath(storage_path($fotoPath))
        ];
        
        
    }
}
