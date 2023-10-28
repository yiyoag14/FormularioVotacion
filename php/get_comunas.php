<?php
include 'funciones.php';

// Verificar si se envió el ID de la región y si no está vacío.
if (isset($_POST["region_id"]) && !empty($_POST["region_id"])) {
    // Asignar el ID de la región a la variable $region_id.
    $region_id = $_POST["region_id"];

    // Obtener la lista de comunas para la región específica.
    $comunas_lista = getComunas($conexion, $region_id);

    // Mostrar una opción por defecto.
    echo '<option value="0">Seleccione una comuna</option>';

    // Iterar sobre la lista de comunas y mostrar cada una como una opción en el desplegable.
    foreach ($comunas_lista as $comuna) {
        echo '<option value="' . $comuna['id'] . '">' . $comuna['nombre'] . '</option>';
    }
}
