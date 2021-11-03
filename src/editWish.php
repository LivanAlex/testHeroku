<?php
    session_start();
    if (!array_key_exists("user", $_SESSION)) {
        header('Location: index.php');
        exit;
    }

    require_once("Includes/db.php");
    $wisherID = WishDB::getInstance()->get_wisher_id_by_name($_SESSION['user']);

    $wishDescriptionIsEmpty = false;
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        if (array_key_exists("back", $_POST)) {
            header('Location: editWishList.php' );
            exit;
        } else if ($_POST['wish'] == "") {
                $wishDescriptionIsEmpty =  true;
        } else if ($_POST["wishID"]=="") {
            WishDB::getInstance()->insert_wish($wisherID, $_POST["wish"], $_POST["dueDate"]);
            header('Location: editWishList.php' );
            exit;
        } else if ($_POST["wishID"]!="") {
            WishDB::getInstance()->update_wish($_POST["wishID"], $_POST["wish"], $_POST["dueDate"]);
            header('Location: editWishList.php' );
            exit;
        }
    }

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST")
        $wish = array("id" => $_POST["wishID"], "description" =>
            $_POST["wish"], "due_date" => $_POST["dueDate"]);
    else if (array_key_exists("wishID", $_GET))
        $wish = mysqli_fetch_array(WishDB::getInstance()->get_wish_by_wish_id($_GET["wishID"]));
    else
        $wish = array("id" => "", "description" => "", "due_date" => "");
    ?>
        <form name="editWish" action="editWish.php" method="POST">
<!--            Describe your wish:-->
<!--            <input type="text" name="wish"  value="" /><br/>-->
<!--            When do you want to get it?-->
<!--            <input type="text" name="dueDate" value=""/><br/>-->
            Describe your wish:
            <input type="text" name="wish"  value="<?php echo $wish['description'];?>" /><br/>
            <?php
            if ($wishDescriptionIsEmpty)
                echo "Please enter description<br/>";
            ?>
            When do you want to get it?
            <input type="text" name="dueDate" value="<?php echo $wish['due_date']; ?>"/><br/>
            <input type="hidden" name="wishID" value="<?php echo  $wish["id"];?>" />
            <input type="submit" name="saveWish" value="Save Changes"/>
            <input type="submit" name="back" value="Back to the List"/>
        </form>
    </body>
</html>