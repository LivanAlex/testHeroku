<?php
require_once("Includes/db.php");
$logonSuccess = false;

// verify user's credentials
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $logonSuccess = (WishDB::getInstance()->verify_wisher_credentials($_POST['user'], $_POST['userpassword']));
    if ($logonSuccess == true) {
        session_start();
        $_SESSION['user'] = $_POST['user'];
        header('Location: editWishList.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Wishlist</title>
        <link href="wishlist.css" type="text/css" rel="stylesheet" media="all" />
    </head>
    <body>
    <div class="showWishList">
        <input type="submit" name="showWishList" value="Show Wish List of" onclick="javascript:showHideShowWishListForm()"/>

        <form name="wishList" action="wishlist.php" method="GET" style="visibility:hidden">
            <input type="text" name="user"/>
            <input type="submit" value="Go" />
        </form>
    </div>
        <br>Still don't have a wish list?! <a href="createNewWisher.php">Create now</a>


    <div class="logon">
        <input class="CenterButton" type="submit" name="myWishList" value="My Wishlist" onclick="javascript:showHideLogonForm()"/>
        <form name="logon" action="index.php" method="POST"
              style="visibility:<?php if ($logonSuccess) echo "hidden"; else echo "visible";?>">
            Username: <input type="text" name="user"/><br/>
            Password: <input type="password" name="userpassword"/><br/>
            <div class="error">
                <?php
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    if (!$logonSuccess)
                        echo "Invalid name and/or password";
                }
                ?>
            </div>
            <input type="submit" value="Edit My Wish List"/>
        </form>
    </div>
        <script>
            function showHideLogonForm() {
                if (document.all.logon.style.visibility == "visible"){
                    document.all.logon.style.visibility = "hidden";
                    document.all.myWishList.value = "My Wishlist >>";
                }
                else {
                    document.all.logon.style.visibility = "visible";
                    document.all.myWishList.value = "<< My Wishlist";
                }
            }
            function showHideShowWishListForm() {
                if (document.all.wishList.style.visibility == "visible") {
                    document.all.wishList.style.visibility = "hidden";
                    document.all.showWishList.value = "Show Wish List of >>";
                }
                else {
                    document.all.wishList.style.visibility = "visible";
                    document.all.showWishList.value = "<< Show Wish List of";
                }
            }
        </script>
    </body>
</html>