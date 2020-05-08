<?php
require "header.php";


?>

<main>
    <h1>Reset your password</h1>
    <p>An e-mail will be send to you with instructions on how to reset your password.</p>
    <form action="includes/resetPassword.inc.php" method="POST">
        <input name="email" type="email" placeholder="type your email address">
        <br>
        <br>
        <button type="submit" name="reset-request-submit">Send</button>
    </form>

</main>

<?php

if (isset($_GET["error"])) {
    echo "<br><br>error : " . $_GET["error"];
}
require "footer.php"
?>