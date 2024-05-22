<?php
include ("functions/init.php");
include ("config.php");

if (logged_in()) {
    header("Location:/");
}
?>
<html lang="en" class="h-full">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Create a new account - <?php echo $siteName ?></title>
      <!-- Meta Tags -->
      <?php include 'meta.php' ?>
      <!-- Fonts -->
      <link rel="preconnect" href="https://fonts.bunny.net">
      <link href="https://fonts.bunny.net/css?family=inter:400,500,600" rel="stylesheet">
      <link href="https://fonts.bunny.net/css?family=figtree:700" rel="stylesheet">
      <style>
        #logo-link:hover {
           opacity: 80%;
        }
      </style>
      <!-- Scripts -->
      <link rel="stylesheet" href="/assets/css/style.css">
      <link rel="stylesheet" href="/assets/css/custom.css">
      <script src="https://cdn.tailwindcss.com"></script>
   </head>
   
   
   <body class="h-full font-sans antialiased">
       <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <a id="logo-link" href="<?php echo $landingURL ?>"><img class="mx-auto h-14 w-1/2" src="/assets/images/icon-blue.svg"></a>
    <h2 class="mt-4 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Create a new account</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-72 sm:max-w-sm">
    <?php display_message(); ?>
    <?php validate_user_registration(); ?>
    <form class="space-y-6" method="POST">
      <div>
        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
        <div class="mt-2">
          <input id="email" name="email" placeholder="john.doe@gmail.com" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
        </div>
        <div class="mt-2">
          <input id="password" name="password" placeholder="Enter a password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6">
        </div>
      </div>
      
      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Confirm Password</label>
        </div>
        <div class="mt-2">
          <input id="confirm_password" name="confirm_password" placeholder="Confirm your password" type="password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:<?php echo $focusRing ?> sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <button type="submit" class="flex w-full justify-center rounded-md <?php echo $bg ?> px-3 py-1.5 text-sm font-bold leading-6 text-white shadow-sm hover:<?php echo $bgHover ?> focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-900">Create account</button>
      </div>
    </form>

    <p class="mt-8 text-center text-sm text-gray-500">
      Already a user?
      <a href="/signin" class="font-semibold leading-6 <?php echo $textColor ?> hover:<?php echo $textDarkColor ?>">Sign in</a>
    </p>
  </div>
</div>
      </div>
   </body>
</html>