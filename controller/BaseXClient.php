<?php
class BaseXClient {
    private $socket;
    private $delimiter = "\0";

    public function __construct($host, $port, $user, $password) {
        $this->socket = fsockopen($host, $port, $errno, $errstr, 10);
        if (!$this->socket) {
            throw new Exception("No se pudo conectar a BaseX: $errstr ($errno)");
        }

        // Autenticación (usuario y contraseña)
        fwrite($this->socket, $user . $this->delimiter . $password . $this->delimiter);
        $response = fread($this->socket, 1);
        if ($response !== chr(0)) {
            throw new Exception("Error de autenticación en BaseX.");
        }
    }

    public function execute($command) {
        fwrite($this->socket, $command . $this->delimiter);
        $response = $this->readResponse();
        return $response;
    }

    public function query($xquery) {
        return $this->execute("XQUERY " . $xquery);
    }

    private function readResponse() {
        $response = '';
        while (($char = fread($this->socket, 1)) !== $this->delimiter) {
            $response .= $char;
        }
        return $response;
    }

    public function close() {
        fwrite($this->socket, "exit" . $this->delimiter);
        fclose($this->socket);
    }
}
?>
Este código crea una clase BaseXClient que: ✅ Se conecta a BaseX mediante sockets
✅ Ejecuta comandos y consultas XQuery
✅ Maneja la autenticación

🚀 2. Probar la conexión con BaseX
Crea un archivo test.php en el mismo directorio y copia este código para probar la conexión:

php
Copiar
Editar
<?php
require_once("BaseXClient.php");

try {
    // Conectar a BaseX
    $basex = new BaseXClient("localhost", 1984, "admin", "admin");

    // Ejecutar una consulta XQuery
    $query = "for $a in //alumno/nombre return $a";
    $resultado = $basex->query($query);

    echo "Resultados de la consulta:<br>";
    echo nl2br(htmlspecialchars($resultado));

    // Cerrar conexión
    $basex->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>