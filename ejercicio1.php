<?php //Comprueba si un email es válido 
function is_valid_email($str)
{
    return (false !== filter_var($str, FILTER_VALIDATE_EMAIL));
}
//Comprueba si un número es válido 
function is_valid_number($str)
{
    return (false !== filter_var($str, FILTER_VALIDATE_INT));
}
//Comprueba si un dni es válido mediante expresión regular 
function is_valid_dni($str)
{
    if (strlen($str) != 9 || preg_match('^\d{8}[a-zA-Z]{1}$^', $str, $matches) !== 1) {
        return false;
    }
    return true;
}
$texto = $_POST["texto"] ?? null;
$validacion = $_POST["validacion"] ?? null;
switch ($validacion) {
    case 'email':
        if ($texto != null) {
            $emailValido = is_valid_email($texto);
            if ($emailValido) {
                echo "<p>El email es válido </p>";
            } else {
                echo "<p>El email no es válido </p>";
            }
        }
        break;
    case 'dni':
        if ($texto != null) {
            $dniValido = is_valid_dni($texto);
            if ($dniValido) {
                echo "<p>El DNI es válido </p>";
            } else {
                echo "<p>El DNI no es válido </p>";
            }
        }
        break;
    case 'numeros':
        if ($texto != null) {
            $dniValido = is_valid_number($texto);
            if ($dniValido) {
                echo "<p>El número es válido </p>";
            } else {
                echo "<p>El número no es válido </p>";
            }
        }
        break;
    default:
        # code... 
        break; 
}
