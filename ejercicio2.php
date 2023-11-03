<?php
function is_valid_email($str)
{
    return (false !== filter_var($str, FILTER_VALIDATE_EMAIL));
}
function recoge($variable)
{
    //Comprobamos que la variable exista, sino la asignamos a null 
    $campo = $_POST[$variable] ?? null;
    $tmp = null;
    if ($variable != null) {
        $tmp = htmlspecialchars($campo);
        $tmp = trim($tmp);
        $tmp = strip_tags($tmp);
    } else {
        echo "<p>ERROR. El campo $variable es obligatorio";
    }
    return $tmp;
}
//Leemos cada una de las variables del formulario 
foreach ($_POST as $key => $value) {
    $variable = recoge($key);
    if ($variable != null) {
        if ($key == "nombre" ||  $key == "usuario") {
            echo "<p>$key: $value</p>";
        }
        if ($key === "pass") { //Comprobamos que el email sea válido 
            if ($value != $_POST["pass2"]) {
                echo "<p>ERROR. La contraseña y la confirmación no coinciden</p>";
            } else {
                echo "<p>$key: $value</p>";
                echo "<p>Contraseña encriptada: " . password_hash($value, PASSWORD_BCRYPT) ."</p>";
            }
        }
        if ($key == "email") { //Comprobamos que el email sea válido 
            if (!is_valid_email($value)) {
                echo "<p>ERROR. El email no es válido</p>";
            } else {
                echo "<p>$key: $value</p>";
            }
        }
        if ($key == "bloqueado") {
            //Comprobamos si está bloqueado o no 
            if ($value == "NOBLOQUEADO") {
                echo "<p>El usuario no está bloqueado</p>";
            } else {
                echo "<p>El usuario está bloqueado</p>";
            }
        }
        if (($key == "comercial" || $key == "marketing" || $key == "direccion")) {
            //Comprobamos los departamentos 
            echo "<p>Departamento: $key</p>";
        }
    } else {
        echo "<p>ERROR. Debe introducir un $key válido";
    }
}
