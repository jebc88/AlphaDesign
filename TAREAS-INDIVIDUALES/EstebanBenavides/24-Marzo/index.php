<?php
/////////////////////////////////////////////////////////////////////////////////////////////
// LEER BIEN LOS COMENTARIOS, ALGUNOS PUNTOS HAN SIDO INCLUIDOS Y/O COMENTADOS A PROPOSITO.//
/////////////////////////////////////////////////////////////////////////////////////////////
/*
 * BITIC-25: Proyecto Web 1
 * Hecho por: Jose Esteban Benavides Cordero
 * Fecha: 24 de Marzo, 2015
 *
 * Validaciones:
 *
 * Nombre:
 * no esta vacio
 * que solo contenga caracteres alfabeticos
 *
 * Apellido1 y Apellido2:
 * no esta vacio
 * que solo contenga caracteres alfabeticos
 *
 * Email:
 * no esta vacio
 * que formato email sea correcto
 *
 * Telefono:
 * no esta vacio
 * que solo tenga caracteres numericos
 * que su valor no sea menor de 8 digitos
 *
 * Genero y Estado Civil:
 * que se haya seleccionado al menos una opcion
 *
 *
 */
require_once("lib/Validation.php");
if($_POST) {
    $arrErrores = array();
    //var_dump($_POST);
    $valNombre = Validation::noEstaVacio("Nombre",$_POST['nombre']);
    if(is_array($valNombre)){
        $arrErrores[] = $valNombre['mensajeError'];
    }else{
        $valType = Validation::esSoloAlfa("Nombre",$_POST['nombre']);
        if(is_array($valType)){
            $arrErrores[] = $valType['mensajeError'];
        }
    }

    $valApellido1 = Validation::noEstaVacio("Apellido1",$_POST['apellido1']);
    if(is_array($valApellido1)){
        $arrErrores[] = $valApellido1['mensajeError'];
    }else{
        $valType = Validation::esSoloAlfa("Apellido1",$_POST['apellido1']);
        if(is_array($valType)){
            $arrErrores[] = $valType['mensajeError'];
        }
    }

    $valApellido2 = Validation::noEstaVacio("Apellido2",$_POST['apellido2']);
    if(is_array($valApellido2)){
        $arrErrores[] = $valApellido2['mensajeError'];
    }else {
        $valType = Validation::esSoloAlfa("Apellido2", $_POST['apellido2']);
        if (is_array($valType)) {
            $arrErrores[] = $valType['mensajeError'];
        }
    }

    $valEmail = Validation::noEstaVacio("Email", $_POST['email']);
    if(is_array($valEmail)) {
        $arrErrores[] = $valEmail['mensajeError'];
    }else {
        $valEmailFormato = Validation::esEmail("Email", $_POST['email']);
        if(is_array($valEmailFormato)) {
            $arrErrores[] = $valEmailFormato['mensajeError'];
        }
    }

    $valTelefono = Validation::noEstaVacio("Telefono", $_POST['telefono']);
    if(is_array($valTelefono)){
        $arrErrores[] = $valTelefono['mensajeError'];
    }else{
        $valNumero = Validation::esNumerico("Telefono", $_POST['telefono']);
        if(is_array($valNumero)){
            $arrErrores[] = $valNumero['mensajeError'];
        }else{
            $valLength = Validation::tieneXLongitud("Telefono", 8, $_POST['telefono']);
            if(is_array($valLength)){
                $arrErrores[] = $valLength['mensajeError'];
            }
        }

    }

    $valGenero = Validation::validarSelect("Genero", $_POST['genero']);
    if(is_array($valGenero)){
        $arrErrores[] = $valGenero['mensajeError'];
    }

    $valEstadoCivil = Validation::validarSelect("Estado Civil", $_POST['estadoCivil']);
    if(is_array($valEstadoCivil)){
        $arrErrores[] = $valEstadoCivil['mensajeError'];
    }
}

?>
<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div>Ejemplos de validacion</div>
        <form name="frmCedula" method="post" action="index.php" >
            <ul>
                <li><label>Nombre*: </label> <input type="text" name="nombre"></li>
                <li><label>Apellido1*: </label> <input type="text" name="apellido1"></li>
                <li><label>Apellido2*: </label> <input type="text" name="apellido2"></li>
                <li><label>Email*: </label> <input type="text" name="email"></li>
                <li><label>Telefono*: </label> <input type="text" name="telefono"></li>
                <li>
                    <label>Género*: </label>
                    <select name="genero">
                        <option value="-1">Seleccionar Uno...</option>
                        <option value="mas">Masculino</option>
                        <option value="fem">Femenino</option>
                    </select>
                    <br/>
                    <br/>
                    <br/>
                </li>
                <li><label>Dirección*: </label> <textarea cols="10" rows="5"></textarea> </li>
                <li>
                    <label>Estado civil*: </label>
                    <select name="estadoCivil">
                        <option value="-1">Seleccionar Uno...</option>
                        <option value="soltero">Soltero</option>
                        <option value="casado">Casado</option>
                        <option value="viudo">Viudo</option>
                        <option value="unionLibre">Union Libre</option>
                    </select>
                    <br/>
                    <br/>
                    <br/>
                </li>
                <li><input type="submit" value="Enviar Datos"></li>
                <?php if($_POST) { ?>
                <li>

                    <ul class="mensajeError">
                        <?php

                            if(sizeof($arrErrores) > 0){
                                foreach($arrErrores as $strError) {
                                    echo("<li>$strError</li>");
                                }
                            }
                        ?>
                    </ul>

                </li>
                <?php } ?>
            </ul>

        </form>

    </body>
</html>