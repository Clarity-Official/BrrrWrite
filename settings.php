<?php
include ("functions/init.php");

include("config.php");

if (logged_in()) {
    
} else {
    header("Location: /signin");
}
?>

<?php
if (isset($_POST["update-email"])) {
$new_email = $_POST["email"];

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE users SET email='$new_email' WHERE id='$id'";

if($new_email == $email) {
 
} else {
 if ($conn->query($sql) === TRUE) {
session_destroy();

if (isset($_COOKIE['email'])) {

    unset($_COOKIE['email']);

    setcookie('email', '', time() - 86400);
    }

    header("Location: $appURL");
    }  
  }
}
?>

<?php
if (isset($_POST["update-password"])) {
$new_password = $_POST["new-password"];

$confirm_password = $_POST["confirm-password"];

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($new_password == "") {
  $new_password = $userpassword;
} else {
if($confirm_password == $new_password) {
  $thenewpassword = md5($new_password);
  $cookie_name = "isconfirmed";
  $cookie_value = "Yes";
  setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
  $passwordlogout = "Yes";
  $sql = "UPDATE users SET password='$thenewpassword' WHERE id='$id'";
} else {
  $cookie_name = "isconfirmed";
  $cookie_value = "No";
  setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
  $newpassword = $userpassword;
  echo "<div class='text-center	text-white py-2 font-bold bg-sky-400'>Password is not the same!</div>";
  }
}

if($new_password == $userpassword) {
 
} else {
 if ($conn->query($sql) === TRUE) {
session_destroy();

if (isset($_COOKIE['email'])) {

    unset($_COOKIE['email']);

    setcookie('email', '', time() - 86400);
}

    header("Location: $appURL");
    }  
  }
}
?>

<?php
if(isset($_POST['update-billing'])) {
$thedate = date('Y-m-d');
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE users SET paid='yes', billingdate='$thedate', credits='200' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
  header("Refresh:0");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
}    
?>

<html lang="en" class="h-full">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Settings - <?php echo $siteName ?></title>
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
   </head>
   <body class="h-full font-sans antialiased">
         <div class="flex flex-col items-stretch min-w-0">
            <?php include 'sidebar.php' ?>
            <div class="sm:ml-72 flex-1 flex flex-col items-stretch min-h-0 pt-4">
               <header class="flex-shrink-0">
                  <div class="mx-auto max-w-7xl md:flex md:items-center md:justify-between">
                     <div class="min-w-0 flex-1">
                        <h1 class="sm:pl-8 pl-5 pb-4 border-b text-xl font-bold leading-tight tracking-tight text-gray-800 sm:truncate">Settings</h1>
                     </div>
                  </div>
               </header>
               <main class="flex-1">
                  <div class="min-h-full mx-auto max-w-7xl py-8 sm:px-6 lg:px-8">
                     <div class="space-y-10 divide-y divide-gray-900/10">
                        <form action="/account" method="post" class="space-y-10 divide-y divide-gray-900/10">
                           <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
                              <div class="px-4 sm:px-0">
                                 <h2 class="text-base font-semibold leading-7 text-gray-900">Profile Information</h2>
                                 <div class="mt-1 text-base leading-6 text-gray-600">
                                    <p>Update your account's profile information and email address.</p>
                                 </div>
                              </div>
                              <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
                                 <div class="px-4 py-6 sm:p-8">
                                    <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                       <div class="col-span-full">
                                          <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email Address</label>
                                          <div class="mt-2">
                                             <input id="email" type="email" name="email" autocomplete="name" placeholder="<?php echo $email ?>" value="<?php echo $email ?>" required="" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" aria-describedby="email-description">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                                    <button type="submit" name="update-email" class="mr-auto rounded-md <?php echo $bg ?> px-3 py-2 text-sm font-semibold text-white shadow-sm hover:<?php echo $bgHover ?> focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-800">Save</button>
                                 </div>
                              </div>
                           </div>
                        </form>
                        <form action="/account" method="post" class="space-y-10 divide-y divide-gray-900/10 pt-10">
                           <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
                              <div class="px-4 sm:px-0">
                                 <h2 class="text-base font-semibold leading-7 text-gray-900">Update Password</h2>
                                 <div class="mt-1 text-base leading-6 text-gray-600">
                                    <p>Ensure your account is using a long, random password to stay secure.</p>
                                 </div>
                              </div>
                              <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
                                 <div class="px-4 py-6 sm:p-8">
                                    <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                       <div class="col-span-full">
                                          <label for="password" class="block text-sm font-medium leading-6 text-gray-900">New Password</label>
                                          <div class="mt-2">
                                             <input id="password" type="password" name="new-password" autocomplete="new-password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" aria-describedby="password-description" placeholder="Enter a new password">
                                          </div>
                                       </div>
                                       <div class="col-span-full">
                                          <label for="confirm_password" class="block text-sm font-medium leading-6 text-gray-900">Confirm New Password</label>
                                          <div class="mt-2">
                                             <input id="confirm_password" type="password" name="confirm-password" autocomplete="new-password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" aria-describedby="confirm_password" placeholder="Confirm your new password">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                                    <button type="submit" name="update-password" class="mr-auto rounded-md <?php echo $bg ?> px-3 py-2 text-sm font-semibold text-white shadow-sm hover:<?php echo $bgHover ?> focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-800">Save</button>
                                 </div>
                              </div>
                           </div>
                        </form>
                        <section id="billing">
                        <form id="billing-form" action="/account" method="post" class="space-y-10 divide-y divide-gray-900/10 pt-10">
                           <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
                              <div class="px-4 sm:px-0">
                                 <h2 class="text-base font-semibold leading-7 text-gray-900">Manage Billing</h2>
                                 <div class="mt-1 text-base leading-6 text-gray-600">
                                    <p>Manage your subscription & update your billing information.</p>
                                 </div>
                              </div>
                              <div style="<?php if ($paid == "yes") { echo "display: none"; } else { } ?>" class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
                                 <div class="px-4 py-6 sm:p-8">
                                    <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                       <div class="col-span-full">
                                          <label class="block text-md font-bold leading-6 text-gray-900">Trial Info</label>
                                          <div class="mt-2">
                                             <p class="text-base leading-6 text-gray-600">Your free trial <?php $today = date('m-d-Y'); $todayreplace = str_replace('-', '', $today); $enddatereplace = str_replace('-', '', $trialenddate); if(strtotime($today) > strtotime($trialenddate)) {
                                                 echo "ended on ";
                                             } else {
                                                 echo "ends on ";   
                                             }
                                             ?><?php echo $trialenddate ?></p>
                                          </div>
                                       </div>
                                       <div class="col-span-full">
                                          <label class="mb-2 block text-base font-medium leading-6 text-gray-900"><?php $today = date('m-d-Y'); $todayreplace = str_replace('-', '', $today); $enddatereplace = str_replace('-', '', $trialenddate); if(strtotime($today) > strtotime($trialenddate)) {
                                              echo "Add a card to continue using $siteName";
                                          } else {
                                              echo "Add a card before your trial expiration date to continue using $siteName.";   
                                          }
                                          ?></label>
                                          <div class="mt-2">
                                            <div class="card-info">
                                             <div style="padding: 10px; width: 370px;" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6" id="card-element">
                                                 </div>
                                            </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                                    <button type="submit" name="update-billing" class="mr-auto rounded-md <?php echo $bg ?> px-3 py-2 text-sm font-semibold text-white shadow-sm hover:<?php echo $bgHover ?> focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-800">Save</button>
                                 </div>
                              </div>
                              <div style="<?php if ($paid == "yes") { } else { echo "display: none"; } ?>" class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
                                 <div class="px-4 py-6 sm:p-8">
                                    <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                       <div class="col-span-full">
                                          <label class="block text-md font-bold leading-6 text-gray-900">Subscription Info</label>
                                          <div class="mt-2">
                                             <p class="text-base leading-6 text-gray-600">Your next payment date is <?php echo date('m-d',strtotime('+30 days',strtotime($billingdate))) ?>-<?php echo date("Y"); ?></p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </form>
                        </section>
                     </div>
                  </div>
               </main>
            </div>
         </div>
      </div>
      <script src="https://js.stripe.com/v3/"></script>
      <script>
var stripe = Stripe('');

var elements = stripe.elements();

var style = {
  base: {
    color: '#262627',
    fontFamily: 'Cerebrisans, sans-serif',
    fontSize: '15px',
    '::placeholder': {
      color: '#999999'
    }
  },
  invalid: {
    color: '#EA4545',
    iconColor: '#EA4545'
  }
};

var card = elements.create('card', {style: style});

card.mount('#card-element');

card.on('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      stripeTokenHandler(result.token);
    }
  });
});

function stripeTokenHandler(token) {
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  form.submit();
}
</script>
   </body>
</html>