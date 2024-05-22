<?php
include ("../functions/init.php");

include("../config.php");

if (logged_in()) {
    
} else {
    header("Location: /signin");
}
?>

<?php
if (isset($_POST["save-offer"])) {
$offer_type = $_POST["offer_type"];
$name = $_POST["name"];
$description = $_POST["description"];
$website = $_POST["website"];
$location = $_POST["location"];
$extra_information = $_POST["extra_information"];

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO offers (user, offer_type, name, description, website, location, extra_information)
VALUES ('$id', '$offer_type', '$name', '$description', '$website', '$location', '$extra_information')";

if ($conn->query($sql) === TRUE) {
  header("Location: /");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}
?>


<html lang="en" class="h-full">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>New Offer - <?php echo $siteName ?></title>
      <!-- Meta Tags -->
      <?php include '../meta.php' ?>
      <!-- Fonts -->
      <link rel="preconnect" href="https://fonts.bunny.net">
      <link href="https://fonts.bunny.net/css?family=inter:400,500,600" rel="stylesheet">
      <link href="https://fonts.bunny.net/css?family=figtree:700" rel="stylesheet">
      <!-- Scripts -->
      <link rel="stylesheet" href="/assets/css/style.css">
      <link rel="stylesheet" href="/assets/css/custom.css">
      <script src="https://cdn.tailwindcss.com"></script>
      <script src="https://unpkg.com/feather-icons"></script>
   </head>
   <body class="h-full font-sans antialiased">
         <div class="flex flex-col items-stretch min-w-0">
            <?php include '../trial-bar.php' ?>
            <?php include '../sidebar.php' ?>
            <?php include '../billing-include.php' ?>
            <div class="sm:ml-72 flex-1 flex flex-col items-stretch min-h-0 pt-4">
               <header class="flex-shrink-0">
                  <div class="mx-auto max-w-7xl md:flex md:items-center md:justify-between">
                     <div class="min-w-0 flex-1">
                        <div class="sm:pl-7 pl-5 pb-4 border-b gap-3 items-center flex">
                            <div onClick="history.back()" class="cursor-pointer rounded p-1 bg-gray-100"><i class="size-4" data-feather="arrow-left"></i></div>
                            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-800 sm:truncate">New Offer</h1>
                        </div>
                     </div>
                  </div>
               </header>
               <main class="flex-1">
                  <div>
                      <div class="justify-between sm:flex">
                          <div class="pt-8 pl-6 pr-6 sm:pl-8 sm:pr-8 border-r sm:w-[60%]">
                          <form action="/new/offer" method="POST">
                              <label class="text-gray-500 font-semibold">Offer type</label>
                              <div class="mt-3 items-center flex">
                              <input class="checked:<?php echo $bg ?> checked:hover:<?php echo $bg ?> checked:active:<?php echo $bg ?> checked:focus:<?php echo $bg ?> focus:<?php echo $bg ?> focus:outline-none focus:ring-1 focus:<?php echo $focusRing ?>" type="radio" name="offer_type" value="product" checked onChange="productIcon()"><div class="ml-2 font-semibold">Product</div></input>
                              <input class="ml-6 checked:<?php echo $bg ?> checked:hover:<?php echo $bg ?> checked:active:<?php echo $bg ?> checked:focus:<?php echo $bg ?> focus:<?php echo $bg ?> focus:outline-none focus:ring-1 focus:<?php echo $focusRing ?>" type="radio" name="offer_type" value="service" onChange="serviceIcon()"><div class="ml-2 font-semibold">Service</div></input>
                              <input class="ml-6 checked:<?php echo $bg ?> checked:hover:<?php echo $bg ?> checked:active:<?php echo $bg ?> checked:focus:<?php echo $bg ?> focus:<?php echo $bg ?> focus:outline-none focus:ring-1 focus:<?php echo $focusRing ?>" type="radio" name="offer_type" value="job" onChange="jobIcon()"><div class="ml-2 font-semibold">Job</div></input>
                              </div>
                              <div class="mt-6">
                              <label class="text-gray-500 font-semibold">Name</label>
                              <input required class="mt-2 block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" type="text" placeholder="Name your offer" name="name" id="name" onChange="updatePreview()">
                              </div>
                              <div class="mt-6">
                              <label class="text-gray-500 font-semibold">Description</label>
                              <textarea required class="mt-2 block w-full rounded-md border-0 py-2 px-2 h-[80px] text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" placeholder="Give details about the offer" name="description" id="description" onChange="updatePreview()"></textarea>
                              </div>
                              <div class="mt-6">
                              <label class="text-gray-500 font-semibold">Website</label>
                              <input required class="mt-2 block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" type="url" placeholder="Ex. https://google.com" name="website" id="website" onChange="updatePreview()">
                              </div>
                              <div class="mt-6">
                              <label class="text-gray-500 font-semibold">Location</label>
                              <input required class="mt-2 block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" type="text" placeholder="Ex. San Jose, California" name="location" id="location" onChange="updatePreview()">
                              </div>
                              <div class="mt-6">
                              <label class="text-gray-500 font-semibold">Extra information</label>
                              <textarea class="mt-2 block w-full rounded-md border-0 py-2 px-2 h-[80px] text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" placeholder="Anything else that is important to know about this offer." name="extra_information" id="extra_information" onChange="updatePreview()"></textarea>
                              </div>
                              
                              <div class="pt-4 mt-10 border-t">
                                  <div class="justify-between flex">
                                      <a class="text-gray-600 font-semibold rounded px-4 py-2 bg-gray-100 hover:bg-gray-200" href="/">Cancel</a>
                                      
                                      <input id="save-offer" name="save-offer" type="submit" class="cursor-pointer text-white font-semibold rounded px-4 py-2 <?php echo $bg ?> hover:<?php echo $bgHover ?>" value="Save Offer"></input>
                                  </div>
                              </div>
                          </form>
                          </div>
                          
                          <div class="pb-12 bg-slate-100 sm:w-[40%] border-t">
                              <p class="text-gray-500 font-medium pb-2 border-b mt-2 text-center">Offer Preview</p>
                              <div class="ml-4 mr-4 mt-8 h-[220px] ring-1 ring-gray-900/5 rounded-md shadow-sm bg-white relative gap-x-6">
   <div class="pb-3 pt-4 border-b items-center gap-3 flex">
       <div class="pl-6">
       <i id="product-icon" class="rounded-lg w-[50px] h-[50px] p-3 text-white bg-green-400" data-feather="gift"></i>
       <i id="service-icon" style="display: none;" class="rounded-lg w-[50px] h-[50px] p-3 text-white bg-blue-500" data-feather="smile"></i>
       <i id="job-icon" style="display: none;" class="rounded-lg w-[50px] h-[50px] p-3 text-white bg-red-500" data-feather="briefcase"></i>
       </div>
       <div class="block">
          <div id="preview_name" class="font-bold"></div>
          <div id="preview_description" class="text-gray-400"></div>
       </div>
   </div>
   <div class="pl-6 pr-6 grid grid-cols-2 gap-4 mt-4 min-w-0">
      <div>
        <p class="text-sm text-gray-500 font-semibold">Type</p>
        <p id="preview_type" class="capitalize text-black font-semibold">Product</p>
      </div>
      <div>
        <p class="text-sm text-gray-500 font-semibold">Website</p>
        <p id="preview_website" class="text-black font-semibold">N/A</p>
      </div>
      <div>
        <p class="text-sm text-gray-500 font-semibold">Location</p>
        <p id="preview_location" class="text-black font-semibold">N/A</p>
      </div>
   </div>
</div>
                          </div>
                      </div>
                  </div>
               </main>
            </div>
         </div>
      </div>
      <script>
         feather.replace();
      </script>
      <script>
      function updatePreview() {
        document.getElementById("preview_name").innerHTML = document.getElementById("name").value;
        document.getElementById("preview_description").innerHTML = document.getElementById("description").value;
        document.getElementById("preview_website").innerHTML = document.getElementById("website").value;
        document.getElementById("preview_location").innerHTML = document.getElementById("location").value;
      }
      
      function productIcon() {
         document.getElementById("product-icon").style.display = "block";
         document.getElementById("service-icon").style.display = "none";
         document.getElementById("job-icon").style.display = "none";
      }
      
      function serviceIcon() {
         document.getElementById("service-icon").style.display = "block";
         document.getElementById("product-icon").style.display = "none";
         document.getElementById("job-icon").style.display = "none";
      }
      
      function jobIcon() {
         document.getElementById("job-icon").style.display = "block";
         document.getElementById("product-icon").style.display = "none";
         document.getElementById("service-icon").style.display = "none";
      }
      </script>
   </body>
</html>