<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>



<figure class="highcharts-figure">
    <h2 class="h3 mb-4" style="font-family: 'Charm'">Partikulat</h2>
    <p class="highcharts-description">
    Aerosol merupakan partikel berupa cairan dan -umumnya- padatan yang melayang di atmosfer. Sumbernya dapat berasal dari 
    alam maupun antropogenik. Aerosol padat dengan ukuran jari-jari lebih kecil dari 2.5 μm disebut PM2.5 (Particulate Matter 2.5μm) 
    atau debu halus dan jika berukuran lebih kecil dari 10 μm disebut PM10 (Particulate Matter 10μm) atau debu. Aerosol PM10 merupakan
    salah satu dari lima parameter kualitas udara, bersama dengan karbon monoksida, oksida nitrogen, oksida sulfur, dan ozon permukaan.
    Pada peristiwa kebakaran hutan, aerosol PM10 bersama dengan ozon permukaan menimbulkan suatu fenomena yang disebut asap kabut (smog).
    </p>

    <p>
    Data pemantauan partikulat dilaporkan secara berkala ke Pusat Data Aerosol Dunia atau World Data Centre for Aerosols (WDCA)
    disponsori oleh Organisasi Meteorologi Dunia atau World Meteorological Organization (WMO).
    </p>
    <div id="container">



        <script>
        // Ambil data dari file PHP menggunakan AJAX
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
            var dataArray = JSON.parse(this.responseText);
            console.log(this.responseText);
            // Inisialisasi array untuk label sumbu x dan nilai y
            var xAxisCategories = [];
            var yAxisValues = [];

            // Iterasi melalui data array untuk mengisi array label sumbu x dan nilai y
            for (var i = 0; i < dataArray.length; i++) {
                    var datetime = dataArray[i][0];
                    var value = dataArray[i][1];

                    // Pisahkan tanggal dan waktu
                    var parts = datetime.split(' ');
                    var datePart = parts[0];
                    var timePart = parts[1];

                    // Tambahkan label sumbu x dan nilai y
                    xAxisCategories.push(timePart);
                    yAxisValues.push(value);
                }

            if (dataArray.length >= 24) {
                data = dataArray.slice(0, 24); // Mengambil hanya 24 data pertama
                } else {
                console.log('Peringatan: Jumlah data kurang dari 24');
                }

            Highcharts.chart('container', {
                chart: {
                    type: 'spline',
                    scrollablePlotArea: {
                        minWidth: 1200,
                        scrollPositionX: 1
                    }
                },
                title: {
                    text: 'Konsentrasi PM2.5',
                    align: 'center'
                },
                subtitle: {
                    text: 'Stasiun Pemantau Atmosfer Global Lore Lindu Bariri',
                    align: 'center'
                },
                xAxis: {
                    type: 'datetime',
                    //categories: xAxisCategories,
                    labels: {   
                    overflow: 'justify',
                    formatter: function() {
                        return Highcharts.dateFormat('%H:%M', this.value);
                        }
                    }
                },
                yAxis: {
                    title: {
                        text: 'Konsentrasi (ug/m3(m/s)'
                    },
                    min : 0,
                    max : 300,
                    minorGridLineWidth: 0,
                    gridLineWidth: 0,
                    alternateGridColor: null,
                    plotBands: [{ // Baik
                        from: 0,
                        to: 15.5,
                        color: 'rgba(0, 204, 0, 1)',
                        label: {
                            text: 'Baik',
                            style: {
                                color: '#606060'
                            }
                        }
                    }, { // Sedang
                        from: 15.6,
                        to: 55.4,
                        color: 'rgba(18, 13, 238, 1)',
                        label: {
                            text: 'Sedang',
                            style: {
                                color: '#606060'
                            }
                        }
                    }, { // tidak sehat
                        from: 55.5,
                        to: 150.4,
                        color: 'rgba(255, 201, 0, 1)',
                        label: {
                            text: 'Tidak Sehat',
                            style: {
                                color: '#606060'
                            }
                        }
                    }, { // Sangat Tidak Sehat
                        from: 150.5,
                        to: 250.4,
                        color: 'rgba(255, 46, 5, 1)',
                        label: {
                            text: 'Sangat Tidak Sehat',
                            style: {
                                color: '#606060'
                            }
                        }
                    }, { // Berbahaya
                        from: 251,
                        to: 300,
                        color: 'rgba(0,0,0,1)',
                        label: {
                            text: 'Berbahaya',
                            style: {
                                color: '#606060'
                            }
                        }
                    }]
                },
                tooltip: {
                    valueSuffix: ' ug/m3',
                    //crosshairs: true,         -> untuk membuat garis lurus ke atas
                    //shared: true              -> untuk menampika 2 nilai sekaligus
                },
                plotOptions: {
                    spline: {
                        lineWidth: 2,
                        states: {
                            hover: {
                                lineWidth: 3
                            }
                        },
                        marker: {
                            enabled: true  // --> untuk menampilkan marker berupa diamond atau square
                        },
                        pointInterval: 3600000, // one hour
                        pointStart: Date.UTC(2020, 3, 15, 0, 0, 0)
                    }
                },
                            
                series: [{
                    name: 'sekarang',
                    color: '#FFFFFF',
                    data:  yAxisValues
                }],
                navigation: {
                    menuItemStyle: {
                        fontSize: '10px'
                    }
                }
            });
            };
        }   
        xhr.open('GET', 'data.php', true);
        xhr.send();
        </script>
    </div>
   
</figure>
