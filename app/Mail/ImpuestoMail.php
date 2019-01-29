<?php
 
namespace App\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
 
class ImpuestoMail extends Mailable
{
    use Queueable, SerializesModels;
     
    /**
     * The demo object instance.
     *
     * @var impuesto
     */
    public $i_mail;
 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($i_mail)
    {
        $this->i_mail = $i_mail;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //'mails.demo'
        if ($_SERVER['SERVER_NAME'] == 'renta.somostuwebmaster.es') { 
            return $this->from('turnoderenta@gestoresmadrid.org', 'Servicio de Rentas') -> view($this->i_mail->vista) -> attach(
                public_path('/pdf').'/'.$this->i_mail->pdf, ['as' => $this->i_mail->pdf, 'mime' => 'application/pdf']
            )->subject('Cuestionario Renta '.$this->i_mail->year.' '.$this->i_mail->cliente);
        } else {
            return $this->from('presupuestos@mhf.es', 'Servicio de Rentas (Gestoría Sampablo)') -> view($this->i_mail->vista) -> attach(
                public_path('/pdf').'/'.$this->i_mail->pdf, ['as' => $this->i_mail->pdf, 'mime' => 'application/pdf']
            )->subject('Cuestionario Renta '.$this->i_mail->year.' '.$this->i_mail->cliente);
        }
    }
}