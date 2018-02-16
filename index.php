<?php
include('login.php')
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Beryl's login page</title>
</head>
<body>
    <h1>
        Please Log in first:
    </h1>
    <?php
    // display error message
    if (isset($error)) {
        echo "<p style='color:red;'>$error</p>";
    }
    ?>
    <form action="" method="POST">
        <div>
            <label for="username">
                Username:
            </label>
            <input id="username" name="username" type="text">
        </div>
        <div>
            <label for="password">
                Password:
            </label>
            <input id="password" name="password" type="text">
        </div>
        <div>
            <input type="submit" value="Submit"/>
        </div>
    </form>
</body>
</html>