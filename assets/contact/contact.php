<?php
 
// Clean up the input values
foreach($_POST as $key => $value) {
  if(ini_get('magic_quotes_gpc'))
    $_POST[$key] = stripslashes($_POST[$key]);
 
  $_POST[$key] = htmlspecialchars(strip_tags($_POST[$key]));
}
 
// Assign the input values to variables for easy reference
$name = $_POST["nombre"];
$lname = $_POST["apellido"];
$subject = $_POST["asunto"];
$email = $_POST["email"];
$message = $_POST["mensaje"];
 
// Test input values for errors
$errors = array();
if(strlen($name) < 2) {
  if(!$name) {
    $errors[] = "Necesitamos que nos dejes tu nombre.";
  } else {
    $errors[] = "El campo nombre debe ser de al menos 2 caracteres.";
  }
}

if(empty($lname)){
	$lname = "S/A";
}

if(strlen($subject) < 2) {
  if(!$subject) {
    $errors[] = "Necesitamos que nos dejes el asunto de tu mensaje";
  } else {
    $errors[] = "El campo asunto debe ser de al menos 2 caracteres.";
  }
}

if(!$email) {
  $errors[] = "Debes ingresar un email para que podamos contactarte";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
  // echo("$email is a valid email address");
} else {
   $errors[] = "El email ingresado no es valido";
}
	
if(strlen($message) < 10) {
  if(!$message) {
   $errors[] = "Necesitamos que nos dejes tu mensaje.";
  } else {
     $errors[] = "El mensaje nombre debe ser de al menos 10 caracteres.";
  }
}
 
if($errors) {
  // Output errors and die with a failure message
  $errortext = "";
  foreach($errors as $error) {
    $errortext .= "<li>".$error."</li>";
  }
  die("<span class='failure'>Ocurrieron los siguientes errores:<ul>". $errortext ."</ul></span>");
}
 
// Send the email
$to = "banda@guacho.uy";
$subject = "Msj Web de: $name $lname";
$message = "Asunto: $subject \nMensaje: $message";
$headers = "From: $email";
 
mail($to, $subject, $message, $headers);
 
// Die with a success message
die("<span class='success'>Gracias por tu mensaje! Nos pondremos en contacto contigo a la brevedad.</span>");
 

 
?>