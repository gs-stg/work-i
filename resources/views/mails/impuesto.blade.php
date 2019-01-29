
<html>
    <body style="color: rgb(142, 142, 142);">
        <img src="<?php echo $message->embed('logo_html.jpg'); ?>">
        <hr>
        <div>
        Estimado(a) <strong>{{ $i_mail->cliente }}</strong>,
        </div>
        <br>
        <br>
        Adjuntamos la copia del cuestionario para la Declaración de la Renta del Ejercicio {{$i_mail->year}} 
        Si percibe algún error por favor contáctenos. 
        <br>
        Una vez realizada su declaración será contactado.
        <br>
		Gracias por utilizar nuestros servicios.
        <br> <br> <br>
        {{$i_mail->representante}}
        <br>
        <br>
        <br>
        
        <br>
    </body>
</html>