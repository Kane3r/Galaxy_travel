<?php
session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.html");
    exit;
}

$csv = fopen("misiones_interplanetarias.csv", "r");
$headers = fgetcsv($csv);
$data = [];

while (($row = fgetcsv($csv)) !== false) {
    $data[] = array_combine($headers, $row);
}
fclose($csv);

$years = [];
foreach ($data as $entry) {
    $year = (int)$entry["Año"];
    $exito = $entry["Exito"];

    if (!isset($years[$year])) {
        $years[$year] = ["misiones" => 0, "exitosas" => 0, "evaluadas" => 0];
    }

    $years[$year]["misiones"]++;

    if ($exito === "Si" || $exito === "No") {
        $years[$year]["evaluadas"]++;
        if ($exito === "Si") {
            $years[$year]["exitosas"]++;
        }
    }
}

$X = [];
$Y_misiones = [];
$Y_exito = [];

foreach ($years as $year => $stats) {
    $X[] = $year;
    $Y_misiones[] = $stats["misiones"];
    $Y_exito[] = $stats["evaluadas"] > 0 ? $stats["exitosas"] / $stats["evaluadas"] : null;
}

$X_exito = [];
$Y_exito_clean = [];
foreach ($Y_exito as $i => $val) {
    if (!is_null($val)) {
        $X_exito[] = $X[$i];
        $Y_exito_clean[] = $val;
    }
}

function linearRegression($x, $y) {
    $n = count($x);
    $sum_x = array_sum($x);
    $sum_y = array_sum($y);
    $sum_xy = 0;
    $sum_x2 = 0;

    for ($i = 0; $i < $n; $i++) {
        $sum_xy += $x[$i] * $y[$i];
        $sum_x2 += $x[$i] * $x[$i];
    }

    $slope = ($n * $sum_xy - $sum_x * $sum_y) / ($n * $sum_x2 - $sum_x ** 2);
    $intercept = ($sum_y - $slope * $sum_x) / $n;

    return [$slope, $intercept];
}

list($m1, $b1) = linearRegression($X, $Y_misiones);
list($m2, $b2) = linearRegression($X_exito, $Y_exito_clean);

$predicted_missions_2026 = $m1 * 2026 + $b1;
$predicted_success_2026 = $m2 * 2026 + $b2;
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Predicción de Misiones 2026</title>
  <link rel="stylesheet" href="styles/style_misiones.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="cerrar-sesion-container">
  <form method="get">
    <button type="submit" name="logout" class="button cerrar-sesion">Cerrar sesión</button>
  </form>
</div>

<form class="formulario-misiones">
  <h2>Predicciones para el año 2026</h2>
  <p><strong>Misiones estimadas:</strong> <?= round($predicted_missions_2026, 2) ?></p>
  <p><strong>Probabilidad de éxito estimada:</strong> <?= round($predicted_success_2026 * 100, 2) ?>%</p>

  <canvas id="chart" width="800" height="400" style="margin-top: 30px;"></canvas>
</form>

<!-- Botón Ver/Ocultar tabla -->
<button class="button" onclick="toggleTable(this)">Ver misiones</button>

<!-- Tabla -->
<table id="missionsTable">
  <thead>
    <tr>
      <?php foreach ($headers as $h): ?>
        <th><?= htmlspecialchars($h) ?></th>
      <?php endforeach; ?>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $row): ?>
      <tr>
        <?php foreach ($row as $cell): ?>
          <td><?= htmlspecialchars($cell) ?></td>
        <?php endforeach; ?>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<script>
  function toggleTable(button) {
    const table = document.getElementById("missionsTable");
    const isHidden = table.style.display === "none" || table.style.display === "";
    table.style.display = isHidden ? "table" : "none";
    button.textContent = isHidden ? "Ocultar misiones" : "Ver misiones";
  }

  const ctx = document.getElementById('chart').getContext('2d');
  const data = {
    labels: <?= json_encode($X) ?>,
    datasets: [
      {
        label: 'Misiones por año',
        data: <?= json_encode($Y_misiones) ?>,
        borderColor: 'blue',
        fill: false,
        tension: 0.1
      },
      {
        label: 'Tasa de éxito (%)',
        data: <?= json_encode(array_map(fn($v) => is_null($v) ? null : round($v * 100, 2), $Y_exito)) ?>,
        borderColor: 'green',
        fill: false,
        tension: 0.1,
        yAxisID: 'y1'
      }
    ]
  };

  const config = {
    type: 'line',
    data: data,
    options: {
      responsive: true,
      interaction: {
        mode: 'index',
        intersect: false,
      },
      stacked: false,
      scales: {
        y: {
          type: 'linear',
          position: 'left',
          title: { display: true, text: 'Misiones' }
        },
        y1: {
          type: 'linear',
          position: 'right',
          title: { display: true, text: 'Tasa de éxito (%)' },
          grid: { drawOnChartArea: false }
        }
      }
    }
  };

  new Chart(ctx, config);
</script>

</body>
</html>
