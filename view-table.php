<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SprinklerIOT</title>
    <!-- <link rel="stylesheet" href="/assets/fontawesome-free-5.15.3-web/fontawesome-free-5.15.3-web/css/all.css"> -->
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
            <img src="" alt="" class="logo">

            <div class="user">
                <i class="user-icon fal fa-user-circle"></i>
                <li class="drop-icon"><i class="drop-icon fas fa-caret-down"></i></li>
                <ul class="user-setting">
                    <h5>Signed in as </br> <?php echo $_SESSION['user'] ?></h5>
                    <li><i class="fas fa-user-alt"></i><a href="" class="setting">Your Profile</a></li>
                    <li><i class="fas fa-sign-out-alt"></i><a href="/login.php">Sign out</a></li>
                </ul>
            </div>
        </div>

        <div id="content">
            <!-- Navigation section -->
            <div id="nav-section">
                <i class="nav-icon far fa-raindrops"></i>
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
                    <table id="temp_humid_data" class="display row-border hover stripe order-column">
                        <thead>
                            <tr>
                                <td>Average Temperature</td>
                                <td>Average Humidity</td>
                                <td>Date</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </div>


    <!-- Js for table view -->
    <script>
        $(document).ready(function() {
            $('#temp_humid_data').DataTable({
                "responsive": false,
                "processing": true,
                "sAjaxSource": "export-table.php",
                "dom": 'lBfrtip',
                "buttons": [{
                    extend: 'collection',
                    text: 'Export',
                    buttons: [
                        'excel',
                        'csv',
                        'print'
                    ]
                }],
                "lengthMenu": [
                    [10, 12, 14],
                    [10, 12, 14]
                ]
            });
        });

    </script>

    <script src="/src/control.js"></script>

</body>

</html>