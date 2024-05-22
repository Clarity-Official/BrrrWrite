<?php
include ("functions/init.php");

include("config.php");

if (logged_in()) {
    
} else {
    header("Location: /signin");
}
?>

<html lang="en" class="h-full">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Craft Cold Email - <?php echo $siteName ?></title>
      <!-- Meta Tags -->
      <?php include 'meta.php' ?>
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
            <?php include 'trial-bar.php' ?>
            <?php include 'sidebar.php' ?>
            <?php include 'billing-include.php' ?>
            <div class="sm:ml-72 flex-1 flex flex-col items-stretch min-h-0 pt-4">
               <header class="flex-shrink-0">
                  <div class="mx-auto max-w-7xl md:flex md:items-center md:justify-between">
                     <div class="min-w-0 flex-1">
                        <div class="sm:pl-7 pl-5 pb-4 border-b gap-3 items-center flex">
                            <div onClick="history.back()" class="cursor-pointer rounded p-1 bg-gray-100"><i class="size-4" data-feather="arrow-left"></i></div>
                            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-800 sm:truncate">Craft Cold Email</h1>
                        </div>
                     </div>
                  </div>
               </header>
               <main class="flex-1">
                  <div>
                      <div class="justify-between sm:flex">
                          <div class="pt-8 pl-6 pr-6 sm:pl-8 sm:pr-8 border-r sm:w-[50%]">
                          <form id="craftForm" action="/aiGenerate" method="POST">
                              <p class="text-lg font-bold text-black">Target Customer</p>
                              <div class="mt-5">
                              <label class="text-gray-500 font-semibold">Offer</label>
                              <select required class="mt-2 block w-full rounded-md border-0 px-3 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" name="offer" id="offer">
  <option disabled selected value="">What offer are you promoting?</option>
  <?php
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM offers WHERE user='$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "<option value='$row[id]'>$row[name] - $row[description]</option>";
  }
} else {
  echo "<option value=''>0 results</option>";
}
$conn->close();
?>
</select>
                              </div>
                              <div class="mt-6">
                              <label class="text-gray-500 font-semibold">Ideal Customer Profile</label>
                              <select required class="mt-2 block w-full rounded-md border-0 px-3 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" name="customer" id="customer">
  <option disabled selected value="">Which ideal customer profiles are you promoting to?</option>
  <?php
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM customers WHERE user='$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "<option value='$row[id]'>$row[industry]</option>";
  }
} else {
  echo "<option value=''>0 results</option>";
}
$conn->close();
?>
</select>
                              </div>
                              <div class="mt-6">
                              <label class="text-gray-500 font-semibold">Personas</label>
                              <select required class="mt-2 block w-full rounded-md border-0 px-3 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" name="buyer" id="buyer">
  <option disabled selected value="">Which personas are you promoting to?</option>
  <?php
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM buyers WHERE user='$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "<option value='$row[id]'>$row[name] - $row[job_title]</option>";
  }
} else {
  echo "<option value=''>0 results</option>";
}
$conn->close();
?>
</select>
                              </div>
                              <p class="text-lg mt-16 font-bold text-black">Messaging</p>
                              <div class="mt-5">
                              <label class="text-gray-500 font-semibold">Objective</label>
                              <select class="mt-2 block w-full rounded-md border-0 px-3 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" name="objective" id="objective">
                                    <option value="join-sales-call">&#128222; Join sales call</option>
                                    <option value="visit-website">&#128187; Visit website</option>
                                    <option value="install-app">&#128242; Install App</option>
                                    <option value="buy-physical-item">&#128230; Buy physical item</option>
                                    <option value="gauge-intrest">&#129522; Gauge intrest</option>
                                    <option value="promote-event">&#129395; Promote Event</option>
                                    <option value="get-a-job">&#128188; Get a job</option>
                                    <option value="join-newsletter">&#128240; Join Newsletter</option>
                               </select>
                              </div>
                              <div class="mt-6">
                              <label class="text-gray-500 font-semibold">Tone</label>
                              <select class="mt-2 block w-full rounded-md border-0 px-3 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" name="tone" id="tone">
                                    <option value="friendly">&#128522; Friendly</option>
                                    <option value="urgent">&#8987; Urgent</option>
                                    <option value="relaxed">&#128524; Relaxed</option>
                                    <option value="professional">&#128188; Professional</option>
                                    <option value="bold">&#128170; Bold</option>
                                    <option value="adventurous">&#9978; Adventurous</option>
                                    <option value="witty">&#128161; Witty</option>
                                    <option value="persuasive">&#129504; Persuasive</option>
                               </select>
                              </div>
                              
                              <p class="text-lg mt-16 font-bold text-black">Vision</p>
                              <div class="mt-5">
                              <label class="text-gray-500 font-semibold">Help factor</label>
                              <textarea class="mt-2 block w-full rounded-md border-0 py-2 px-2 h-[80px] text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" placeholder="How does your product, service or software help?" name="help_factor" id="help_factor"></textarea>
                              </div>
                              <div class="mt-6">
                              <label class="text-gray-500 font-semibold">Goal factor</label>
                              <textarea class="mt-2 block w-full rounded-md border-0 py-2 px-2 h-[80px] text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" placeholder="How does your solution fit the ICP and personas current goals?" name="goal_factor" id="goal_factor"></textarea>
                              </div>
                              <div class="mt-6">
                              <label class="text-gray-500 font-semibold">Competitor differences</label>
                              <textarea class="mt-2 block w-full rounded-md border-0 py-2 px-2 h-[80px] text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" placeholder="What competitor differentiates you from your competitors?" name="competitor_differences" id="competitor_differences"></textarea>
                              </div>
                              
                              <p class="text-lg mt-16 font-bold text-black">Confidence</p>
                              <div class="mt-5">
                              <label class="text-gray-500 font-semibold">Social Proof</label>
                              <input class="mt-2 block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" type="text" placeholder="What social proofs would motivate these customers?" name="social_proof" id="social_proof">
                              </div>
                              
                              <div class="mt-6">
                              <label class="text-gray-500 font-semibold">Accolades</label>
                              <input class="mt-2 block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" type="text" placeholder="What sort of accolades are worth mentioning to these customers?" name="accolades" id="accolades">
                              </div>
                              
                              <p class="text-lg mt-16 font-bold text-black">More Context</p>
                              <div class="mt-5">
                              <label class="text-gray-500 font-semibold">Extra information</label>
                              <textarea class="mt-2 block w-full rounded-md border-0 py-2 px-2 h-[80px] text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" placeholder="Anything else that is important to know about this persona." name="extra_information" id="extra_information"></textarea>
                              </div>
                              
                              <div class="pt-4 mt-10 border-t">
                                  <div class="justify-between flex">
                                      <div class="items-center flex">
                                          <p class="font-medium text-gray-500">💎 Cost:&nbsp;</p>
                                          <p class="font-medium text-gray-500">2 credits</p>
                                      </div>
                                      
                                      <input type="submit" id="generate-btn" class="gap-2 flex cursor-pointer text-white font-semibold rounded px-4 py-2 <?php echo $bg ?> hover:<?php echo $bgHover ?>" value="Generate Email"></input>
                                      
                                      <button disabled id="generating-btn" type="submit" class="hidden gap-2 flex cursor-pointer text-white font-semibold rounded px-3 py-2 <?php echo $bg ?> hover:<?php echo $bgHover ?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
     stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
    <circle cx="12" cy="12" r="10" stroke-dasharray="63" stroke-dashoffset="21">
        <animateTransform attributeName="transform" type="rotate" from="0 12 12" to="360 12 12" dur="2s"
                          repeatCount="indefinite"/>
        <animate attributeName="stroke-dashoffset" dur="8s" repeatCount="indefinite" keyTimes="0; 0.5; 1"
                 values="-16; -47; -16" calcMode="spline" keySplines="0.4 0 0.2 1; 0.4 0 0.2 1"/>
    </circle>
</svg> Generating...</button>
                                  </div>
                              </div>
                          </form>
                          </div>
                          
                          <div class="pb-12 bg-slate-100 sm:w-[50%] border-t">
                              <p class="text-gray-500 font-medium pb-2 border-b mt-2 text-center">Cold Email Preview</p>
                              <div id="empty-state" class="top-[20px] sticky ml-4 mr-4 mt-8 ring-1 ring-gray-900/5 rounded-md shadow-sm bg-white relative gap-x-6">
   <div class="pb-3 pt-3 items-center gap-3 justify-center flex">
    <div id="preview_name" class="pl-2 pr-2 text-gray-600 text-center font-medium">Answer the prompts on your left and then click "Generate Email".</div>
   </div>
</div>

<div id="email" class="top-[20px] sticky hidden pt-6 pb-6 ml-4 mr-4 mt-8 ring-1 ring-gray-900/5 rounded-md shadow-sm bg-white relative gap-x-6">
   <div class="pl-6 pr-6">
       <p id="email-content" class="mt-[-170px;] whitespace-pre-line text-gray-600"></p>
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
      <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
      <script>
      $("#craftForm").submit(function(e) {
      document.getElementById("generate-btn").style.display = "none";
      document.getElementById("generating-btn").style.display = "flex";
      e.preventDefault();

      var form = $(this);
      var actionUrl = form.attr('action');
    
      $.ajax({
        type: "POST",
        url: actionUrl,
        data: form.serialize(),
        success: function(data)
        {
          document.getElementById("generating-btn").style.display = "none";
          document.getElementById("generate-btn").style.display = "block";
          document.getElementById("empty-state").style.display = "none";
          document.getElementById("email").style.display = "block";
          document.getElementById("email-content").innerHTML = data;
          var newCredits = document.getElementById("credits").innerText - 2;
          document.getElementById("credits").innerText = newCredits;
          scroll(0,0)
        }
    });
    
});
      </script>
   </body>
</html>