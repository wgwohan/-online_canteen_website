<?php require_once('../inc/seller/connection.php'); ?>
<?php

//upload.php

if(isset($_POST['image']))
{
    $data = $_POST['image'];
    $image_array_1 = explode(";", $data);
    $image_array_2 = explode(",", $image_array_1[1]);
    $data = base64_decode($image_array_2[1]);
    $image_name = 'image/product/' . time() . '.png';

    file_put_contents($image_name, $data);

    echo $image_name;
    $_SESSION['img_dir'] = $image_name;

    $query = "UPDATE products SET img_dir = '$image_name' WHERE name = '{$_SESSION['name']}' LIMIT 1";

            $result = mysqli_query($connection, $query);

            if ($result) {
                //query success! redirect to home page
                echo "Database query success.";
            } else {
                echo "Database query failed.";
            }
}
?>
<?php mysqli_close($connection); ?>