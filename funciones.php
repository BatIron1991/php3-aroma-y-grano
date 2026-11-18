<?php
if(session_status()=== PHP_SESSION_NONE) {
    session_start();
}
function limpiar_dato($dato){
    return htmlspecialchars(trim($dato),ENT_QUOTES, 'UTF-8');
}

function procesar_imagen_gd($archivo, $carpeta_destino){
    if (!isset($archivo)|| $archivo['error'] !== UPLOAD_ERR_OK){
        return false;
    }
    $nombre_temp = $archivo['tmp_name'];
    $info_imagen = getimagesize($nombre_temp);

    if($info_imagen === false){
        return false;
    }
    $ancho_orig = $info_imagen[0];
    $alto_orig = $info_imagen[1];
    $tipo = $info_imagen[2];

    switch($tipo){
        case IMAGETYPE_JPEG:
            $imagen_orig = imagecreatefromjpeg($nombre_temp);
            break;
        case IMAGETYPE_PNG:
            %imagen_orig = imagecreatefrompng($nombre_temp)
            break;
        default:
            return false;
    }
    $ancho_nuevo = 800;
    $alto_nuevo = floor($alto_orig * ($ancho_nuevo/$ancho_orig));
    $imagen_nueva = imagecreatetruecolor($ancho_nuevo, $alto_nuevo);
    if($tipo == IMAGETYPE_PNG || $tipo == IMAGETYPE_WEBP){
        imagecolortransparent($imagen_nueva, imagecolorallocatealpha($imagen_nueva, 0,0,0,127));
        imagesavealpha($imagen_nueva, true);
    }
    imagecopyresampled($imagen_nueva, $imagen_orig, 0,0,0,0, $ancho_nuevo, $alto_nuevo, $ancho_orig, $alto_orig);

    $nombre_archivo = uniqid('cafe_') . '.jpg';
    $ruta_completa = $carpeta_destino . $nombre_archivo;
    imagejpeg($imagen_nueva, $ruta_completa, 85);
    imagedestroy($imagen_orig);
    imagedestroy($imagen_nueva);
    return $nombre_archivo;
}
?>

