<?php

    //Reseteamos variables a 0.
    $nombre = $empresa = $email = $telefono = $whatsapp = $mensaje_adicional = $enableds = $prods_name = $large = $weights = $headers = $nombre_final = $msjCorreo = $wp_text = NULL;
    
    if (isset($_POST['submit'])) {

        //Obtener valores input formulario
        $nombre = $_POST['nombre'];
        $empresa = $_POST['empresa'];
        $email = $_POST['email'];   
        $telefono = $_POST['telefono'];
        $whatsapp =  $_POST['whatsapp'];
        $mensaje_adicional =  $_POST['mensaje_adicional'];
        $enableds =  $_POST['enableds'];
        $prods_name =  $_POST['prods_name'];
        $larges =  $_POST['larges'];
        $weights =  $_POST['weights'];
        $prods_id = $_POST['prods_id'];

        $nombre_final = $email;
        //Verificar nombre ingresado.
        if(isset($empresa)){
        $nombre_final = $empresa;
        }
        else if(isset($nombre)){
        $nombre_final = $nombre;
        }

        $admin_email = get_option('admin_email');
        $subject = "Nueva solicitud de cotización de $nombre_final";

        if(isset($whatsapp)){
            $whatsapp == true ? $wp_text = "Sí" : $wp_text = "No";
        }
 

        //Cuerpo del correo.
        $msjCorreo = "<h2>Nueva solicitud: " . $nombre_final ." </h2>";
        $msjCorreo .= "<p>Nombre: " . $nombre . "</p>";
        $msjCorreo .= "<p>Empresa: " . $empresa . "</p>";
        $msjCorreo .= "<p>Email: " . $email . "</p>";
        $msjCorreo .= "<p>Teléfono: " . $telefono . "</p>";
        $msjCorreo .= "<p>¿Whatsapp?: " . $wp_text . "</p>";
        $msjCorreo .= "<p>Mensaje adicional: " . $mensaje_adicional . "</p>";

        $mail_table = "
        <table>
            <thead>
                <tr>
                    <th style=\"width:50%;\">Producto</th>
                    <th style=\"width:25%;\">Largo (m)</th>
                    <th style=\"width:25%;\">Peso aproximado (kg)</th>
                </tr>
            </thead>
            <tbody>
            ";   
        
        foreach($enableds as $prod_id => $value ){
            $mail_table .=  "
            <tr>
                <td style=\"text-align:center\">$prods_name[$prod_id]</td>
                <td style=\"text-align:center\">$larges[$prod_id]</td>
                <td style=\"text-align:center\">$weights[$prod_id]</td>
            </tr>";               
        }
        $mail_table .= "
                </tbody>
            </table>";

        $msjCorreo .= $mail_table;
            
        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'Reply-To: ' . $nombre_final . '<'.$email.'>'
        );

          
        if (wp_mail($admin_email, $subject, $msjCorreo, $headers)) {
                echo "<script language='javascript'>
                alert('Hemos recibido satisfactoriamente tu solicitud de cotización. Pronto nos pondremos en contacto');
                </script>";
        } else {
                echo "<script language='javascript'>
                alert('No se pudo enviar el mensaje. Intente nuevamente más tarde.');
                </script>";
        }
    }