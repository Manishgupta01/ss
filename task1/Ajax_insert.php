<?php
require_once 'connection.php';

//start
$error = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    // if (empty($_POST["fname"])) {
    //     $$error[] = "is required";
    // } else {
    //     $fname = test_input($_POST["fname"]);
    //     // check if name only contains letters and whitespace
    //     if (!preg_match("/^[a-zA-Z-']*$/", $fname)) {
    //         $$error[] = "Only letters and white space allowed";
    //     }
    // }


    // if (empty($_POST["lname"])) {
    //     $error[] = "is required";
    // } else {
    //     $lname = test_input($_POST["lname"]);
    //     // check if name only contains letters and whitespace
    //     if (!preg_match("/^[a-zA-Z-']*$/", $lname)) {
    //         $error[] = "Only letters and white space allowed";
    //     }
    // }


    // if (empty($_POST["Dstart"])) {
    //     $error[] = "is required";
    // } else {
    //     $Dstart = test_input($_POST["Dstart"]);
    //     // check if name only contains letters and whitespace
    //     if (preg_match("/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]*$/", $Dstart)) {
    //         $error[] = "Only letters and white space allowed";
    //     }
    // }


    // if (empty($_POST["email"])) {
    //     $error[] = "is required";
    // } else {
    //     $email = test_input($_POST["email"]);
    //     // check if e-mail address is well-formed
    //     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //         $error[] = "Invalid email format";
    //     }
    // }

    // if (empty($_POST["phoneno"])) {
    //     $error[] = "is required";
    // } else {
    //     $phoneNumber = test_input($_POST["phoneno"]);
    //     // check if name only contains letters and whitespace
    //     if (!preg_match('/^[0-9]*$/', $phoneNumber)) {
    //         $error[] = "Only letters and white space allowed";
    //     }
    // }


    // if (empty($_POST["address"])) {
    //     $error[] = "is required";
    // } else {
    //     $address = test_input($_POST["address"]);
    //     // check if name only contains letters and whitespace
    //     if (!preg_match("/^[a-zA-Z-' ]*$/", $address)) {
    //         $error[] = "Only letters and white space allowed";
    //     }
    // }
    // if (empty($_POST["zip"])) {
    //     $error[] = "is required";
    // } else {
    //     $zip = test_input($_POST["zip"]);
    //     // check if name only contains letters and whitespace
    //     if (!preg_match('/^[0-9]*$/',  $zip)) {
    //         $error[] = "Only letters and white space allowed";
    //     }
    // }

    // if (empty($_POST["gender_name"])) {
    //     $error[] = "is required";
    // } else {
    //     $gender_name = test_input($_POST["gender_name"]);
    //     // check if name only contains letters and whitespace
    //     if (!preg_match("/^[a-zA-Z-' ]*$/", $gender_name)) {
    //         $error[] = "Only letters and white space allowed";
    //     }
    // }


    // if (empty($_POST["language[]"])) {
    //     $error[] = "language is required";
    // } else {
    //     $language = test_input($_POST["language"]);
    //     if (!preg_match("/^[a-zA-Z-' ]*$/", $language)) {
    //         $error[] = "Only letters and white space allowed";
    //     }
    // }

    // print_r($_FILES);
    // die;

    if (empty($error)) {
        // echo "here";
        // die;
        print_r($_FILES);die;

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $Dstart = $_POST['Dstart'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phoneno'];
        $path = $_FILES['path'];
        // $target_path = "uploads/";

        if (isset($_FILES['path'])) {

            $file_name = $_FILES['path']['name'];
            $file_size = $_FILES['path']['size'];
            $file_tmp = $_FILES['path']['tmp_name'];
            $file_type = $_FILES['path']['type'];
            move_uploaded_file($file_tmp, "uploads/" . $file_name);
        }
        // $Show_path = $target_path . $file_name;
        $address = $_POST['address'];
        $zip = $_POST['zip'];

        if (isset($_REQUEST['gender_name'])) {
            $gender_name = $_REQUEST['gender_name'];
        }
        $language = isset($_POST['language']) ? implode(',', $_POST['language']) : '';


        $sql = "insert into registration_from(fname, lname, Dstart, email, phoneno, path, address, zip, gender_name, language ) values
 ('{$fname}','{$lname}','{$Dstart}','{$email}','{$phoneNumber}','{$path}','{$address}','{$zip}','{$gender_name}','{$language}')";


        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo 'done';
        } else {
            echo 'error';
        }
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
