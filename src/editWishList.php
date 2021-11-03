<?php
    require_once("Includes/db.php");
    session_start();
    if (array_key_exists("user", $_SESSION)) {
        echo "Hello, " . $_SESSION['user'];
    } else {
        header('Location: index.php');
        exit;
    }
?>


<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Edit</title>
    </head>
    <body>
    <table border="black">
        <tr><th>Item</th><th>Due Date</th></tr>
        <?php
        require_once("Includes/db.php");
        $wisherID = WishDB::getInstance()->get_wisher_id_by_name($_SESSION["user"]);
        $result = WishDB::getInstance()->get_wishes_by_wisher_id($wisherID);
        while($row = mysqli_fetch_array($result)):
            echo "<tr><td>" . htmlentities($row['description']) . "</td>";
            echo "<td>" . htmlentities($row['due_date']) . "</td>";
            $wishID = $row["id"];
            ?>
            <td>
                <form name="editWish" action="editWish.php" method="GET">
                    <input type="hidden" name="wishID" value="<?php echo $wishID; ?>"/>
                    <input type="submit" name="editWish" value="Edit"/>
                </form>
            </td>
            <td>
                <form name="deleteWish" action="deleteWish.php" method="POST">
                    <input type="hidden" name="wishID" value="<?php echo $wishID; ?>"/>
                    <input type="submit" name="deleteWish" value="Delete"/>
                </form>
            </td>
            <?php
            echo "</tr>\n";
        endwhile;
        mysqli_free_result($result);
        ?>
    </table>
        <form name="addNewWish" action="editWish.php">
            <input type="submit" value="Add Wish">
        </form>
        <form name="backToMainPage" action="index.php">
            <input type="submit" value="Back To Main Page"/>
        </form>
    </body>
</html>