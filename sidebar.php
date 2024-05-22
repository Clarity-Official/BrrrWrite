<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

<button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="w-[40px] inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
   <span class="sr-only">Open sidebar</span>
   <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
   <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
   </svg>
</button>

<aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-72 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="border-r h-full px-4 py-4 overflow-y-auto bg-gray-50">
      <ul class="space-y-2 font-medium">
      <a class="hover:opacity-85" href="/"><img class="mb-8 w-8" src="/assets/images/icon-blue.svg"></a>
        <a href="/craft" class="gap-2 flex justify-center mb-20 block rounded-md w-full p-2 text-center font-bold text-white <?php echo $bg ?> hover:<?php echo $bgHover ?>"><i data-feather="mail"></i>Start Crafting</a>
         <li class="pt-4">
            <a href="/" class="<?php if ($_SERVER['REQUEST_URI'] == "/") { echo $textColor; } elseif ($_SERVER['REQUEST_URI'] == "/new/offer") { echo $textColor; } else { echo "text-gray-700"; } ?> flex items-center pt-2 pb-2 pr-2 rounded-md hover:bg-gray-100 hover:<?php echo $textColor ?> group">
               <i data-feather="gift"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">Offers</span>
            </a>
         </li>
         <li>
            <a href="/customers" class="<?php if ($_SERVER['REQUEST_URI'] == "/customers") { echo $textColor; } else if($_SERVER['REQUEST_URI'] == "/new/customer") { echo $textColor; } else { echo "text-gray-700"; } ?> flex items-center pt-2 pb-2 pr-2 rounded-md hover:bg-gray-100 hover:<?php echo $textColor ?> group">
               <i data-feather="briefcase"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">Ideal Customer Profiles</span>
            </a>
         </li>
         <li>
            <a href="/buyers" class="<?php if ($_SERVER['REQUEST_URI'] == "/buyers") { echo $textColor; } else if ($_SERVER['REQUEST_URI'] == "/new/buyer") { echo $textColor; } else { echo "text-gray-700"; } ?> flex items-center pt-2 pb-2 pr-2 rounded-md hover:bg-gray-100 hover:<?php echo $textColor ?> group">
               <i data-feather="users"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">Buyer Personas</span>
            </a>
         </li>
         <li>
            <a href="/settings" class="<?php if ($_SERVER['REQUEST_URI'] == "/settings") { echo $textColor; } else { echo "text-gray-700"; } ?> flex items-center pt-2 pb-2 pr-2 text-gray-700 rounded-md hover:bg-gray-100 hover:<?php echo $textColor ?> group">
               <i data-feather="settings"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">Settings</span>
            </a>
         </li>
      </ul>
      <div class="w-[255px] bottom-24 absolute">
       <div class="justify-between flex">
         <p class="text-gray-500 font-medium">Credits remaining</p>
         <p class="font-bold"><span id="credits"><?php echo $credits ?></span>/100</p>
       </div>
       <div class="mt-3 h-2.5 bg-gray-200 w-full rounded"><div class="mt-3 h-2.5 <?php if($credits <= 40) { echo "bg-red-500"; } else { echo $bg; } ?> w-[<?php echo $credits ?>%] rounded"></div></div>
      </div>
     </div>
   <div class="items-center justify-between flex w-full border-t pt-5 pb-5 bottom-0 absolute">
          <p class="font-medium text-gray-700 pl-5 pr-2"><?php echo $email ?></p>
          <a class="pr-5" href="/logout"><i class="text-gray-700 size-5" data-feather="log-out"></i></a>
   </div>
</aside>

<script>
  feather.replace();
</script>