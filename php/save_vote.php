<?php
include 'db_connection.php';

// Recuperar datos del formulario o establecer valores predeterminados.
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$alias = isset($_POST['alias']) ? $_POST['alias'] : '';
$rut = isset($_POST['rut']) ? $_POST['rut'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$region = isset($_POST['region']) ? $_POST['region'] : '';
$comuna = isset($_POST['comuna']) ? $_POST['comuna'] : '';
$candidato = isset($_POST['candidato']) ? $_POST['candidato'] : '';
// Convertir el array de cómo se enteró a una cadena JSON para guardar en la base de datos.
$entero = isset($_POST['entero']) ? json_encode($_POST['entero']) : '';  

// Realizar validaciones básicas para asegurarse de que todos los campos tienen valores.
if(empty($nombre) || empty($alias) || empty($rut) || empty($email) || empty($region) || empty($comuna) || empty($candidato) || empty($entero)) {
    echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
    exit;
}

// Verificar si el RUT ya ha sido registrado previamente.
$query = "SELECT COUNT(*) as cuenta FROM votos WHERE rut = '$rut'";
$result = $conexion->query($query);

if(!$result) {
    die("Error en la consulta: " . $conexion->error);
}

$row = $result->fetch_assoc();
if ($row['cuenta'] > 0) {
    echo json_encode(['success' => false, 'message' => 'El RUT ya ha sido registrado anteriormente.']);
    exit;
}

// Insertar el nuevo voto en la base de datos.
$query = "INSERT INTO votos (nombre, alias, rut, email, region_id, comuna_id, candidato_id, como_se_entero) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($query);
if ($stmt === false) {
    die("Error preparando la consulta: " . $conexion->error);
}
$stmt->bind_param('ssssssss', $nombre, $alias, $rut, $email, $region, $comuna, $candidato, $entero);

// Si la inserción es exitosa, enviar una respuesta positiva, de lo contrario enviar un error.
if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Voto guardado con éxito.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al guardar el voto: ' . $stmt->error]);
}

// Cerrar el statement y la conexión a la base de datos.
$stmt->close();
$conexion->close();

?>
