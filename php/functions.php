<?php

class functions
{
    public static function convertirFecha($fecha) {
        $fecha_timestamp = strtotime($fecha);
        $hoy = strtotime('today');
        $ayer = strtotime('yesterday');
    
        // Si la fecha es hoy
        if ($fecha_timestamp >= $hoy) {
            return 'Hoy';
        }
        // Si la fecha es ayer
        elseif ($fecha_timestamp >= $ayer) {
            return 'Ayer';
        }
        // Si la fecha es hace X días
        else {
            $diferencia = floor((time() - $fecha_timestamp) / (60 * 60 * 24));
            if($diferencia <=7){
                return "Hace $diferencia días";
            }else{
                return self::fechaCompleta($fecha);
            }
            
        }
    }

    private static function fechaCompleta($fecha)
    {
        // Convertir la fecha al formato deseado
        $fecha = strftime("%d de %B del %Y", strtotime($fecha));
        $dateArr = explode(" ", $fecha); //SEPARA LA FECHA EN UN ARREGLO
        $dateArr[2] = self::mes($dateArr[2]); //REMPLAZA EL MES EN INGLES Y LOS TRADUCE A ESPAÑOL
        $fechaN = implode(" ", $dateArr); //VUELVE A UNIR EL ARREGLO EN UNA CADENA

        // Retornar la fecha formateada
        return $fechaN;
    }

    //METODO DE FILTRADO DE PUBLICACIONES
    public static function filtrado($carrera, $materia, $tipo)
    {
        $query = NULL;
        if($materia == NULL AND $tipo == NULL){
            $query = "SELECT p.*, u.nom_Us, u.apell_Us FROM publicacion p
            JOIN usuario u ON p.id_Usuario = u.idUsuario
            WHERE carrera_Pub = '$carrera'
            ORDER BY p.idPub";
        }
        elseif($tipo != NULL){
            $query = "SELECT p.*, u.nom_Us, u.apell_Us FROM publicacion p
            JOIN usuario u ON p.id_Usuario = u.idUsuario
            WHERE carrera_Pub = '$carrera'
            AND tipo_Pub = '$tipo'
            ORDER BY p.idPub";
        }
        elseif($materia != NULL){
            $query = "SELECT p.*, u.nom_Us, u.apell_Us FROM publicacion p
            JOIN usuario u ON p.id_Usuario = u.idUsuario
            WHERE carrera_Pub = '$carrera'
            AND materia_Pub = '$materia'
            ORDER BY p.idPub";
        }else{
            $query = "SELECT p.*, u.nom_Us, u.apell_Us FROM publicacion p
            JOIN usuario u ON p.id_Usuario = u.idUsuario
            WHERE carrera_Pub = '$carrera'
            AND materia_Pub = '$materia'
            AND tipo_Pub = '$tipo'
            ORDER BY p.idPub";
        }
        return $query;
    }
    private static function mes($month)
    {
        switch ($month) {
            case 'January':
                return 'Enero';
                break;
            case 'February':
                return 'Febrero';
                break;
            case 'March':
                return 'Marzo';
                break;
            case 'April':
                return 'Abril';
                break;
            case 'May':
                return 'Mayo';
                break;
            case 'June':
                return 'Junio';
                break;
            case 'July':
                return 'Julio';
                break;
            case 'August':
                return 'Agosto';
                break;
            case 'September':
                return 'Septiembre';
                break;
            case 'October':
                return 'Octubre';
                break;
            case 'November':
                return 'Noviembre';
                break;
            case 'December':
                return 'Diciembre';
                break;
        }
    }
}
