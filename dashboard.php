<?php
session_start();

if (!isset($_SESSION['auth'])) {
   session_destroy();
   header("Location: signin.php?error=3");
}

$role_name = $_SESSION['role_name'];

if ($role_name == 'root') {
   header("Location: user.php");

}

// add item start
include_once 'conn.php';
date_default_timezone_set('Asia/Jakarta');

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

$year = date('Y');
$month = date('m');

// Order Status // 1 = Finished // 2 = Progress // 3 = Cancelled // 4 = Pending

// Count Month All Order
$order = "SELECT * FROM `book` WHERE MONTH(book_date) = '$month' AND YEAR(book_date) = '$year';";
$order_query = mysqli_query($con, $order);
$count_order = mysqli_num_rows($order_query);

// Count Month Finished Order
$finished = "SELECT * FROM `book` WHERE MONTH(book_date) = '$month' AND YEAR(book_date) = '$year' AND status='1';";
$finished_query = mysqli_query($con, $finished);
$count_finished = mysqli_num_rows($finished_query);

// Count Month Canceled Order
$cancelled = "SELECT * FROM `book` WHERE MONTH(book_date) = '$month' AND YEAR(book_date) = '$year' AND status='3';";
$cancelled_query = mysqli_query($con, $cancelled);
$count_cancelled = mysqli_num_rows($cancelled_query);

// Count Month Progress Order
$progress = "SELECT * FROM `book` WHERE MONTH(book_date) = '$month' AND YEAR(book_date) = '$year' AND status='2';";
$progress_query = mysqli_query($con, $progress);
$count_progress = mysqli_num_rows($progress_query)


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
            <p class="pb-1 text-xs font-semibold text-right">* Insight Only for this <?= date('F') ?>.</p>
            <div class="columns-1 md:columns-2 lg:columns-4 gap-4">
               <div class="p-4 bg-purple-600 text-neutral-100 font-semibold text-lg rounded-lg mb-2 border-neutral-300 border shadow-xl">
                  <p><i class="fa fa-cubes text-sm"></i> Total Orders : <?= $count_order ?></p>
               </div>
               <div class="p-4 bg-green-600 text-neutral-100 font-semibold text-lg rounded-lg mb-2 border-neutral-300 border shadow-xl">
                  <p><i class="fa fa-check text-sm"></i> Finished : <?= $count_finished ?></p>
               </div>
               <div class="p-4 bg-yellow-600 text-neutral-100 font-semibold text-lg rounded-lg mb-2 border-neutral-300 border shadow-xl">
                  <p><i class="fa fa-times text-sm"></i> Cancelled : <?= $count_cancelled ?></p>
               </div>
               <div class="p-4 bg-blue-600 text-neutral-100 font-semibold text-lg rounded-lg mb-2 border-neutral-300 border shadow-xl">
                  <p><i class="fa fa-gears text-sm"></i> On Progress : <?= $count_progress ?></p>
               </div>
            </div>
         </div>

         <div class="w-full mt-4">
            <div class="flex flex-wrap">
               <div class="w-full lg:w-3/6 max-h-96 pr-0 lg:pr-2">
                  <div class="w-full p-4 bg-neutral-50 border border-neutral-300 rounded-lg shadow-xl sm:p-8">
                     <div class="flex items-center justify-between mb-4">
                        <h5 class="text-xl font-bold leading-none text-pink-600"><i class="fa fa-bullseye animate-pulse text-lg text-pink-600"></i> Pending Orders</h5>

                     </div>
                     <div class="flow-root">
                        <ul role="list" class="divide-y divide-neutral-200 h-screen max-h-96 overflow-y-scroll pr-4">
                           <?php
                           include_once 'conn.php';
                           $query = mysqli_query($con, "SELECT * FROM book WHERE status='4' ");
                           while ($book = mysqli_fetch_array($query)) { ?>
                              <form action="details_helper.php" method="post">
                                 <li class="py-3 sm:py-4">
                                    <div class="flex items-center">
                                       <div class="flex-1 min-w-0">
                                          <p class="text-lg font-bold text-neutral-900 truncate">
                                             <?= $book['book_by'] ?>
                                          </p>
                                          <p class="text-md text-neutral-500 truncate">
                                             <span>(<?= $book['qty'] ?>)</span>
                                             <span><?= $book['product_name'] ?></span>
                                             <span><?= $book['type'] ?></span>
                                             <span><?= $book['size'] ?></span>
                                          </p>
                                       </div>
                                       <div class="inline-flex items-center text-base font-semibold text-neutral-900 space-x-1">
                                          <input type="hidden" name="book_id" value="<?= $book['book_id'] ?>">
                                          <button type="submit" name="cancel-order" class="p-1.5 text-sm bg-yellow-600 hover:bg-yellow-700 text-neutral-100 rounded-md">Cancel</button>
                                          <button type="submit" name="progress-order" class="p-1.5 text-sm bg-blue-600 hover:bg-blue-700 text-neutral-100 rounded-md">Accept</button>
                                       </div>
                                    </div>
                                 </li>
                              </form>
                           <?php } ?>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="w-full lg:w-3/6 max-h-96 pl-0 lg:pl-2 py-32 lg:py-0">
                  <div class="w-full p-4 bg-neutral-50 border border-neutral-300 rounded-lg shadow-xl sm:p-8">
                     <div class="flex items-center justify-between mb-4">
                        <h5 class="text-xl font-bold leading-none text-blue-600"><i class="fa fa-clock animate-spin text-lg text-blue-600"></i> On-Progress Orders</h5>

                     </div>
                     <div class="flow-root">
                        <ul role="list" class="divide-y divide-neutral-200 h-screen max-h-96 overflow-y-scroll pr-4">
                           <?php
                           include_once 'conn.php';
                           $query = mysqli_query($con, "SELECT * FROM book WHERE status='2' ");
                           while ($book = mysqli_fetch_array($query)) { ?>
                              <form action="details_helper.php" method="post">
                                 <li class="py-3 sm:py-4">
                                    <div class="flex items-center">
                                       <div class="flex-1 min-w-0">
                                          <p class="text-lg font-bold text-neutral-900 truncate">
                                             <?= $book['book_by'] ?>
                                          </p>
                                          <p class="text-md text-neutral-500 truncate">
                                             <span>(<?= $book['qty'] ?>)</span>
                                             <span><?= $book['product_name'] ?></span>
                                             <span><?= $book['type'] ?></span>
                                             <span><?= $book['size'] ?></span>
                                          </p>
                                       </div>
                                       <div class="inline-flex items-center text-base font-semibold text-neutral-900 space-x-1">
                                          <input type="hidden" name="book_id" value="<?= $book['book_id'] ?>">
                                          <button type="submit" name="done-order" class="p-1.5 text-sm bg-green-600 hover:bg-blue-700 text-neutral-100 rounded-md">Finish</button>
                                       </div>
                                    </div>
                              </form>
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
