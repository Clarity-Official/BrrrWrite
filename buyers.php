<?php
include ("functions/init.php");

include("config.php");

if (logged_in()) {
    
} else {
    header("Location: /signin");
}
?>

<?php
if ($_POST) {
$theID = $_POST["id"];
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM buyers WHERE id='$theID'";

if ($conn->query($sql) === TRUE) {
  
} else {
  
}

$conn->close();   
}
?>

<html lang="en" class="h-full">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Buyer Personas - <?php echo $siteName ?></title>
      <!-- Meta Tags -->
      <?php include 'meta.php' ?>
      <!-- Fonts -->
      <link rel="preconnect" href="https://fonts.bunny.net">
      <link href="https://fonts.bunny.net/css?family=inter:400,500,600" rel="stylesheet">
      <link href="https://fonts.bunny.net/css?family=figtree:700" rel="stylesheet">
      <!-- Scripts -->
      <link rel="stylesheet" href="/assets/css/style.css">
      <link rel="stylesheet" href="/assets/css/custom.css">
      <style>
      .mL {
        margin-left: -40px !important;
      }
      @media only screen and (max-width: 600px) {
       .mL {
        margin-left: -25px !important;
       }
      }
      </style>
      <script src="https://cdn.tailwindcss.com"></script>
      <script src="https://unpkg.com/feather-icons"></script>
   </head>
   <body class="h-full font-sans antialiased">
         <div class="flex flex-col items-stretch min-w-0">
            <?php include 'trial-bar.php' ?>
            <?php include 'sidebar.php' ?>
            <?php include 'billing-include.php' ?>
            <div class="sm:ml-72 flex-1 flex flex-col items-stretch min-h-0 pt-4">
               <header class="flex-shrink-0">
                  <div class="mx-auto max-w-7xl md:flex md:items-center md:justify-between">
                     <div class="min-w-0 flex-1">
                        <h1 class="sm:pl-8 pl-5 pb-4 border-b text-xl font-bold leading-tight tracking-tight text-gray-800 sm:truncate">Buyer Personas</h1>
                     </div>
                  </div>
               </header>
               <main class="flex-1">
                  <div class="min-h-full mx-auto max-w-7xl py-8 sm:px-6 lg:px-8">
                      <div id="projects" class="grid grid-cols-3 gap-4">
                          <a href="/new/buyer">
   <li class="xl:h-[220px] h-[340px] justify-center border-2 border-dashed rounded-md shadow-sm bg-white relative flex gap-x-6 px-10 xl:py-20 py-32 hover:bg-gray-50 sm:px-6 lg:px-6">
   <div class="min-w-0">
      <img class="ml-auto mr-auto w-[25px]" src="/assets/images/plus.svg">
      <p class="mt-1.5 text-base font-semibold leading-6 text-gray-600">New buyer persona</p>
   </div>
</li>
</a>
<?php
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$theid = $id;
$sql = "SELECT * FROM buyers WHERE user='$id' ORDER BY `id` DESC";
$result = $conn->query($sql);

if (!$result) {
    trigger_error('Invalid query: ' . $conn->error);
}

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) { ?>

<?php $host = parse_url($row["url"], PHP_URL_HOST);
$host = preg_replace('/^(www\.)/i', '', $host);

?>
    <div class="xl:h-[220px] h-[340px] ring-1 ring-gray-900/5 rounded-md shadow-sm bg-white relative gap-x-6 hover:bg-gray-50">
   <div class="pb-3 pt-4 border-b items-center gap-3 justify-between flex">
   <div class="items-center gap-3 flex">
       <div class="pl-4">
       <i style="background-color: <?php echo $row['color'] ?>;" class="rounded-lg w-[50px] h-[50px] p-3 text-white" data-feather="user"></i>
       </div>
       <div class="block">
          <div class="font-bold"><?php echo $row['name'] ?></div>
          <div class="text-gray-400"><?php echo $row['job_title'] ?></div>
       </div>
       </div>
       <form id="delete-<?php echo $row['id'] ?>" action="/buyers" method="POST">
          <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
       </form>
       <button id="dropdownDefaultButton-<?php echo $row['id'] ?>" data-dropdown-toggle="dropdown-<?php echo $row['id'] ?>" class="mr-2 text-white hover:bg-gray-200 focus:ring-3 focus:outline-none focus:ring-sky-400 font-medium rounded text-sm px-2.5 py-2.5 text-center inline-flex items-center" type="button"><svg class="text-gray-400 w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
</svg>
</button>

<!-- Dropdown menu -->
<div id="dropdown-<?php echo $row['id'] ?>" class="mL border z-10 hidden bg-white divide-y divide-gray-100 rounded-md w-24">
    <ul class="text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
      <li>
        <a onClick="document.getElementById('delete-<?php echo $row['id'] ?>').submit();" href="#" class="text-center py-3 text-red-500 font-semibold block px-4 py-2 hover:bg-gray-100">Delete</a>
      </li>
    </ul>
   </div>
  </div>
   <div class="pl-4 grid grid-cols-1 grid xl:grid-cols-2 gap-4 mt-4 min-w-0">
      <div>
        <p class="text-sm text-gray-500 font-semibold">Gender</p>
        <p class="capitalize text-black font-semibold"><?php echo $row['gender'] ?></p>
      </div>
      <div>
        <p class="text-sm text-gray-500 font-semibold">Age</p>
        <p class="text-black font-semibold"><?php echo $row['age'] ?></p>
      </div>
      <div>
        <p class="text-sm text-gray-500 font-semibold">Education level</p>
        <p class="text-black font-semibold"><?php echo $row['education'] ?></p>
      </div>
      <div>
        <p class="text-sm text-gray-500 font-semibold">Family status</p>
        <p class="text-black font-semibold"><?php echo $row['family_status'] ?></p>
      </div>
   </div>
</div>

<?php }
} else { ?>

<?php }

?>

</div>
                  </div>
               </main>
            </div>
         </div>
      </div>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
      <script>
         feather.replace();
      </script>
   </body>
</html>