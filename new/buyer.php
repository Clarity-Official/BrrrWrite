<?php
include ("../functions/init.php");

include("../config.php");

if (logged_in()) {
    
} else {
    header("Location: /signin");
}
?>

<?php
if (isset($_POST["save-buyer"])) {
$color = $_POST["color"];
$name = $_POST["name"];
$job_title = $_POST["job_title"];
$gender = $_POST["gender"];
$location = $_POST["location"];
$age = $_POST["age"];
$education = $_POST["education"];
$family_status = $_POST["family_status"];
$responsibilities = $_POST["responsibilities"];
$purchase_habits = $_POST["purchase_habits"];
$purchase_motiviation = $_POST["purchase_motiviation"];
$communication = $_POST["communication"];
$goal_1 = $_POST["goal_1"];
$goal_2 = $_POST["goal_2"];
$goal_3 = $_POST["goal_3"];
$frustrate_1 = $_POST["frustrate_1"];
$frustrate_2 = $_POST["frustrate_2"];
$frustrate_3 = $_POST["frustrate_3"];
$extra_information = $_POST["extra_information"];

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO buyers (user, color, name, job_title, gender, location, age, education, family_status, responsibilities, purchase_habits, purchase_motiviation, communication, goal_1, goal_2, goal_3, frustrate_1, frustrate_2, frustrate_3, extra_information)
VALUES ('$id', '$color', '$name', '$job_title', '$gender', '$location', '$age', '$education', '$family_status', '$responsibilities', '$purchase_habits', '$purchase_motiviation', '$communication', '$goal_1', '$goal_2', '$goal_3', '$frustrate_1', '$frustrate_2', '$frustrate_3', '$extra_information')";

if ($conn->query($sql) === TRUE) {
  header("Location: /buyers");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}
?>


<html lang="en" class="h-full">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>New Buyer Persona - <?php echo $siteName ?></title>
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
                            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-800 sm:truncate">New Buyer Persona</h1>
                        </div>
                     </div>
                  </div>
               </header>
               <main class="flex-1">
                  <div>
                      <div class="justify-between sm:flex">
                          <div class="pt-8 pl-6 pr-6 sm:pl-8 sm:pr-8 border-r sm:w-[60%]">
                          <form action="/new/buyer" method="POST">
                              <p class="text-lg font-bold text-black">General Details</p>
                              <div class="mt-5">
                                 <label class="text-gray-500 font-semibold">Name</label>
                                 <input required type="text" class="pl-3 mt-2 block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" name="name" id="name" placeholder="Name your persona" onChange="updatePreview()"></input>
                              </div>
                              <div class="mt-6">
                                <label class="text-gray-500 font-semibold">Job Title</label>
                                <input required class="mt-2 block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" type="text" placeholder="What is their job?" name="job_title" id="job_title" onChange="updatePreview()">
                              </div>
                              <p class="mb-5 text-lg mt-16 font-bold text-black">Demographics</p>
                              <label class="text-gray-500 font-semibold">Gender</label>
                              <div class="mt-3 items-center flex">
                              <input class="checked:<?php echo $bg ?> checked:hover:<?php echo $bg ?> checked:active:<?php echo $bg ?> checked:focus:<?php echo $bg ?> focus:<?php echo $bg ?> focus:outline-none focus:ring-1 focus:ring-blue-400" type="radio" name="gender" value="male" checked onChange="male()"><div class="ml-2 font-semibold">Male</div></input>
                              <input class="ml-6 checked:<?php echo $bg ?> checked:hover:<?php echo $bg ?> checked:active:<?php echo $bg ?> checked:focus:<?php echo $bg ?> focus:<?php echo $bg ?> focus:outline-none focus:ring-1 focus:ring-blue-400" type="radio" name="gender" value="female" onChange="female()"><div class="ml-2 font-semibold">Female</div></input>
                              </div>
                              
                              <div class="mt-6">
                              <label class="text-gray-500 font-semibold">Location</label>
                              <input required class="mt-2 block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" type="text" placeholder="Ex. San Jose, California" name="location" id="location">
                              </div>
                              
                              <!-- SLIDER 1 -->
                              <div class="mt-6">
                              <label class="text-gray-500 font-semibold">Age</label>
                                 <div class="mt-2 justify-between items-center flex">
                                  <input onChange="updatePreview()" oninput="this.nextElementSibling.value = this.value" id="age" name="age" type="range" value="20" min="18" max="70" class="w-11/12 h-3 accent-blue-400 bg-blue-100 rounded-lg appearance-none cursor-pointer"><output class="rounded p-2 font-semibold text-white <?php echo $bg ?>">10</output>
                                 </div>
                              </div>
                              <!-- END SLIDER 1 -->
                              
                              <div class="mt-6">
                              <label class="text-gray-500 font-semibold">Education level</label>
                              <input required type="text" class="mt-2 block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" name="education" id="education" placeholder="Some college, no degree" onChange="updatePreview()"></input>
                              </div>
                              
                              <div class="mt-6">
                              <label class="text-gray-500 font-semibold">Family status</label>
                              <input required type="text" class="mt-2 block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" name="family_status" id="family_status" placeholder="Single" onChange="updatePreview()"></input>
                              </div>
                              
                              <p class="text-lg mt-16 font-bold text-black">Habits</p>
                              <div class="mt-5">
                                <label class="text-gray-500 font-semibold">Responsibilities</label>
                                <textarea class="mt-2 block w-full rounded-md border-0 py-2 px-2 h-[80px] text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" placeholder="What is this personas primary responsibilities?" name="responsibilities" id="responsibilities" onChange="updatePreview()"></textarea>
                              </div>
                              
                              <div class="mt-6">
                                <label class="text-gray-500 font-semibold">Purchase habits</label>
                                <textarea class="mt-2 block w-full rounded-md border-0 py-2 px-2 h-[80px] text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" placeholder="What kind of purchase habits does this persona have?" name="purchase_habits" id="purchase_habits" onChange="updatePreview()"></textarea>
                              </div>
                              
                              <div class="mt-6">
                                <label class="text-gray-500 font-semibold">Purchase motivation</label>
                                <textarea class="mt-2 block w-full rounded-md border-0 py-2 px-2 h-[80px] text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" placeholder="What motiviates this persona to buy products?" name="purchase_motiviation" id="purchase_motiviation" onChange="updatePreview()"></textarea>
                              </div>
                              
                              <div class="mt-6">
                                <label class="text-gray-500 font-semibold">Communication preferences</label>
                                <select class="mt-2 block w-full rounded-md border-0 px-3 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" name="communication" id="communication" onChange="updatePreview()">
                                    <option value="email">Email</option>
                                    <option value="phone">Phone</option>
                                    <option value="text">Text message</option>
                                </select>
                              </div>
                              
                              <p class="text-lg mt-16 font-bold text-black">Goals</p>
                              <div class="mt-5">
                                <label class="text-gray-500 font-semibold">Goals</label>
                                <input type="text" class="mt-2 block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" placeholder="What goal is this persona trying to accomplish?" name="goal_1" id="goal_1" onChange="updatePreview()"></input>
                                <input type="text" class="mt-2 block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" placeholder="What goal is this persona trying to accomplish?" name="goal_2" id="goal_2" onChange="updatePreview()"></input>
                                <input type="text" class="mt-2 block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" placeholder="What goal is this persona trying to accomplish?" name="goal_3" id="goal_3" onChange="updatePreview()"></input>
                                
                                <div class="mt-6">
                                <label class="text-gray-500 font-semibold">Frustrations</label>
                                <input type="text" class="mt-2 block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" placeholder="What things frustrate this persona?" name="frustrate_1" id="frustrate_1" onChange="updatePreview()"></input>
                                <input type="text" class="mt-2 block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" placeholder="What things frustrate this persona?" name="frustrate_2" id="frustrate_2" onChange="updatePreview()"></input>
                                <input type="text" class="mt-2 block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" placeholder="What things frustrate this persona?" name="frustrate_3" id="frustrate_3" onChange="updatePreview()"></input>
                                </div>
                                <p class="text-lg mt-16 font-bold text-black">More context</p>
                                <div class="mt-5">
                              <label class="text-gray-500 font-semibold">Extra information</label>
                              <textarea class="mt-2 block w-full rounded-md border-0 py-2 px-2 h-[80px] text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" placeholder="Anything else that is important to know about this persona." name="extra_information" id="extra_information" onChange="updatePreview()"></textarea>
                              <input type="hidden" name="color" id="color" value="<?php echo $theColor = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6); ?>">
                              </div>
                              </div>
                              
                              <div class="pt-4 mt-10 border-t">
                                  <div class="justify-between flex">
                                      <a class="text-gray-600 font-semibold rounded px-4 py-2 bg-gray-100 hover:bg-gray-200" href="/">Cancel</a>
                                      
                                      <input id="save-buyer" name="save-buyer" type="submit" class="cursor-pointer text-white font-semibold rounded px-4 py-2 <?php echo $bg ?> hover:<?php echo $bgHover ?>" value="Save Persona"></input>
                                  </div>
                              </div>
                          </form>
                          </div>
                          
                          <div class="pb-12 bg-slate-100 sm:w-[40%] border-t">
                              <p class="text-gray-500 font-medium pb-2 border-b mt-2 text-center">Persona Preview</p>
                              <div class="top-[20px] sticky pb-6 ml-4 mr-4 mt-8 h-[auto] ring-1 ring-gray-900/5 rounded-md shadow-sm bg-white gap-x-6">
   <div class="pb-3 pt-4 border-b items-center gap-3 flex">
       <div class="pl-6">
       <i id="product-icon" style="background-color: <?php echo $theColor ?>;" class="rounded-lg w-[50px] h-[50px] p-3 text-white" data-feather="user"></i>
       </div>
       <div class="block">
          <div id="preview_name" class="capitalize font-bold">N/A</div>
          <div id="preview_job" class="text-gray-400">N/A</div>
       </div>
   </div>
   <div class="pl-6 pr-6 grid grid-cols-2 gap-4 mt-4 min-w-0">
      <div>
        <p class="text-sm text-gray-500 font-semibold">Gender</p>
        <p id="preview_gender" class="capitalize text-black font-semibold">Male</p>
      </div>
      <div>
        <p class="text-sm text-gray-500 font-semibold">Age</p>
        <p id="preview_age" class="text-black font-semibold">0</p>
      </div>
      <div>
        <p class="text-sm text-gray-500 font-semibold">Education level</p>
        <p id="preview_education" class="text-black font-semibold">N/A</p>
      </div>
      <div>
        <p class="text-sm text-gray-500 font-semibold">Family status</p>
        <p id="preview_family" class="text-black font-semibold">N/A</p>
      </div>
   </div>
   <div class="mt-4 pl-6 pr-6">
        <p class="text-sm text-gray-500 font-semibold">Responsibilities</p>
        <p id="preview_responsibilities" class="text-black font-semibold">N/A</p>
   </div>
   <div class="mt-4 pl-6 pr-6">
        <p class="text-sm text-gray-500 font-semibold">Purchase habits</p>
        <p id="preview_habits" class="text-black font-semibold">N/A</p>
   </div>
   <div class="mt-4 pl-6 pr-6">
        <p class="text-sm text-gray-500 font-semibold">Purchase motiviation</p>
        <p id="preview_purchase" class="text-black font-semibold">N/A</p>
   </div>
   <div class="mt-4 pl-6 pr-6">
        <p class="text-sm text-gray-500 font-semibold">Communication preferences</p>
        <p id="preview_communication" class="capitalize text-black font-semibold">N/A</p>
   </div>
   <div class="mt-4 pl-6 pr-6">
        <p class="mb-1 text-sm text-gray-500 font-semibold">Goals</p>
        <p id="preview_goal1" class="mr-1 rounded-sm p-1 inline-block text-blue-400 bg-blue-100 font-semibold">N/A</p>
        <p id="preview_goal2" class="mr-1 rounded-sm p-1 inline-block text-blue-400 bg-blue-100 font-semibold"></p>
        <p id="preview_goal3" class="mr-1 rounded-sm p-1 inline-block text-blue-400 bg-blue-100 font-semibold"></p>
   </div>
   <div class="mt-4 pl-6 pr-6">
        <p class="mb-1 text-sm text-gray-500 font-semibold">Frustrations</p>
        <p id="preview_frustrate_1" class="mr-1 rounded-sm p-1 inline-block text-blue-400 bg-blue-100 font-semibold">N/A</p>
        <p id="preview_frustrate_2" class="mr-1 rounded-sm p-1 inline-block text-blue-400 bg-blue-100 font-semibold"></p>
        <p id="preview_frustrate_3" class="mr-1 rounded-sm p-1 inline-block text-blue-400 bg-blue-100 font-semibold"></p>
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
        document.getElementById("preview_name").innerHTML = document.getElementById("name").value;
        document.getElementById("preview_job").innerHTML = document.getElementById("job_title").value;
        document.getElementById("preview_age").innerHTML = document.getElementById("age").value;
        document.getElementById("preview_education").innerHTML = document.getElementById("education").value;
        document.getElementById("preview_family").innerHTML = document.getElementById("family_status").value;
        document.getElementById("preview_responsibilities").innerHTML = document.getElementById("responsibilities").value;
        document.getElementById("preview_habits").innerHTML = document.getElementById("purchase_habits").value;
        document.getElementById("preview_purchase").innerHTML = document.getElementById("purchase_motiviation").value;
        document.getElementById("preview_communication").innerHTML = document.getElementById("communication").value;
        document.getElementById("preview_goal1").innerHTML = document.getElementById("goal_1").value;
        document.getElementById("preview_goal2").innerHTML = document.getElementById("goal_2").value;
        document.getElementById("preview_goal3").innerHTML = document.getElementById("goal_3").value;
        document.getElementById("preview_frustrate_1").innerHTML = document.getElementById("frustrate_1").value;
        document.getElementById("preview_frustrate_2").innerHTML = document.getElementById("frustrate_2").value;
        document.getElementById("preview_frustrate_3").innerHTML = document.getElementById("frustrate_3").value;
      }
      
      function male() {
         document.getElementById("preview_gender").innerHTML = "Male";
      }
      
      function female() {
         document.getElementById("preview_gender").innerHTML = "Female";
      }
      </script>
   </body>
</html>