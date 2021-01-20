<div class="mx-auto">
    <?php
    if (isset($_POST["regBtn"])) {
        if (register($_POST["loginReg"], $_POST["passReg"], $_POST["emailReg"])) {
            $users = getUsers();
            echo "<h3 align='center' style='color: green'>Пользователь " . $_POST["login"] . " добавлен!</h3>";
            unset($_POST);
        }
    } else if (isset($_POST["logBtn"])) {
        if (authorization($_POST["loginLog"], $_POST["passLog"])) {
            unset($_POST);
            echo "<script>";
            echo "window.location = 'index.php?page=1'";
            echo "</script>";
        }
    } else {
    ?>
    <div class="row px-3">
        <form action="index.php?page=3" method="POST" class="form-reg mt-5 col-lg-6 mx-auto">
            <h2 align='center'>Registration</h2>
            <div class="form-group">
                <label for="loginReg">Login</label>
                <div id="loginError" style="color: red; font-weight: normal; font-size: 14px"></div>
                <input type="text" id="loginReg" name="loginReg" class="form-control" placeholder="Enter login"
                    oninput="validationLogin(this.value)">
            </div>
            <div class="form-group">
                <label for="passReg">Password</label>
                <input type="password" name="passReg" class="form-control" placeholder="Enter password">
            </div>
            <div class="form-group">
                <label for="passConfReg">Confirm password</label>
                <input type="password" name="passConfReg" class="form-control" placeholder="Enter password again">
            </div>
            <div class="form-group">
                <label for="emailReg">Email</label>
                <input type="email" name="emailReg" class="form-control" placeholder="Enter your email">
            </div>
            <input type="submit" class="btn container-fluid" name="regBtn" value="Register">
        </form>

        <form action="index.php?page=3" method="POST" class="form-reg mt-5 col-lg-6 mx-auto">
            <h2 align='center'>Authorization</h2>
            <div class="form-group">
                <label for="loginLog">Login</label>
                <input type="text" name="loginLog" class="form-control" placeholder="Enter login">
            </div>
            <div class="form-group">
                <label for="passLog">Password</label>
                <input type="password" name="passLog" class="form-control" placeholder="Enter password">
            </div>
            <input type="submit" class="btn container-fluid" name="logBtn" value="Login">
        </form>
    </div>
    <?php } ?>
</div>