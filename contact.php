<?php 
$errors = '';
$myemail = 'rodolfonavarrete@hotmail.com'; // <----- Pon tu dirección de correo aquí

// Verificar si los campos están vacíos
if(empty($_POST['name'])  || 
   empty($_POST['email']) || 
   empty($_POST['message'])) 
{
    $errors .= "\n Error: all fields are required";
}

// Obtener los datos del formulario
$name = $_POST['name']; 
$email_address = $_POST['email']; 
$message = $_POST['message']; 

// Validación del correo electrónico
if (!preg_match(
"/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", 
$email_address)) 
{
    $errors .= "\n Error: Invalid email address";
}

// Si no hay errores, enviar el correo y redirigir al usuario
if( empty($errors)) {

    $to = $myemail;
    $email_subject = "Contact form submission: $name";
    $email_body = "You have received a new message. ".
    "Here are the details:\n Name: $name \n ".
    "Email: $email_address\n Message \n $message";

    $headers = "From: $myemail\n";
    $headers .= "Reply-To: $email_address";
    mail($to, $email_subject, $email_body, $headers);

    // Mostrar mensaje de agradecimiento y redirigir a la página de agradecimiento
    echo "<script>
            alert('Thank you for your message!');
            window.location.href = 'https://rodolfo-art.github.io/bookheaven/thank-you.html'; 
          </script>";
    exit; // Asegurarse de que el script termine aquí para evitar enviar más respuestas
} else {
    // Mostrar errores si los hay
    echo "There were errors with your form: $errors";
}
?>
