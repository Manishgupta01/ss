<?php

// define variables and set to empty values
$fnameErr = $lnameErr = $DstartErr = $emailErr = $phonenoErr = $choose_file = $addressErr =  $zipErr = $gender_nameErr = $languageErr = "";
  
$fname = $lname = $Dstart = $email = $phoneNumber = $choose_file = $address = $zip = $gender_name = $language  = "";

if (isset($_POST['submit']) && $_SERVER["REQUEST_METHOD"] == "POST") {

    // if (empty($_POST["fname"])) {
    //     $fnameErr = "is required";
    // } else {
    //     $fname = test_input($_POST["fname"]);
    //     // check if name only contains letters and whitespace
    //     if (!preg_match("/^[a-zA-Z-']*$/", $fname)) {
    //         $fnameErr = "Only letters and white space allowed";
    //     }
    // }
    // $fname = "abc";
    // preg_match('/^[a-zA-Z]$/', $fname);//Will return true.

    if (empty($_POST["lname"])) {
        $lnameErr = "is required";
    } else {
        $lname = test_input($_POST["lname"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-']*$/", $lname)) {
            $lnameErr = "Only letters and white space allowed";
        }
    }


    if (empty($_POST["Dstart"])) {
        $DstartErr = "is required";
    } else {
        $$Dstart = test_input($_POST["Dstart"]);
        // check if name only contains letters and whitespace
        if (preg_match("/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]*$/", $Dstart)) {
            $DstartErr = "Only letters and white space allowed";
        }
    }


    if (empty($_POST["email"])) {
        $emailErr = "is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    if (empty($_POST["phoneno"])) {
        $phonenoErr = "is required";
    } else {
        $phoneNumber = test_input($_POST["phoneno"]);
        // check if name only contains letters and whitespace
        if (!preg_match('/^[0-9]*$/', $phoneNumber)) {
            $phonenoErr = "Only letters and white space allowed";
        }
    }


    if (empty($_POST["address"])) {
        $addressErr = "is required";
    } else {
        $address = test_input($_POST["address"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $address)) {
            $addressErr = "Only letters and white space allowed";
        }
    }
    if (empty($_POST["zip"])) {
        $zipErr = "is required";
    } else {
        $zip = test_input($_POST["zip"]);
        // check if name only contains letters and whitespace
        if (!preg_match('/^[0-9]*$/',  $zip)) {
            $zipErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["gender_name"])) {
        $gender_nameErr = "is required";
    } else {
        $gender_name = test_input($_POST["gender_name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $gender_name)) {
            $gender_nameErr = "Only letters and white space allowed";
        }
    }
    
   
    if (empty($_POST["language[]"])) {
        $languageErr = "is required";
    }

}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


?>

<?php

if ($fnameErr == "" && $lnameErr == "" && $DstartErr == "" &&  $emailErr == "" &&  $phonenoErr == "" &&  $choose_file == "" &&  $addressErr == "" && $zipErr == "") {
    // echo"34234234";die;
    // echo "alert($_POST)";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $Dstart = $_POST['Dstart'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phoneno'];
        $choose_file = $_FILES['choose_file'];
        $target_path ="uploads/";
  
        if(isset($_FILES['choose_file'])){

        $file_name = $_FILES['choose_file']['name'];
        $file_size = $_FILES['choose_file']['size'];
        $file_tmp = $_FILES['choose_file']['tmp_name'];
        $file_type = $_FILES['choose_file']['type'];
    
        move_uploaded_file($file_tmp,"uploads/" . $file_name);
    }
    $Show_path = $target_path . $file_name;
    // print_r($Show_path);die;

        $address = $_POST['address'];
        $zip = $_POST['zip'];



   
        if (isset($_REQUEST['gender_name'])) {
            $gender_name = $_REQUEST['gender_name'];
        }


        $language = isset($_POST['language']) ? implode(',', $_POST['language']) : '';

      

        $sql = "INSERT INTO registration_from (fname, lname, Dstart, email, phoneno, choose_file, address, zip, gender_name, language )
   VALUES ('$fname', '$lname', '$Dstart', '$email', '$phoneNumber', '$Show_path',  '$address', '$zip' ,'$gender_name', '$language' )";

// print_r($sql);die;
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Your entry has been submited sucessfully!  </strong> You should check in on some of those fields below.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error! </strong> we are facing some tecnical issue and entry was not submited sucessfully! we are gregate 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
        }
    }
}

if (isset($_POST['type'])){
    if($_POST['type']=='delete'){
        $id=$_POST['id'];
        $query = "delete from input_data where Id ="."'".$id."'";
if ($conn->query($query) === TRUE) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Holy guacamole!</strong> Data deleted  succesfully!</div>';
}else{
    echo "Error: " . $sql1 . "<br>" . $conn->error;
}
} } 

?>


