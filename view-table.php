<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SprinklerIOT</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css">
    <link rel="stylesheet" href="/style.css">
    <script src="/src/jquery-3.6.0.min.js"></script>
    <script src="/src/icon.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
</head>

<body>
    <div id="main">
        <!-- Header section -->
        <div id="header-section">
            <!-- <img src="" alt="" class="logo"> -->

            <div class="nav-toggle">
                <i class="fal fa-bars"></i>
            </div>

            <div class="user">
                <i class="user-icon fal fa-user-circle"></i>
                <li class="drop-icon"><i class="drop-icon fas fa-caret-down"></i></li>
                <ul class="user-setting">
                    <?php
                    if (isset($_SESSION['user']))
                        echo "<h5>Signed in as </br>" . strval($_SESSION['user']) . "</h5>";
                    ?>
                    <li><i class="fas fa-user-alt"></i><a href="/edit-profile.php" class="setting">Your Profile</a></li>
                    <li><i class="fas fa-sign-out-alt"></i><a href="/login.php">Sign out</a></li>
                </ul>
            </div>
        </div>

        <div id="content">
            <!-- Navigation section -->
            <div id="nav-section">
                <i class="nav-icon fas fa-raindrops"></i>
                <ul class="nav">
                    <li><a href="/index.php" class="home-page"><i class="btn fas fa-home"></i>Home</a></li>
                    <li><a href="/setinfo.php" class="set-info-page"><i class="btn fas fa-sliders-h"></i>Parameter</a></li>
                    <li><a href="/settime.php" class="set-time-page"><i class="btn far fa-clock"></i>Time</a></li>
                    <li><a href="/view-table.php" class="view-table-page"><i class="btn fas fa-table"></i>Tables</a></li>
                    <li><a href="/view-chart.php" class="view-chart-page"><i class="btn far fa-chart-bar"></i>Charts</a></li>
                </ul>
            </div>

            <!-- Content section -->
            <div id="table-section">
                <!-- Tables section -->
                <div class="tables-container">
                    <table id="temp_humid_data" class="display row-border hover stripe order-column dt-center">
                        <thead>
                            <tr>
                                <td>Average Temperature</td>
                                <td>Average Humidity</td>
                                <td>Date</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </div>


    <!-- Js for table view -->
    <script>
        var datatable;
        $(document).ready(function() {
            datatable = $('#temp_humid_data').DataTable({
                "responsive": true,
                "processing": true,
                "sAjaxSource": "export-table.php",
                "dom": 'lBfrtip',
                "buttons": [{
                        extend: 'collection',
                        text: 'Export',
                        buttons: [{
                                extend: 'excel',
                                exportOptions: {
                                    columns: [':visible :not(:last-child)'],
                                    rows: ':not(.hide)'
                                }
                            },
                            {
                                extend: 'csv',
                                exportOptions: {
                                    columns: [':visible :not(:last-child)'],
                                    rows: ':not(.hide)'
                                }
                            },
                            {
                                extend: 'print',
                                exportOptions: {
                                    columns: [':visible :not(:last-child)'],
                                    rows: ':not(.hide)'
                                }
                            },
                        ],
                    },
                    {
                        extend: 'colvis',
                        text: 'Visibility'
                    }
                ],
                'columnDefs': [{
                    'targets': [3],
                    'orderable': false,
                    'className': 'dt-center'
                }],
                "lengthMenu": [
                    [6, 7, 8],
                    [6, 7, 8]
                ],
                rowCallback: function(row, data, index) {
                    // console.log(row)
                    if (row.classList.contains('hide'))
                        $(row).hide()
                },
            });
        });

        $('#temp_humid_data').on('click', 'td button', function(e) {
            var target = e.target;
            var id = e.target.id;
            target.parentNode.parentNode.classList.add('hide')
            // console.log(target.parentNode.parentNode)
            // target.parentNode.classList.remove('hide')
            datatable.draw();
        });
    </script>

    <script src="/src/control.js"></script>

</body>

</html>