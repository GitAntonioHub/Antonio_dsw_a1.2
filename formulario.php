<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Duda</title>
</head>
<body>
    <h1>Enviar Duda a Profesores de 2º DAW</h1>
    <form action="registra_dudas.php" method="POST">
        <label for="correo">Correo:</label><br>
        <input type="email" id="correo" name="correo" required><br><br>

        <label for="modulo">Módulo:</label><br>
        <select id="modulo" name="modulo" required>
            <option value="DSW">Desarrollo de aplicaciones web (DSW)</option>
            <option value="DIW">Diseño de interfaces web (DIW)</option>
            <option value="DWECL">Despliegue de aplicaciones web en entorno cliente (DWECL)</option>
            <option value="DWECL2">Despliegue de aplicaciones web en entorno servidor (DWECL2)</option>
        </select><br><br>

        <label for="asunto">Asunto:</label><br>
        <input type="text" id="asunto" name="asunto" required><br><br>

        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion" rows="5" cols="30" required></textarea><br><br>

        <label for="temas">Temas relacionados (Seleccione máximo 3 temas):</label><br>
        <input type="checkbox" name="temas[]" value="Linux"> Linux<br>
        <input type="checkbox" name="temas[]" value="Windows"> Windows<br>
        <input type="checkbox" name="temas[]" value="PHP"> PHP<br>
        <input type="checkbox" name="temas[]" value="HTML"> HTML<br>
        <input type="checkbox" name="temas[]" value="Javascript"> Javascript<br>
        <input type="checkbox" name="temas[]" value="Bash"> Bash<br>
        <input type="checkbox" name="temas[]" value="Calificaciones"> Calificaciones<br>
        <input type="checkbox" name="temas[]" value="Actividades"> Actividades<br>
        <input type="checkbox" name="temas[]" value="Exámenes"> Exámenes<br>
        <input type="checkbox" name="temas[]" value="Otros"> Otros<br><br>

        <input type="submit" value="Enviar Duda">
    </form>
</body>
</html>
