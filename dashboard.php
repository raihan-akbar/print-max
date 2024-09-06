<?php
session_start();

if (!isset($_SESSION['auth'])) {
   session_destroy();
   header("Location: signin.php?error=3");
}

// add item start
include_once 'conn.php';

if (isset($_POST['add-item'])) {
   if (!isset($_POST['name'], $_POST['price'], $_POST['description'])) {
      header("Location: product.php?i=2");
   } else if (isset($_POST['name'], $_POST['price'], $_POST['description'])) {
      $name = $_POST['name'];
      $price = $_POST['price'];
      $description = $_POST['description'];
      $thumbnails = $_FILES["thumbnails"]["name"];
      if ($description == null) {
         $description = $name;
      }
      if ($thumbnails == null) {
         $rename = 'default.jpg';
      } else {
         $allowed_ext = array("jpg", "png", "jpeg", "gif");
         $ext = explode(".", $_FILES['thumbnails']['name']);
         $end = end($ext);
         $rename = random_int(100, 999) . round(microtime(true) * 9) . random_int(100, 999) . "." . $end;
         move_uploaded_file($_FILES["thumbnails"]["tmp_name"], "assets/img/item/" . $rename);
      }

      $insert_query = "INSERT INTO `product` VALUES (NULL, '$name', '$rename', '$description', '$price')";

      $execute = mysqli_query($con, $insert_query);
      if ($execute) {
         header("Location: product.php?i=1");
      } else {
         header("Location: product.php?i=0");
      }
   } else {
      header("Location: product.php?i=2");
   }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>PrintMax | Dashboard</title>
   <link rel="icon" href="assets/img/system/sq-logo.png">
   <script src="https://cdn.tailwindcss.com"></script>
   <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
   <link href="assets/css/custom.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="bg-slate-100">

   <?php include '_navside.php' ?>

   <div class="p-4 sm:ml-64">
      <div class="p-4 mt-12">

         <!-- Content Start Here -->
         <div class="w-full">
            <h2 class="text-neutral-800 font-bold text-3xl">
               Dashboard
            </h2>
            <p class="text-neutral-700 font-medium">You can Monitoring All of your Stuff in this page.</p>
            <hr class="w-full bg-blue-950 rounded mt-4">
         </div>

         <div class="w-full mt-4">
            <div class="columns-1 md:columns-2 lg:columns-4 gap-4">
               <div class="p-4 bg-purple-600 text-neutral-100 font-semibold text-lg rounded-lg mb-2 border-neutral-300 border shadow-xl">
                  <p><i class="fa fa-cubes text-sm"></i> Today Orders : 4</p>
               </div>
               <div class="p-4 bg-green-600 text-neutral-100 font-semibold text-lg rounded-lg mb-2 border-neutral-300 border shadow-xl">
                  <p><i class="fa fa-check text-sm"></i> Finished : 4</p>
               </div>
               <div class="p-4 bg-yellow-600 text-neutral-100 font-semibold text-lg rounded-lg mb-2 border-neutral-300 border shadow-xl">
                  <p><i class="fa fa-times text-sm"></i> Cancelled : 4</p>
               </div>
               <div class="p-4 bg-blue-600 text-neutral-100 font-semibold text-lg rounded-lg mb-2 border-neutral-300 border shadow-xl">
                  <p><i class="fa fa-gears text-sm"></i> On Progress : 4</p>
               </div>
            </div>
         </div>

         <div class="w-full mt-4">
            <div class="flex flex-wrap">
               <div class="w-full lg:w-3/6 max-h-96 pr-0 lg:pr-2">
                  <div class="w-full p-4 bg-neutral-50 border border-neutral-300 rounded-lg shadow-xl sm:p-8">
                     <div class="flex items-center justify-between mb-4">
                        <h5 class="text-xl font-bold leading-none text-pink-600"><i class="fa fa-bullseye animate-pulse text-lg text-pink-600"></i> Pending Orders</h5>
                        <p class="text-sm font-medium text-neutral-600 hover:underline">
                           8
                        </p>
                     </div>
                     <div class="flow-root">
                        <ul role="list" class="divide-y divide-neutral-200 h-screen max-h-96 overflow-y-scroll pr-4">
                           <?php for ($i = 1; $i <= 8; $i++) { ?>
                              <li class="py-3 sm:py-4">
                                 <div class="flex items-center">
                                    <div class="flex-1 min-w-0">
                                       <p class="text-lg font-medium text-neutral-900 truncate">
                                          Neil Sims - <?= $i ?>, August
                                       </p>
                                       <p class="text-md text-neutral-500 truncate">
                                          <span>(8x)</span>
                                          <span>Sticker</span>
                                          <span>Vinyl</span>
                                          <span>A4</span>
                                          <span>A4</span>
                                       </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-neutral-900 space-x-1">
                                       <button class="p-1.5 text-sm bg-yellow-600 hover:bg-yellow-700 text-neutral-100 rounded-md">Cancel</button>
                                       <button class="p-1.5 text-sm bg-blue-600 hover:bg-blue-700 text-neutral-100 rounded-md">Accept</button>
                                    </div>
                                 </div>
                              </li>
                           <?php } ?>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="w-full lg:w-3/6 max-h-96 pl-0 lg:pl-2 py-32 lg:py-0">
                  <div class="w-full p-4 bg-neutral-50 border border-neutral-300 rounded-lg shadow-xl sm:p-8">
                     <div class="flex items-center justify-between mb-4">
                        <h5 class="text-xl font-bold leading-none text-blue-600"><i class="fa fa-clock animate-spin text-lg text-blue-600"></i> On-Progress Orders</h5>
                        <p class="text-sm font-medium text-neutral-600 hover:underline">
                           8
                        </p>
                     </div>
                     <div class="flow-root">
                        <ul role="list" class="divide-y divide-neutral-200 h-screen max-h-96 overflow-y-scroll pr-4">
                           <?php for ($i = 1; $i <= 8; $i++) { ?>
                              <li class="py-3 sm:py-4">
                                 <div class="flex items-center">
                                    <div class="flex-1 min-w-0">
                                       <p class="text-lg font-medium text-neutral-900 truncate">
                                          Neil Sims - <?= $i ?>, August
                                       </p>
                                       <p class="text-md text-neutral-500 truncate">
                                          <span>(8x)</span>
                                          <span>Sticker</span>
                                          <span>Vinyl</span>
                                          <span>A4</span>
                                          <span>A4</span>
                                       </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-neutral-900 space-x-1">
                                       <button class="p-1.5 text-sm bg-green-600 hover:bg-blue-700 text-neutral-100 rounded-md">Finish</button>
                                    </div>
                                 </div>
                              </li>
                           <?php } ?>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>

      </div>
      <!-- Tables End -->
   </div>
   </div>


   <!-- Alert -->
   <?php
   if (isset($_GET['i'])) {
      if ($_GET['i'] == '1') {
         echo "<script> window.onload=function(){
                swal('Saved','New Item Successfully Saved', 'success')}</script>";
      } else if ($_GET['i'] == '2') {
         echo "<script> window.onload=function(){
                    swal('Saving Failed','Please fill all Data Form', 'warning')}</script>";
      } else {
         echo "<script> window.onload=function(){
                            swal('Error','Sorry Saving Failed Please Try Again', 'error')}</script>";
      }
   }
   ?>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
   <script>
      let x = document.querySelectorAll(".rp");
      for (let i = 0, len = x.length; i < len; i++) {
         let num = Number(x[i].innerHTML)
            .toLocaleString('id');
         x[i].innerHTML = num;
         x[i].classList.add("currSign");
      }
   </script>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>

</html>
