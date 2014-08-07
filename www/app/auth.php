<?php
include('conf.php');
$mysqli = new mysqli($mysql_hostname,$mysql_user, $mysql_password, $mysql_database);

header("access-control-allow-origin: *");
header("access-control-allow-methods: GET, POST, OPTIONS");
header("access-control-allow-credentials: true");
header("access-control-allow-headers: Content-Type, *");
header("Content-type: application/json");

// Parse the log in form if the user has filled it out and pressed "Log In"
if (isset($_POST["username"]) && isset($_POST["password"])) {

      CRYPT_BLOWFISH or die ('No Blowfish found.');

      //This string tells crypt to use blowfish for 5 rounds.
      $Blowfish_Pre = '$2a$05$';
      $Blowfish_End = '$';

      $username = mysql_real_escape_string($_POST['username']);
      $password = mysql_real_escape_string($_POST['password']);


      $sql = "SELECT * FROM utenti WHERE username='$username' LIMIT 1";
      $result = $mysqli->query($sql) or die( $mysqli->error() );
      $row = mysqli_fetch_assoc($result);

      $hashed_pass = crypt($password, $Blowfish_Pre . $row['salt'] . $Blowfish_End);

      if ($hashed_pass == $row['password']) {
          $response_array['status'] = 'success'; 
      } else {
          $response_array['status'] = 'error'; 
      }
echo json_encode($response_array);

}

$mysqli->close();
?>