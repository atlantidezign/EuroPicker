<?php
include('conf.php');
$mysqli = new mysqli($mysql_hostname,$mysql_user,$mysql_password,$mysql_database);

// check connection
if ($mysqli->connect_error) {
  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
}

header("access-control-allow-origin: *");
header("access-control-allow-methods: GET, POST, OPTIONS");
header("access-control-allow-credentials: true");
header("access-control-allow-headers: Content-Type, *");
header("Content-type: application/json");


// Parse the log in form if the user has filled it out and pressed "Log In"
if (isset($_POST['formData'])) {

      //CRYPT_BLOWFISH or die ('No Blowfish found.');

      //This string tells crypt to use blowfish for 5 rounds.
      //$Blowfish_Pre = '$2a$05$';
      //$Blowfish_End = '$';
      parse_str($_POST['formData'], $output);
      $username = $mysqli->real_escape_string($output['username']);
      $password = $mysqli->real_escape_string($output['password']);


      $sql = "SELECT * FROM utenti WHERE username='$username' LIMIT 1";
      $result = $mysqli->query($sql) or die( $mysqli->error() );
      $row = mysqli_fetch_assoc($result);

      //$hashed_pass = crypt($password, $Blowfish_Pre . $row['salt'] . $Blowfish_End);

      if ($password == $row['password']) {
          $response_array['status'] = TRUE; 
      } else {
          $response_array['status'] = FALSE; 
      }

echo json_encode($response_array);

}

$mysqli->close();
?>
