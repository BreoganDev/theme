<?php
ini_set('display_errors', 1);
ini_set('memory_limit', '2048M');

echo "Límite de memoria actual: " . ini_get('memory_limit') . "<br>";

echo "Estado de carga:<br>";
$loaded = get_included_files();
echo "Archivos cargados: " . count($loaded) . "<br>";

echo "Usando memoria: " . round(memory_get_usage() / 1024 / 1024, 2) . " MB<br>";
echo "Pico de memoria: " . round(memory_get_peak_usage() / 1024 / 1024, 2) . " MB<br>";

echo "<h3>Comprobando opciones grandes en la base de datos:</h3>";
require_once('wp-load.php');
global $wpdb;

$big_options = $wpdb->get_results("SELECT option_name, LENGTH(option_value) as size FROM {$wpdb->options} WHERE LENGTH(option_value) > 1000000 ORDER BY size DESC LIMIT 10");

if ($big_options) {
    echo "<table border='1'><tr><th>Opción</th><th>Tamaño (MB)</th></tr>";
    foreach ($big_options as $option) {
        echo "<tr><td>{$option->option_name}</td><td>" . round($option->size / 1024 / 1024, 2) . " MB</td></tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron opciones grandes.";
}