<?php
include 'php/funciones.php';
$regionesList = getRegiones($conexion);
$candidatos = getCandidatos($conexion);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Votación</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    <div class="container">
        <h3>FORMULARIO DE VOTACION</h3>
        <form id="votingForm" method="post" action="php/save_vote.php">
            <div>
                <label for="nombre">Nombre y Apellido:</label>
                <input autofocus type="text" onblur="validarNombre(this)" id="nombre" name="nombre" required>
                <span id="nombreError" style="color: red;"></span>
            </div>

            <div>
                <label for="alias">Alias:</label>
                <input type="text" onblur="validarAlias(this)" id="alias" name="alias" required>
                <span id="aliasError" style="color: red;"></span>
            </div>

            <div>
                <label for="rut">RUT:</label>
                <input type="text" oninput="validarRUT(this)" id="rut" name="rut" required>
                <span id="rutError" style="color: red;"></span>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" onchange="validarEmail(this)" id="email" name="email" required>
                <span id="emailError" style="color: red;"></span>
            </div>

            <div>
                <label for="region">Región:</label>
                <select id="region" name="region" required>
                    <option value="0">Seleccione una región</option>
                    <?php foreach ($regionesList as $region): ?>
                        <option value="<?= $region['id'] ?>"><?= $region['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="comuna">Comuna:</label>
                <select id="comuna" name="comuna" required>
                    <option value="0">Seleccione primero una región</option>
                </select>
            </div>

            <div>
                <label for="candidato">Candidato:</label>
                <select id="candidato" name="candidato" required>
                    <option value="0">Seleccione un candidato</option>
                    <?php foreach ($candidatos as $candidato): ?>
                        <option value="<?php echo $candidato['id']; ?>">
                            <?php echo $candidato['nombre']; ?> (<?php echo $candidato['partido_politico']; ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label>¿Cómo se enteró de nosotros?</label>
                <input type="checkbox" name="entero[]" value="1" onchange="validarCheckbox()"> Web
                <input type="checkbox" name="entero[]" value="2" onchange="validarCheckbox()"> TV
                <input type="checkbox" name="entero[]" value="3" onchange="validarCheckbox()"> Redes Sociales
                <input type="checkbox" name="entero[]" value="4" onchange="validarCheckbox()"> Amigo
                <span id="enteroError" style="color: red;">Debes seleccionar al menos dos opciones.</span>
            </div>
            <div>
                <button id="submitBtn" type="submit">Votar</button>
            </div>
        </form>
    </div>
    
    <script>
        $(document).ready(function() {
            // Cuando el valor del select de regiones cambia
            $('#region').change(function() {
                var region_id = $(this).val();  // Tomar el valor de la región seleccionada

                // Si se seleccionó una región
                if (region_id) {
                    // Hacer una solicitud AJAX para obtener las comunas de la región seleccionada
                    $.ajax({
                        type: 'POST',
                        url: 'php/get_comunas.php',  // URL del script PHP que devuelve las comunas
                        data: { region_id: region_id },  // Enviar el ID de la región como data
                        success: function(data) {
                            // Actualizar el select de comunas con las comunas devueltas
                            $('#comuna').html(data);
                        }
                    });
                } else {
                    // Si no se selecciona una región, establecer un mensaje por defecto
                    $('#comuna').html('<option value="0">Seleccione primero una región</option>');
                }
            });

            // Cuando se envía el formulario de votación
            $('#votingForm').submit(function(e) {
                e.preventDefault();  // Evitar el envío del formulario de forma predeterminada
                var error = false;  // Flag para determinar si hay un error en el formulario

                // Validaciones de los campos del formulario
                if (!validarNombre($('#nombre')[0])) {
                    alert('El campo "Nombre y Apellido" es obligatorio.');
                    error = true;
                }
                
                if (!validarAlias($('#alias')[0])) {
                    alert('"Alias" debe contener al menos 5 caracteres y debe incluir tanto letras como números.');
                    error = true;
                }

                if (!validarRUT($('#rut')[0])) {
                    alert('RUT inválido.');
                    error = true;
                }

                if (!validarEmail($('#email')[0])) {
                    alert('Email inválido.');
                    error = true;
                }

                if (!validarCheckbox()) {
                    alert('Selecciona al menos dos opciones en "¿Cómo se enteró de nosotros?".');
                    error = true;
                }

                if ($('#region').val() == '0') {
                    alert('Debes seleccionar una región.');
                    error = true;
                }

                if ($('#comuna').val() == '0') {
                    alert('Debes seleccionar una comuna.');
                    error = true;
                }

                if ($('#candidato').val() == '0') {
                    alert('Debes seleccionar un candidato.');
                    error = true;
                }

                // Si no hay errores en las validaciones anteriores
                if (!error) {
                    // Enviar el formulario usando AJAX
                    $.ajax({
                        type: 'POST',
                        url: 'php/save_vote.php',  // URL del script PHP que guarda el voto
                        data: $(this).serialize(),  // Serializar los datos del formulario para enviar
                        success: function(response) {
                            // Manejar respuesta exitosa (por ejemplo, mostrar un mensaje)
                            alert('Voto guardado exitosamente!');
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            // Manejar errores en la solicitud AJAX
                            alert('Hubo un error al guardar el voto: ' + textStatus);
                        }
                    });
                }
            });
        });
    </script>

    <script src="js/main.js"></script>
</body>

</html>
