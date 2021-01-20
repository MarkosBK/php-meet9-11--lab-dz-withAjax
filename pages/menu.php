<?php $page = $_GET["page"] ?>
<ul class="navbar-nav mr-auto">
    <li class="<?php echo ($page == 1) ? "nav-item nav-item-active" : "nav-item" ?>">
        <a class="nav-link" href="index.php?page=1">Tours</a>
    </li>
    <li class="<?php echo ($page == 2) ? "nav-item nav-item-active" : "nav-item" ?>">
        <a class="nav-link" href="index.php?page=2">Comments</a>
    </li>
    <li class="<?php echo ($page == 4) ? "nav-item nav-item-active" : "nav-item" ?>">
        <a class="nav-link" href="index.php?page=4">Admin&nbsp;panel</a>
    </li>
    <?php
    if (isset($_SESSION["admin"])) {
    ?>
    <li class="<?php echo ($page == 5) ? "nav-item nav-item-active" : "nav-item" ?>">
        <a class="nav-link" href="index.php?page=5">Private</a>
    </li>
    <?php
    }
    ?>
</ul>