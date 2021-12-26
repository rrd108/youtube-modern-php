<?php

require './vendor/autoload.php';

$rates = [];

if (($handle = fopen('./data.csv', 'r')) !== false) {
    while (($data = fgetcsv($handle, 1000, ',')) !== false) {
        $rates[] = ['y' => $data[1], 'label' => $data[0]];
    }
    fclose($handle);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ETH/HUF rates</title>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js" defer></script>
    <script>
        window.onload = function() {
            let chart = new CanvasJS.Chart("chartContainer", {
                title: {
                    text: "ETH/HUF rates"
                },
                axisY: {
                    title: "HUF"
                },
                data: [{
                    type: "line",
                    dataPoints: <?php echo json_encode($rates, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();
        }
    </script>
</head>

<body>
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
</body>

</html>