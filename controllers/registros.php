<?php 
function createRegister($conexion, $data)
{
    $campoMap = []; // Ya no necesitas correcciones, el payload está limpio

    $ignorar = ['id', 'estado']; // id y estado los maneja la BD

    $dataNorm = [];
    foreach ($data as $key => $value) {
        if (in_array($key, $ignorar)) continue;
        $col = $campoMap[$key] ?? $key;
        $dataNorm[$col] = $value;
    }

    // ✅ Corregido: id_mes (no mes_id)
    $dataNorm['fechacreada'] = date('Y') . '-' . 
        str_pad($dataNorm['id_mes'] ?? date('m'), 2, '0', STR_PAD_LEFT) . '-01';

    $columns      = implode(", ", array_keys($dataNorm));
    $placeholders = implode(", ", array_fill(0, count($dataNorm), "?"));
    $sql          = "INSERT INTO registros_adium ($columns) VALUES ($placeholders)";

    // 👇 Temporal: ver el SQL exacto en el log de Apache/XAMPP
    error_log("=== SQL: " . $sql);

    $stmt = $conexion->prepare($sql);

    if (!$stmt) {
        // ✅ Ahora sí retorna el error en vez de explotar
        return ['error' => 'Prepare falló: ' . $conexion->error];
    }

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
    $response = createRegister($conexion, $data['data']);
    if (isset($response['error'])) {
        echo json_encode(['error' => $response['error']]); // ← verás el error exacto
    } else {
        echo json_encode(['success' => true, 'id' => $response['id']]);
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