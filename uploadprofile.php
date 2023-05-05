<?php require_once('inc/connection.php'); ?>
<?php
if ($_SESSION['email']) {
    $email = $_SESSION['email'];
    // prepare database query
    $query = "SELECT id FROM customers WHERE email = '{$email}' LIMIT 1";
    $result_set = mysqli_query($connection, $query);

    if (mysqli_num_rows($result_set) == 1) {
        // valid user found
        $user = mysqli_fetch_assoc($result_set);
        $id = $user['id'];
//upload.php

if(isset($_POST['image']))
{
    $data = $_POST['image'];
    $image_array_1 = explode(";", $data);
    $image_array_2 = explode(",", $image_array_1[1]);
    $data = base64_decode($image_array_2[1]);
    $image_name = 'image/profile/' . $id . '.png';

    file_put_contents($image_name, $data);

    echo $image_name;
    $_SESSION['img_dir'] = $image_name;

    $query = "UPDATE customers SET img_dir = '$image_name' WHERE email = '{$_SESSION['email']}' LIMIT 1";
            $result = mysqli_query($connection, $query);
            if ($result) {
                //query success! redirect to home page
                echo "Database query success.";
            } else {
                echo "Database query failed.";
            }
}
}
}
?>