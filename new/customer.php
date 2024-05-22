<?php
include ("../functions/init.php");

include("../config.php");

if (logged_in()) {
    
} else {
    header("Location: /signin");
}
?>

<?php
if (isset($_POST["save-customer"])) {
$color = $_POST["color"];
$industry = $_POST["industry"];
$location = $_POST["location"];
$employees = $_POST["employees"];
$customers = $_POST["customers"];
$revenue = $_POST["revenue"];
$budget = $_POST["budget"];
$short_goals = $_POST["short_goals"];
$long_goals = $_POST["long_goals"];
$pain_point1 = $_POST["pain_point1"];
$pain_point2 = $_POST["pain_point2"];
$pain_point3 = $_POST["pain_point3"];
$tech_1 = $_POST["tech_1"];
$tech_2 = $_POST["tech_2"];
$tech_3 = $_POST["tech_3"];
$extra_information = $_POST["extra_information"];

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO customers (user, color, industry, location, employees, customers, revenue, budget, short_goals, long_goals, pain_point1, pain_point2, pain_point3, tech_1, tech_2, tech_3, extra_information)
VALUES ('$id', '$color', '$industry', '$location', '$employees', '$customers', '$revenue', '$budget', '$short_goals', '$long_goals', '$pain_point1', '$pain_point2', '$pain_point3', '$tech_1', '$tech_2', '$tech_3', '$extra_information')";

if ($conn->query($sql) === TRUE) {
  header("Location: /customers");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}
?>


<html lang="en" class="h-full">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>New Ideal Customer Profile - <?php echo $siteName ?></title>
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
                            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-800 sm:truncate">New Ideal Customer Profile</h1>
                        </div>
                     </div>
                  </div>
               </header>
               <main class="flex-1">
                  <div>
                      <div class="justify-between sm:flex">
                          <div class="pt-8 pl-6 pr-6 sm:pl-8 sm:pr-8 border-r sm:w-[60%]">
                          <form action="/new/customer" method="POST">
                              <p class="text-lg font-bold text-black">General Details</p>
                              <div class="mt-5">
                                 <label class="text-gray-500 font-semibold">Industry</label>
                                 <input required type="text" class="pl-3 mt-2 block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" name="industry" id="industry" placeholder="Marketing" onChange="updatePreview()"></input>
                              </div>
                              <div class="mt-6">
                                <label class="text-gray-500 font-semibold">Location</label>
                                <input required class="mt-2 block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" type="text" placeholder="Ex. San Jose, California" name="location" id="location" onChange="updatePreview()">
                              </div>
                              <p class="text-lg mt-16 font-bold text-black">Organization Details</p>
                              
                              <!-- SLIDER 1 -->
                              <div class="mt-4">
                              <label class="text-gray-500 font-semibold">Employees</label>
                                 <div onChange="updatePreview()" class="mt-2 justify-between items-center flex">
                                  <input oninput="this.nextElementSibling.value = this.value" id="employees" name="employees" type="range" value="10" min="0" max="500" step="10" class="w-11/12 h-3 accent-blue-400 bg-blue-100 rounded-lg appearance-none cursor-pointer"><output class="rounded p-2 font-semibold text-white <?php echo $bg ?>">10</output>
                                 </div>
                              </div>
                              <!-- END SLIDER 1 -->
                              
                              
                              <!-- SLIDER 2 -->
                              <div class="mt-4">
                              <label class="text-gray-500 font-semibold">Customers</label>
                                 <div class="mt-2 justify-between items-center flex">
                                  <input onChange="updatePreview()" oninput="this.nextElementSibling.value = this.value" id="customers" name="customers" type="range" value="10" min="0" max="500" step="10" class="w-11/12 h-3 accent-blue-400 bg-blue-100 rounded-lg appearance-none cursor-pointer"><output class="rounded p-2 font-semibold text-white <?php echo $bg ?>">10</output>
                                 </div>
                              </div>
                              <!-- END SLIDER 2 -->
                              
                              <!-- SLIDER 3 -->
                              <div class="mt-4">
                              <label class="text-gray-500 font-semibold">Revenue</label>
                                 <div class="mt-2 justify-between items-center flex">
                                  <input onChange="updatePreview()" oninput="this.nextElementSibling.value = '$' + this.value + '/mo'" id="revenue" name="revenue" type="range" value="1000" min="0" max="10000" step="1000" class="w-10/12 h-3 accent-blue-400 bg-blue-100 rounded-lg appearance-none cursor-pointer"><output class="rounded p-2 font-semibold text-white <?php echo $bg ?>">$1000/mo</output>
                                 </div>
                              </div>
                              <!-- END SLIDER 3 -->
                              
                              <!-- SLIDER 4 -->
                              <div class="mt-4">
                              <label class="text-gray-500 font-semibold">Budget</label>
                                 <div class="mt-2 justify-between items-center flex">
                                  <input onChange="updatePreview()" oninput="this.nextElementSibling.value = '$' + this.value + '/mo'" id="budget" name="budget" type="range" value="500" min="0" max="10000" step="1000" class="w-10/12 h-3 accent-blue-400 bg-blue-100 rounded-lg appearance-none cursor-pointer"><output class="rounded p-2 font-semibold text-white <?php echo $bg ?>">$500/mo</output>
                                 </div>
                              </div>
                              <!-- END SLIDER 4 -->
                              
                              <p class="text-lg mt-16 font-bold text-black">Vision</p>
                              <div class="mt-5">
                                <label class="text-gray-500 font-semibold">Short term goals</label>
                                <textarea class="mt-2 block w-full rounded-md border-0 py-2 px-2 h-[80px] text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" placeholder="What are the short term goals for this ICP?" name="short_goals" id="short_goals" onChange="updatePreview()"></textarea>
                              </div>
                              
                              <div class="mt-6">
                                <label class="text-gray-500 font-semibold">Long term goals</label>
                                <textarea class="mt-2 block w-full rounded-md border-0 py-2 px-2 h-[80px] text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" placeholder="What are the long term goals for this ICP?" name="long_goals" id="long_goals" onChange="updatePreview()"></textarea>
                              </div>
                              
                              <p class="text-lg mt-16 font-bold text-black">Operations</p>
                              <div class="mt-5">
                                <label class="text-gray-500 font-semibold">Pain Points</label>
                                <input type="text" class="mt-2 block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" placeholder="What is making it hard for this ICP to reach their goals?" name="pain_point1" id="pain_point1" onChange="updatePreview()"></input>
                                <input type="text" class="mt-2 block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" placeholder="What is making it hard for this ICP to reach their goals?" name="pain_point2" id="pain_point2" onChange="updatePreview()"></input>
                                <input type="text" class="mt-2 block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" placeholder="What is making it hard for this ICP to reach their goals?" name="pain_point3" id="pain_point3" onChange="updatePreview()"></input>
                                
                                <div class="mt-6">
                                <label class="text-gray-500 font-semibold">Technologies</label>
                                <input type="text" class="mt-2 block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" placeholder="What technologies is this ICP using?" name="tech_1" id="tech_1" onChange="updatePreview()"></input>
                                <input type="text" class="mt-2 block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" placeholder="What technologies is this ICP using?" name="tech_2" id="tech_2" onChange="updatePreview()"></input>
                                <input type="text" class="mt-2 block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" placeholder="What technologies is this ICP using?" name="tech_3" id="tech_3" onChange="updatePreview()"></input>
                                </div>
                                <p class="text-lg mt-16 font-bold text-black">More context</p>
                                <div class="mt-5">
                              <label class="text-gray-500 font-semibold">Extra information</label>
                              <textarea class="mt-2 block w-full rounded-md border-0 py-2 px-2 h-[80px] text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" placeholder="Anything else that is important to know about this ICP." name="extra_information" id="extra_information" onChange="updatePreview()"></textarea>
                              <input type="hidden" name="color" id="color" value="<?php echo $theColor = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6); ?>">
                              </div>
                              </div>
                              
                              <div class="pt-4 mt-10 border-t">
                                  <div class="justify-between flex">
                                      <a class="text-gray-600 font-semibold rounded px-4 py-2 bg-gray-100 hover:bg-gray-200" href="/">Cancel</a>
                                      
                                      <input id="save-customer" name="save-customer" type="submit" class="cursor-pointer text-white font-semibold rounded px-4 py-2 <?php echo $bg ?> hover:<?php echo $bgHover ?>" value="Save Ideal Customer Profile"></input>
                                  </div>
                              </div>
                          </form>
                          </div>
                          
                          <div class="pb-12 bg-slate-100 sm:w-[40%] border-t">
                              <p class="text-gray-500 font-medium pb-2 border-b mt-2 text-center">Ideal Customer Pofile Preview</p>
                              <div class="top-[20px] sticky pb-6 ml-4 mr-4 mt-8 h-[auto] ring-1 ring-gray-900/5 rounded-md shadow-sm bg-white gap-x-6">
   <div class="pb-3 pt-4 border-b items-center gap-3 flex">
       <div class="pl-6">
       <i id="product-icon" class="rounded-lg w-[50px] h-[50px] p-3 text-white" data-feather="trending-up"></i>
       </div>
       <div class="block">
          <div id="preview_industry" class="capitalize font-bold">N/A</div>
          <div id="preview_location" class="text-gray-400">N/A</div>
       </div>
   </div>
   <div class="pl-6 pr-6 grid grid-cols-2 gap-4 mt-4 min-w-0">
      <div>
        <p class="text-sm text-gray-500 font-semibold">Employees</p>
        <p id="preview_employees" class="capitalize text-black font-semibold">10</p>
      </div>
      <div>
        <p class="text-sm text-gray-500 font-semibold">Customers</p>
        <p id="preview_customers" class="text-black font-semibold">10</p>
      </div>
      <div>
        <p class="text-sm text-gray-500 font-semibold">Revenue</p>
        <p id="preview_revenue" class="text-black font-semibold">$1000/mo</p>
      </div>
      <div>
        <p class="text-sm text-gray-500 font-semibold">Budget</p>
        <p id="preview_budget" class="text-black font-semibold">$500/mo</p>
      </div>
   </div>
   <div class="mt-4 pl-6 pr-6">
        <p class="text-sm text-gray-500 font-semibold">Short term goals</p>
        <p id="preview_short" class="text-black font-semibold">N/A</p>
   </div>
   <div class="mt-4 pl-6 pr-6">
        <p class="text-sm text-gray-500 font-semibold">Long term goals</p>
        <p id="preview_long" class="text-black font-semibold">N/A</p>
   </div>
   <div class="mt-4 pl-6 pr-6">
        <p class="mb-1 text-sm text-gray-500 font-semibold">Pain points</p>
        <p id="preview_pain1" class="mr-1 rounded-sm p-1 inline-block text-blue-400 bg-blue-100 font-semibold">N/A</p>
        <p id="preview_pain2" class="mr-1 rounded-sm p-1 inline-block text-blue-400 bg-blue-100 font-semibold"></p>
        <p id="preview_pain3" class="mr-1 rounded-sm p-1 inline-block text-blue-400 bg-blue-100 font-semibold"></p>
   </div>
   <div class="mt-4 pl-6 pr-6">
        <p class="mb-1 text-sm text-gray-500 font-semibold">Technologies</p>
        <p id="preview_tech1" class="mr-1 rounded-sm p-1 inline-block text-blue-400 bg-blue-100 font-semibold">N/A</p>
        <p id="preview_tech2" class="mr-1 rounded-sm p-1 inline-block text-blue-400 bg-blue-100 font-semibold"></p>
        <p id="preview_tech3" class="mr-1 rounded-sm p-1 inline-block text-blue-400 bg-blue-100 font-semibold"></p>
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
         document.getElementById("product-icon").style.backgroundColor = document.getElementById('color').value;
      </script>
      <script>
      function updatePreview() {
        document.getElementById("preview_industry").innerHTML = document.getElementById("industry").value;
        document.getElementById("preview_location").innerHTML = document.getElementById("location").value;
        document.getElementById("preview_employees").innerHTML = document.getElementById("employees").value;
        document.getElementById("preview_customers").innerHTML = document.getElementById("customers").value;
        document.getElementById("preview_revenue").innerHTML = '$' + document.getElementById("revenue").value + '/mo';
        document.getElementById("preview_budget").innerHTML = '$' + document.getElementById("budget").value + '/mo';
        document.getElementById("preview_short").innerHTML = document.getElementById("short_goals").value;
        document.getElementById("preview_long").innerHTML = document.getElementById("long_goals").value;
        document.getElementById("preview_pain1").innerHTML = document.getElementById("pain_point1").value;
        document.getElementById("preview_pain2").innerHTML = document.getElementById("pain_point2").value;
        document.getElementById("preview_pain3").innerHTML = document.getElementById("pain_point3").value;
        document.getElementById("preview_tech1").innerHTML = document.getElementById("tech_1").value;
        document.getElementById("preview_tech2").innerHTML = document.getElementById("tech_2").value;
        document.getElementById("preview_tech3").innerHTML = document.getElementById("tech_3").value;
      }
      </script>
   </body>
</html>