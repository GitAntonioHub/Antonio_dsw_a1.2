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

        <input type="submit" value="Enviar Duda">
    </form>
</body>
</html>
