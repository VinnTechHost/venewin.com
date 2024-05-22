<?php

if(isset($_POST['email'])) {
    // 
    $email_to = "vicgorrin@venewin.com";
    $email_subject = "Quiero contactarme con VENEWIN";

    function died($error) {
        // mensajes de error
        echo "Lo sentimos, hubo un error en sus datos y el formulario no puede ser enviado en este momento. ";
        echo "Detalle de los errores.<br /><br />";
        echo $error."<br /><br />";
        echo "Por favor corrija estos errores e inténtelo de nuevo.<br /><br />";
        die();
    }

  // Se valida que los campos del formulairo estén llenos

    if(!isset($_POST['empresa']) ||
        !isset($_POST['contacto']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
        !isset($_POST['sistema']) ||
        !isset($_POST['message'])) {
        die('Lo sentimos pero parece haber un problema con los datos enviados.');
    }

 //En esta parte el valor "name"  sirve para crear las variables que recolectaran la información de cada campo

    $empresa = $_POST['empresa']; // requerido
    $contacto = $_POST['contacto']; // requerido
    $email_from = $_POST['email']; // requerido
    $telephone = $_POST['telephone']; // no requerido 
    $sistema = $_POST['sistema']; // requerido
    $message = $_POST['message']; // requerido
    $error_message = "";//Linea numero 52;

//En esta parte se verifica que la dirección de correo sea válida 

   $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'La dirección de correo proporcionada no es válida.<br />';
  }

//En esta parte se validan las cadenas de texto

    $string_exp = "/^[A-Za-z .'-]+$/";

  //if(!preg_match($string_exp,$empresa)) {
  //
  //  $error_message .= 'El formato del nombre de empresa no es válido<br />';
  //}

  //if(!preg_match($string_exp,$contacto)) {

  //  $error_message .= 'El formato del nombre de contacto no es válido.<br />';
  //}

  if(strlen($message) < 2) {

    $error_message .= 'El formato del texto no es válido.<br />';
  }

  if(strlen($error_message) > 0) {

    die($error_message);
  }

//Este es el cuerpo del mensaje tal y como llegará al correo

    $email_message = "Contenido del Mensaje.\n\n";

    function clean_string($string) {

      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }

    $email_message .= "Empresa: ".clean_string($empresa)."\n";
    $email_message .= "Contacto: ".clean_string($contacto)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Teléfono: ".clean_string($telephone)."\n";
    $email_message .= "Servicio: ".clean_string($sistema)."\n";
    $email_message .= "Mensaje: ".clean_string($message)."\n";

//Se crean los encabezados del correo

$headers = 'From: '.$email_from."\r\n".

'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);
header("Location:index.html");
?>

<!-- Mensaje de que fue enviado-->
<!-- Gracias! Nos pondremos en contacto contigo a la brevedad -->
<?php 

}
?>