<html>
    <head>
        <style>
        .note_title {
            color: rgb(154, 156, 163);
            background-color: rgb(255, 252, 123);
            padding: 5px 2px 5px 10px;
            text-transform: capitalize;
        }
        .notes {
           
            width: 100%;
            height: 100px;
            font: normal 14px verdana;
            line-height: 25px;
            min-height: 100px;
            padding: 2px 0px;
            border: none;
            background-color: rgb(255, 251, 211);
            color: rgb(90, 90, 90);
        }
        </style>
    </head>
    <body style="color: rgb(142, 142, 142);">
        <img src="<?php echo $message->embed('logo_html.jpg'); ?>">
        <hr>
        @if($i_mail -> mode == 'c')
            <div>
                Estimado(a) <strong>{{ $i_mail->cliente }}</strong>,
            </div>
            <br>
            <br>
                A continuación encontrará las actualizaciones de las anotaciones del Cuestionario de Renta {{$i_mail->year}} 
                Si percibe algún error por favor contáctenos. 
            <br>
                Estas anotaciones forman parte de nuestro esfuerzo por mantenerle siempre informado. Por favor reviselas detenidamente, ya que puede requerir una acción de su parte.
            <br>
                Si percibe algún error por favor contáctenos. Una vez presentada su declaración será contactado.
            <br>
                Gracias una vez más por utilizar nuestros servicios.
            <br> <br> <br>
            {{$i_mail->representante}}
            <br>
        @endif

        @if($i_mail -> mode == 'd')
            <div>
                Estimado(a) <strong>{{ $i_mail->team_member }}</strong>,
            </div>
            <br>
            <br>
            A continuación encontrarán las actualizaciones de las anotaciones internas del Cuestionario de Renta {{$i_mail->year}}  del Cliente {{ $i_mail->cliente }}.
            <br>
            Por favor revisarlas detenidamente, ya que puede requerir una acción de su parte.
            <br> <br> 
            {{$i_mail->representante}}
            <br> 
        @endif
        
        <h3>ANOTACIONES</h3>
        <div id="">
            @foreach($i_mail -> note as $n) 
            <div class="note_title">{{$n -> tb_anotacionesUsuario}} {{$n -> tb_anotacionesDate}}</div>
            <div class="notes"  style=" margin-bottom: 10px;" >{{$n -> tb_anotacionesNotes}}</div>
            @endforeach
        </div>
        <br>
        <br>
        <br>
    </body>
</html>