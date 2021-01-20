<?php
session_start();
include_once("pages/functions.php");
if (!$_GET["page"] && !$_GET["hotel"]) $_GET["page"] = 1;
if (isset($_POST["logoutBtn"])) {
    unset($_SESSION["userLogin"]);
    unset($_SESSION["admin"]);
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@600&display=swap" rel="stylesheet">
    <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>

<body id="body" style="background-image: url(files/background.jpg); background-attachment: fixed;" class="divImage">
    <div class="wrapper">
        <header class="row bg-gradient-primary m-0">
            <nav class="navbar navbar-expand-lg navbar-dark col">
                <div class="container">
                    <a class="navbar-brand logoGradient ml-4" href="index.php?page=1">
                        Tour of dream
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <?php
                            include_once("pages/menu.php");
                            ?>
                        </ul>
                    </div>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <?php
                        include_once("pages/menu.php");
                        if (!checkAuthorization()) {
                        ?>
                        <div class="d-flex ml-auto">
                            <a href="index.php?page=3" class="signLink mr-3">Sign
                                in</a>
                            <a href="index.php?page=3" class="signLink">Sign
                                up</a>
                        </div>
                        <?php
                        } else {
                        ?>
                        <form action="index.php?page=1" method="POST" class="d-flex ml-auto">
                            <input type="button" class="btn loginName" value=<?php echo $_SESSION["userLogin"]; ?>>
                            <input type="submit" name="logoutBtn" class="logoutBtn" value="Logout">
                        </form>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </nav>
        </header>
        <main class="divBack position-relative">
            <div class="p-0 d-flex flex-column justify-content-between contentOverflow">
                <?php
                if (isset($_GET["page"])) {
                    $page = $_GET["page"];
                    if ($page == 1)
                        include_once("pages/tours.php");
                    if ($page == 2)
                        include_once("pages/comments.php");
                    if ($page == 3)
                        include_once("pages/registration.php");
                    if ($page == 4)
                        include_once("pages/admin.php");
                    if ($page == 5)
                        include_once("pages/private.php");
                } else if (isset($_GET["hotel"])) {
                    $hotelId = $_GET["hotel"];
                    include_once("pages/hotelInfo.php");
                }
                ?>
            </div>
        </main>
        <footer class="divBack">
            <div class="container-fluid text-center title">
                MarkosBK Corporation &copy;
            </div>
        </footer>


    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>