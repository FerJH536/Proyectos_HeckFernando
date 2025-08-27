 <?php
$servername = "localhost";
$username = "phpmyadmin";
$password = "aestudiar";
$dbname= "estudiantes";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql= "Create table Estudianes (id int (2) AUTO_INCREMENT PRIMARY KEY, nombre varchar (30), edad int (3), carrera varchar (30), 1er_parcial int (2), 2do_parcial int (3), 3er_parcial int (2))";

if ($conn->query($sql) === TRUE) {
  echo "Table Estudiantes created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

$conn->close();
?> 