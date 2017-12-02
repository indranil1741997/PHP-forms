<!DOCTYPE html>
<html>
<style type="text/css">
.demo{
        background-image: url("6.jpg");
    } 
.error {
        color: red;
        margin-left: 50px;
        position: relative;
    }    
.div{
    font: 95% Arial, Helvetica, sans-serif;
    width: 600px;
    border-radius: 4px;
    height: auto;
    padding: 16px;
    margin: 10px auto;
    box-sizing: border-box;
    background: white;
    box-shadow: 10px black;
}
h1{
    font: 95% Arial, Helvetica, sans-serif;
    margin: 10px auto;
    background: white;
    font-size: 240%;
    font-weight: 300;
    text-align: center;
    color: black;
}
h4{
        margin-left: 40px;
}
.div input[type="text"],
.div textarea,
.div select 
{
    -webkit-transition: all 0.30s ease-in-out;
    -moz-transition: all 0.30s ease-in-out;
    -ms-transition: all 0.30s ease-in-out;
    -o-transition: all 0.30s ease-in-out;
    box-sizing: border-box;
    border: none;
    margin-left: 50px;
    border-bottom: 2px solid blue;
    width: 250px;
    margin-bottom: 20px;
    color: black;
    font: 95% Arial, Helvetica, sans-serif;
}
.div input[type="text"]:focus,
.div textarea:focus,
.div select:focus
{
    padding: 3%;
    width: 54%;
    border: none;
    outline: none;
    border-bottom: 2px solid red;
}

.div input[type="submit"],
.div input[type="button"]{
        -webkit-transition: all 0.40s ease-in-out;
    -moz-transition: all 0.40s ease-in-out;
    -ms-transition: all 0.40s ease-in-out;
    -o-transition: all 0.40s ease-in-out;
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    width: 150px;
    padding: 3%;
    background: blue;
    border-bottom: 2px solid #30C29E;
    border-top-style: none;
    border-right-style: none;
    border-left-style: none;    
    color: #fff;
    margin-left: 200px;
    border-radius: 8px;
}
.div input[type="submit"]:hover,
.div input[type="button"]:hover{
    background: BROWN;
}
    success{
        margin-left: 200px;
        font-family:serif;
        color: blue;
    }
</style>
<body class="demo">
    <?php
    $emailErr = $phoneErr = "";
    $email = $phone = $name = $address = $id = $success = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "*Invalid email format"; 
    }
  }
 if (empty($_POST["phone"])){
     $phoneErr = "Phone Required";
 } else {
     $phone = test_input($_POST["phone"]);
     if(strlen($phone)!=10){
         $phoneErr = "*Enter 10 digit phone ";
     }
    }
    if($emailErr=="" && $phoneErr==""){
        record();
    }
    }
    function record(){
        $link = mysqli_connect("localhost", "root", "", "hello");
        if($link === false){
        die("ERROR: Could not connect. ".mysqli_connect_error());
        }
        $id = mysqli_real_escape_string($link, $_REQUEST['id']);
        $name = mysqli_real_escape_string($link, $_REQUEST['name']);
        $email = mysqli_real_escape_string($link, $_REQUEST['email']);    
        $address = mysqli_real_escape_string($link, $_REQUEST['address']);
        $phone = mysqli_real_escape_string($link, $_REQUEST['phone']);

        $sql = "INSERT INTO form VALUES ('$id', '$name', '$email', '$address', '$phone')";
        if(mysqli_query($link, $sql)){
            $GLOBALS['success'] = "Records added successfully.";
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
        mysqli_close($link);
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
    <div class="div">
<h1>Fill Details</h1><success><?php echo "$success"?></success>
<form action="" method="post">
    <h4>Student ID</h4>
<input type="text" name="id"/>
    <h4>Name</h4>
<input type="text" name="name"/>
    <h4>Email</h4>
<input type="text" name="email"><mail class="error"><?php echo "$emailErr"?></mail>
    <h4>Address</h4>
    <textarea name="address" ></textarea>
    <h4>Phone</h4>
<input type="text" name="phone"><mail class="error"><?php echo "$phoneErr"?></mail> <br>  
<input type="submit" value="SUBMIT" />
    
</form>
</div>
</body>
</html>    