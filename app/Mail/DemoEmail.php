<?php
 
namespace App\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
 
class DemoEmail extends Mailable
{
    use Queueable, SerializesModels;
     
    /**
     * The demo object instance.
     *
     * @var Demo
     */
    public $demo;
 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($demo)
    {
        $this->demo = $demo;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //'mails.demo'
        return $this->from('presupuestos@mhf.es', 'Gestoría Sampablo') -> view($this->demo->vista) -> attach(
            public_path('/pdf').'/'.$this->demo->pdf, ['as' => $this->demo->pdf, 'mime' => 'application/pdf']
        )->subject('Presupuesto');
    }
}