<?php
include("config.php");
include("functions/init.php");
?>

<?php
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$newCredits = $credits - 2;

$sql = "UPDATE users SET credits='$newCredits' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
  
} else {
  
}

$conn->close();
?>

<?php
$offer = $_POST['offer'];
$customer = $_POST['customer'];
$buyer = $_POST['buyer'];
$objective = "Objective: " . $_POST['objective'];
$tone = "Tone: " . $_POST['tone'];
$help_factor = "This product, service or software helps by: " . $_POST['help_factor'];
$goal_factor = "This solution fits the Ideal Customer Profile and personas current goals by: " . $_POST['goal_factor'];
$competitor_differences = "These are the competitor differences: " . $_POST['competitor_differences'];
$social_proof = "These social proofs motivate these customers: " . $_POST['social_proof'];
$accolades = "These accolades are worth mentioning to the customers: " . $_POST['accolades'];
$extra_information = "Extra information about this cold email sequence: " . $_POST['extra_information'];
?>

<?php
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM offers WHERE id='$offer'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $theOffer = "Offer Type: " . $row["offer_type"] . "<br>" . "Offer Name: " . $row["name"] . "<br>" . "Offer Location: " . $row["location"] . "<br>" . "Extra information about the offer: " . $row["extra_information"];
  }
} else {
  echo "Error";
}
$conn->close();
?>

<?php
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM customers WHERE id='$customer'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $theCustomer = "Ideal Customer Profile Industry: " . $row["industry"] . "<br>" . "Ideal Customer Profile Location: " . $row["location"] . "<br>" . "Ideal Customer Profile Employees: " . $row["employees"] . "<br>" . "Ideal Customer Profile Customers: " . $row["customers"] . "<br>" . "Ideal Customer Profile Revenue: " . $row["revenue"] . "<br>" . "Ideal Customer Profile Budget: " . $row["budget"] . "<br>" . "Ideal Customer Profile Short Term Goals: " . $row["short_goals"] . "<br>" . "Ideal Customer Profile Long Term Goals: " . $row["long_goals"] . "<br>" . "Ideal Customer Profile Pain Point 1: " . $row["pain_point1"] . "<br>" . "Ideal Customer Profile Pain Point 2: " . $row["pain_point2"] . "<br>" . "Ideal Customer Profile Pain Point 3: " . $row["pain_point3"] . "<br>" . "Ideal Customer Profile Technology 1: " . $row["tech_1"] . "<br>" . "Ideal Customer Profile Technology 2: " . $row["tech_2"] . "<br>" . "Ideal Customer Profile Technology 3: " . $row["tech_3"] . "<br>" . "Extra information for this ideal customer profile: " . $row["extra_information"];
  }
} else {
  echo "Error";
}
$conn->close();
?>

<?php
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM buyers WHERE id='$buyer'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $theBuyer = "Buyer Name: " . $row["name"] . "<br>" . "Buyer Job Title: " . $row["job_title"] . "<br>" . "Buyer Gender: " . $row["gender"] . "<br>" . "Buyer Location: " . $row["location"] . "<br>" . "Buyer Age: " . $row["age"] . "<br>" . "Buyer Education: " . $row["education"] . "<br>" . "Buyer Family Status: " . $row["family_status"] . "<br>" . "Buyer Responsibilities: " . $row["responsibilities"] . "<br>" . "Buyer Purchase Habits: " . $row["purchase_habits"] . "<br>" . "Buyer Purchase Motivation: " . $row["purchase_motivation:"] . "<br>" . "Buyer Communication: " . $row["communication"] . "<br>" . "Buyer Goal 1: " . $row["goal_1"] . "<br>" . "Buyer Goal 2: " . $row["goal_2"] . "<br>" . "Buyer Goal 3: " . $row["goal_3"] . "<br>" . "Buyer Frustration 1: " . $row["frustrate_1"] . "<br>" . "Buyer Frustration 2: " . $row["frustrate_2"] . "<br>" . "Buyer Frustration 3: " . $row["frustrate_3"] . "<br>" . "Extra information about this buyer: " . $row["extra_information"];
  }
} else {
  echo "Error";
}
$conn->close();
?>

<?php
$api_key = $openaiApiKey;
$prompt       = 'Can you write a cold email with these details?' . $theOffer . $theCustomer . $theBuyer . $objective . $tone . $help_factor . $goal_factor . $competitor_differences . $social_proof . $accolades . $extra_information;

$data = [
        'model'    => 'gpt-3.5-turbo',
        'messages' => [
                ['role' => 'user', 'content' => $prompt],
        ],
];

$options = [
        'http' => [
                'header'  => "Content-Type: application/json\r\nAuthorization: Bearer $api_key",
                'method'  => 'POST',
                'content' => json_encode($data),
        ],
];

$context  = stream_context_create($options);
$response = file_get_contents('https://api.openai.com/v1/chat/completions', false, $context);
$response = json_decode($response);
$response = $response->choices[0]->message->content;
echo $response;
?>