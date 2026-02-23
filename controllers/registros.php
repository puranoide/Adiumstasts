<?php 
function createRegister($conexion, $data)
{
    // ─── Mapa: clave que llega del frontend => columna real en BD ───
    $campoMap = [
        // typos del frontend que difieren de la BD
        'mesh_lkads'    => 'mseh_lkads',
        'mseh_web_vtv'  => 'mseh_web_vte',
        // campos que NO existen en la BD y deben ignorarse
        // (agrega aquí cualquier otro que sobre)
    ];

    // Campos que la BD tiene pero el frontend NO debe insertar
    $ignorar = ['id', 'estado'];

    // ─── Normalizar el array $data ───
    $dataNorm = [];
    foreach ($data as $key => $value) {
        if (in_array($key, $ignorar)) continue;          // saltar campos auto/fijos
        $col = $campoMap[$key] ?? $key;                  // corregir typos
        $dataNorm[$col] = $value;
    }

    // ─── Fecha calculada ───
    $dataNorm['fechacreada'] = date('Y') . '-' . str_pad($dataNorm['id_mes'] ?? date('m'), 2, '0', STR_PAD_LEFT) . '-01';

    // ─── Construir SQL ───
    $columns      = implode(", ", array_keys($dataNorm));
    $placeholders = implode(", ", array_fill(0, count($dataNorm), "?"));
    $sql = "INSERT INTO registros_adium ($columns) VALUES ($placeholders)";

    // ─── Preparar ───
    $stmt = $conexion->prepare($sql);

    if (!$stmt) {
        return ['error' => 'Prepare falló: ' . $conexion->error . ' | SQL: ' . $sql];
    }

    // ─── Bind & Execute ───
    $values = array_values($dataNorm);
    $stmt->bind_param(str_repeat("s", count($values)), ...$values);

    if (!$stmt->execute()) {
        return ['error' => 'Execute falló: ' . $stmt->error];
    }

    return ['success' => true, 'id' => $conexion->insert_id];
}


function listRegisters($conexion)
{
    $query = "SELECT * FROM registros_adium order by fechaCreada ASC";
    $result = mysqli_query($conexion, $query);
    if (mysqli_num_rows($result) > 0) {
        $registros = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $registros[] = $row;
        }
        return $registros;
    } else {
        return [];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Set response header as JSON
    header('Content-Type: application/json');

    // Decode received JSON
    $data = json_decode(file_get_contents("php://input"), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['error' => 'Invalid JSON']);
        exit;
    }

    // Validate received data    

    include_once('db.php');
    switch ($data['action']) {
        case 'insert':
            if (!$conexion) {
                echo json_encode(['error' => 'No se pudo conectar a la base de datos']);
                exit;
            }

            // Resto del código...
            try {
                $response = createRegister($conexion, $data['data']);
                if ($response) {
                    echo json_encode(['success' => true, 'message' => 'insert exitoso']);
                } else {
                    echo json_encode(['error' => 'insert fallido']);
                }
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
            break;
        case 'list':
            if (!$conexion) {
                echo json_encode(['error' => 'No se pudo conectar a la base de datos']);
                exit;
            }
            $response = listRegisters($conexion);
            if ($response) {
                echo json_encode(['success' => true, 'data' => $response]);
            } else {
                echo json_encode(['error' => 'list fallido']);
            }
            break;
        default:
            echo json_encode(['success' => false]);
            break;
    }
}


?>