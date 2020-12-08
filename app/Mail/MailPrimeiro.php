<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailPrimeiro extends Mailable
{
    use Queueable, SerializesModels;

    private $dados; 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dados)
    {
        $this->dados = $dados;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//dd($this->dados);
        $this->subject($this->dados['acao']);
        $this->to($this->dados['email'], $this->dados['nome']);
        $this->from('patrickramaz@gmail.com');
        return $this->view('mail.envioEmail', ['dados' => $this->dados]);
    }
}
