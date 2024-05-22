<?php 
$itemId = $_GET["id"];
$host = "localhost";
$username = "brrrncwp_main";
$password = "Ftf51678@1";
$dbname = "brrrncwp_main";
?>

<?php 
ob_start();
session_start();

include("db.php");
include("functions.php");

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection faileds: " . $conn->connect_error);
} 

$emails = $_SESSION['email'];
$sql = "SELECT * FROM users WHERE email='$emails'";
$result = $conn->query($sql);

if (!$result) {
    trigger_error('Invalid query: ' . $conn->error);
}

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $email = $row["email"];
        $userpassword = $row["password"];
        $trialstartdate = $row["startdate"];
        $trialenddate = $row["enddate"];
        $paid = $row["paid"];
        $billingdate = $row["billingdate"];
        $credits = $row["credits"];
    }
}
?>