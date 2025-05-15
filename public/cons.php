<!DOCTYPE html> <html lang="es"> <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta Oracle</title> </head> <body>
    <h1>Ejecutar consulta en Oracle</h1>
    
    <!-- Botón para ejecutar la consulta -->
    <form method="post">
        <button type="submit" name="execute_query">Ejecutar Consulta</button>
    </form>
    <?php
    if (isset($_POST['execute_query'])) {
        // Función que realiza la conexión y consulta a Oracle
        function VerDatosFicha() {
            // Conexión a la base de datos Oracle
            $conn = oci_connect('APPSAVA', 'AppS4v4Hy67uj', '172.24.247.124:1521/SOFIA_dg_ro.bogrodclientpri.bognoprodexa1.oraclevcn.com');
            $arraytodos = array();
            if (!$conn) {
                $e = oci_error();
                echo "<script>console.log('Error en la conexión: ".json_encode($e)."');</script>";
                trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            } else {
                // Consulta SQL
                $sql = "SELECT * FROM dual";
                // Preparar y ejecutar la consulta
                $stid = oci_parse($conn, $sql);
                oci_execute($stid);
                // Recorrer los resultados
                while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                    $arraytodos[] = $row;
                }
                // Cerrar la conexión
                oci_free_statement($stid);
                oci_close($conn);
            }
            
            return $arraytodos;
        }
        // Ejecutar la función y obtener los datos
        $resultado = VerDatosFicha();
        // Enviar los datos a la consola usando JavaScript
        echo "<script>console.log('Resultado: " . json_encode($resultado) . "');</script>";
    }
    ?> </body>
</html>
