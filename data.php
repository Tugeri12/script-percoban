<?php
// Buat koneksi ke database MySQL
$koneksi = mysqli_connect("localhost", "root", "", "pm2.5_bariri_202309");
if (mysqli_connect_error()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

// Buat query SQL untuk mengambil data dari database
//$query = "SELECT time, conc FROM `pm2.5` ORDER BY time DESC";
//$query = "SELECT time, conc FROM `pm2.5` ORDER BY time ASC, HOUR(time) ASC, MINUTE(time) ASC";
//$query = "SELECT time, conc FROM `pm2.5` ORDER BY DATE(time) ASC, TIME(time) ASC";
$query = "SELECT time, conc FROM `pm2.5_bariri_202309_revisi` ORDER BY time ASC";



$result = mysqli_query($koneksi, $query);

// Ambil data dari hasil query dan simpan dalam format yang cocok untuk digunakan oleh Highcharts
$data = array();
while ($row = mysqli_fetch_array($result)) {
    $waktu = $row['time'];
    $conc = (float) $row['conc'];

    $conc = ($conc > 300) ? 0 : $conc;

    // Ubah format waktu jika diperlukan
    if (strpos($waktu, '/') !== false) {
        $waktu = str_replace('/', '-', $waktu);
    }
    //$waktu .= "<br>";
    $data[] = array($waktu, $conc);
    
}

mysqli_close($koneksi);

// Mengembalikan data dalam format JSON
echo json_encode($data);
//echo json_encode($groupedData);
$dataJson  = json_encode($data);
?>