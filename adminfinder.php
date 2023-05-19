<html lang="en">

<head>
    <meta charset="utf-8">
    <title> AYGUNN PANEL </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&amp;family=Roboto:wght@500;700&amp;display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <?php include 'sidebar.php' ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include 'navbar.php' ?>
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->

            <!-- Sale & Revenue End -->


            <!-- Sales Chart Start -->

            <!-- Sales Chart End -->
            <style>
                p {
                    float: left;
                    font-weight: bold;
                }

                h5 {
                    color: red;
                    float: left;


                }
            </style>
            <!-- DUYURU DIV-->

            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h5 class="mb-0">Duyuru Başlık</h5>
                    </div>
                    <form method="POST" action="">
                        <div class="form-group">
                            <input type="text" name="site" class="form-control" placeholder="Site Adresi" required>
                        </div>
                        <br>
                        <button type="submit" name="submit" class="btn btn-primary" onclick="runAdminFinder()">Butona
                            Bas</button>
                    </form>
                    <br>
                    <?php
                    if (isset($_POST['submit'])) {
                        $site = $_POST['site'];
                        $output = shell_exec("node adminfinder.js $site");
                        $output = trim($output);
                        $outputLines = explode("\n", $output);

                        if (!empty($outputLines)) {
                            echo '<table class="table">';
                            echo '<thead class="thead-light">';
                            echo '<tr><th scope="col">Sonuçlar</th></tr>';
                            echo '</thead>';
                            echo '<tbody>';

                            foreach ($outputLines as $line) {
                                if (strpos($line, '[+]') !== false) {
                                    echo '<tr><td><font color="green">' . htmlentities($line) . '</font></td></tr>';
                                }
                            }

                            echo '</tbody>';
                            echo '<tbody>';

                            foreach ($outputLines as $line) {
                                if (strpos($line, '[-]') !== false) {
                                    echo '<tr><td><font color="red">' . htmlentities($line) . '</font></td></tr>';
                                }
                            }

                            echo '</tbody>';
                            echo '</table>';
                        } else {
                            echo '<p>Hiçbir Sonuç Bulunamadı!</p>';
                        }
                    }
                    ?>
                </div>
            </div>
            <table>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </table>

            <!-- DUYURU DIV END -->

            <script>
                function runAdminFinder() {
                    const siteInput = document.querySelector('input[name="site"]');
                    const site = siteInput.value.trim();

                    if (site !== '') {
                        const outputElement = document.getElementById('output');
                        outputElement.innerHTML = 'Admin paneli aranıyor...';

                        const formData = new FormData();
                        formData.append('site', site);

                        fetch('adminfinder.php', {
                            method: 'POST',
                            body: formData
                        })
                            .then(response => response.text())
                            .then(data => {
                                outputElement.innerHTML = data;
                            })
                            .catch(error => {
                                outputElement.innerHTML = 'Bir hata oluştu. Lütfen tekrar deneyin.';
                                console.error(error);
                            });
                    }
                }
            </script>




        <?php include 'footer.php'?>
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top" style="display: none;"><i
                class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>


</body>

</html>