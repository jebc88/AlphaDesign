<?php

class Validation {

    static $validationErrors;
    /* no lo necesitamos
    function __construct() {

    }
    */

    /**
     * Revisar si el $contenido viene vacío
     * @param $contenido El contenido a validar
     */
    static function noEstaVacio($nombreCampo,$contenido) {
        $contenido = str_replace(" ","",$contenido);
        if(!$contenido || strlen($contenido) === 0){

            return array('resultado'=>false,
                'mensajeError' => "El campo $nombreCampo está vacío",
                'campoDelError' => $nombreCampo
            );

        }
        return true;
    }

    /**
     * Revisa que en los campos Select se haya escogido una opcion
     * @param $nombreCampo => Nombre del campo
     * @param $contenido => Contenido a validar
     * @return array|bool => Devuelve array si hay error o bool(true) si es correcto
     */
    static function validarSelect($nombreCampo, $contenido){
        if($contenido == -1){
            return array('resultado'=>false,
                         'mensajeError'=> "Debe seleccionar una opcion en $nombreCampo",
                         'campoDelError'=> $nombreCampo);
        }else{
            return true;
        }
    }

    /**
     * Revisa que el contenido sea alfanumerico
     * @param $nombreCampo => Nombre del campo
     * @param $contenido => Contenido a validar
     * @return array|bool => Devuelve array si hay error o bool(true) si es correcto
     */
    static function esAlfanumerico($nombreCampo, $contenido) {
        if(!ctype_alnum($contenido)){
            return array('resultado'=> false,
                         'mensajeError'=> "Campo $nombreCampo solo puede contener letras",
                         'campoDelError'=> $nombreCampo);
        }else{
            return true;
        }
    }

    /**
     * Revisa que el campo este compuesto por una cantidad minima de caracteres
     * @param $nombreCampo => Nombre del campo
     * @param $length => longitud a validar
     * @param $contenido => contenido a validar
     * @return array|bool => Devuelve array si hay error o bool(true) si es correcto
     */
    static function tieneXLongitud($nombreCampo, $length, $contenido) {

            if(strlen($contenido) < $length){
                return array('resultado'=> false,
                    'mensajeError'=> "Campo $nombreCampo no puede tener menos de $length caracteres",
                    'campoDelError'=> $nombreCampo);
            }else{
                return true;
            }
    }

    /**
     * Revisa que el campo solo posea caracteres numericos
     * @param $nombreCampo => nombre del campo
     * @param $contenido => contenido a validar
     * @return array|bool => devuelve array si no cumple o bool(true) si es correcto
     */
    static function esNumerico($nombreCampo, $contenido) {
        if(!is_numeric($contenido)){
            return array('resultado'=> false,
                         'mensajeError'=> "El campo $nombreCampo solo puede contener numeros",
                         'campoDelError'=> $nombreCampo);
        }else{
            return true;
        }
    }

    /**
     * Validando si el email es válido
     * @param $nombreCampo Nombre del campo en el formulario para display
     * @param $contenido  Contenido que ingresamos en el input del formulario
     */
    static function esEmail($nombreCampo,$contenido) {
        $bEsEmail = filter_var($contenido,FILTER_VALIDATE_EMAIL);
        //echo 'valor de $bEsEmail ';
        //var_dump($bEsEmail);
        if($bEsEmail === false){
            return array('resultado'=>false,
                'mensajeError' => "El formato del campo $nombreCampo es inválido.",
                'campoDelError' => $nombreCampo
            );

        }
        return true;
    }

    /**
     * Revisa que solo hayan caracteres alfabeticos en el contenido
     * @param $nombreCampo => nombre del campo
     * @param $contenido => contenido a validar
     * @return array|bool => devuelve array si no cumple o bool(true) si es correcto
     */
    static function esSoloAlfa($nombreCampo, $contenido) {
        if(!ctype_alpha($contenido)){
            return array('resultado'=>false,
                'mensajeError' => "El campo $nombreCampo solo puede contener letras",
                'campoDelError' => $nombreCampo
            );
        }
        return true;
    }

}