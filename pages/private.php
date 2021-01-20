<?php
if (!isset($_SESSION["admin"])) {
    echo "<h1 align='center' style='color: orangered; text-shadow: 2px 2px 5px #000; margin-top: 3%'>Only ADMINS</h1>";
} else {
    if (isset($_POST['addAdmin'])) {
        if (moveToAdmins($_POST['userAvatar'], $_FILES)) {
            echo "<script>";
            echo "window.location=document.URL;";
            echo "</script>";
        } else {
            echo "<h3 align='center' style='color: red'>Произошла ошибка!</h3>";
        }
        unset($_POST);
        unset($_FILES);
    } else {
?>

<div class="hotelInfoContent px-0 py-3">
    <div class="childHotelInfoContent" style="overflow: auto;">
        <div class="d-flex flex-column container mx-auto privatePage">
            <form action="index.php?page=5" method="POST" enctype="multipart/form-data" class="form-admins">
                <select class="form-control" name="userAvatar">
                    <?php
                            $users = getUsers();
                            for ($i = 0; $i < count($users); $i++) {
                                if (getRoleById($users[$i]['roleId'])["role"] !== "Admin") {
                                    echo "<option value='" . $users[$i]['id'] . "'>" . $users[$i]["login"] . "</option>";
                                }
                            }
                            ?>
                </select>
                <div class="input__wrapper">
                    <input type="file" id="input__file__avatar" name="avatar" class="input input__file"
                        accept="image/*">
                    <label for="input__file__avatar" class="input__file-button btn m-0">
                        <span class="input__file-button-text">Выберите файлы</span>
                    </label>
                    <input type="submit" id="addAvatar" name="addAdmin" value="Move to admin" class="btn" disabled>
                </div>
            </form>

            <div class="row">
                <?php
                        for ($i = 0; $i < count($users); $i++) {
                            if (getRoleById($users[$i]['roleId'])["role"] === "Admin") {
                                $img = base64_encode($users[$i]['avatar']);
                        ?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mt-5">
                    <div class="card px-0">
                        <div class="card-img-top position-relative" style="height: 150px;">
                            <div class="divBack absoluteFull" style="z-index: 2;"></div>
                            <div class=" divImage absoluteFull"
                                style="background-image: url(data:image/png;base64,<?php echo $img ?>);">
                            </div>
                        </div>

                        <div class="card-body p-2">
                            <h5 class="card-title"><?php echo $users[$i]["login"] ?></h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item p-1">Login: <?php echo $users[$i]["login"] ?></li>
                            <li class="list-group-item p-1">Email: <?php echo $users[$i]["email"] ?></li>
                        </ul>
                    </div>
                </div>

                <?php }
                        } ?>
            </div>
        </div>
    </div>
</div>

<?php }
} ?>>