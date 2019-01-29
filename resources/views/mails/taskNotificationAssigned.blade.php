<html>
    <head>
        
    </head>
    <body style="font-family: Verdana,sans-serif;">
       
            <img src="<?php echo $message->embed('logo_html.jpg'); ?>" style="height:60px;">
            <br>
            <br>
            Buenos días {{ $data -> p['nombre_usuario'] }},
            <br>
            <h3>{{ $data -> p['owner'] }}  {{ $data -> p['text_a'] }} </h3>
            <br>

        @if ( $data -> p['type'] == 'Meeting') 
            <h4 style=" font-weight: 100;" >Para ingresar al sistema y conocer el detalle de la reunión, agregar reuniones nuevas o marcar una reunión como finalizada: </h4>
        @endif

        @if ( $data -> p['type'] == 'GeneralTask') 
            <h4 style=" font-weight: 100;" >Para ingresar al sistema y conocer el detalle de la reunión, agregar reuniones nuevas o marcar una reunión como finalizada: </h4>
        @endif

        @if ( $data -> p['type'] == 'Project') 
            <h4 style=" font-weight: 100;" >Para ingresar al sistema y conocer el detalle de la anotación: </h4>
        @endif

        <a style=" text-decoration: none;width: 200px;" href="https://sistema.somostuwebmaster.es/{{$data -> p['user_referencia']}}"><span style=" background-color: rgb(5, 153, 255); color: white; width: 100px; text-align: center; padding: 10px; border-radius: 3px; box-shadow: 1px 1px 10px rgb(215, 215, 215);font-weight: 600;">&nbsp;&nbsp; Click Aquí&nbsp;&nbsp; </span></a><br><br><br><br>

        <div style=" min-height: 50px; clear: both;border: 2px solid gainsboro;padding: 5px;margin-bottom: 10px;background-color: white;gainsboro;">
            <div style="background-color: white; min-height: 20px; font-size: 14px;margin-top: 4px;">
                <span style=" font-weight: 600;">{{ $data -> p['task_title'] }}</span>
            </div>
            <?php
            if ($data -> p['location'] != '') {
               echo '<div style=" font-size: 12px;">Ubicación: '. $data -> p['location'].'</div>';
            }
            ?>
            <div style=" font-size: 12px;">Cliente: {{ $data -> p['customer'] }}</div>
            <?php
                $urgente = '';
                if ($data -> p['urgente'] == 1) {
                    $urgente = '<span style="color: #fffefe;font-weight: bold;background-color: #ff3333; margin-left: 20px;">&nbsp;&nbsp; ALTA &nbsp;&nbsp;</span>';
                }
            ?>
            <div style=" color: #03A9F4;font-size: 12px;">Fecha: {{ $data -> p['due_date'] }}  {{ $data -> p['due_time'] }} <?php echo  $urgente; ?> </div>
        </div> 
        
    </body>
</html>