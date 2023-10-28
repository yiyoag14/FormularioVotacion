<?php
/**
 * Este archivo se encarga de realizar operaciones relacionadas con la base de datos,
 * como obtener regiones, comunas y candidatos.
 */
include 'db_connection.php';

/**
 * Obtiene todas las regiones de la base de datos.
 * 
 * @param mysqli $conexion - La conexión a la base de datos.
 * @return array - Un array con las regiones obtenidas.
 */
function getRegiones($conexion) {
    $regiones = [];
    $result = $conexion->query("SELECT * FROM regiones");
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $regiones[] = $row;
        }
    }
    return $regiones;
}

/**
 * Obtiene todas las comunas asociadas a una región específica.
 * 
 * @param mysqli $conexion - La conexión a la base de datos.
 * @param int $region_id - El ID de la región para filtrar las comunas.
 * @return mysqli_result - El resultado de la consulta.
 */
function getComunas($conexion, $region_id) {
    $query = "SELECT * FROM comunas WHERE region_id = $region_id";
    $result = $conexion->query($query);
    return $result;
}

/**
 * Obtiene todos los candidatos de la base de datos.
 * 
 * @param mysqli $conexion - La conexión a la base de datos.
 * @return array - Un array con los candidatos obtenidos.
 */
function getCandidatos($conexion) {
    $candidatos = [];
    $result = $conexion->query("SELECT * FROM candidatos");
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $candidatos[] = $row;
        }
    }
    return $candidatos;
}