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

date_default_timezone_set('Asia/Jakarta');

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
               Order
            </h2>
            <p class="text-neutral-700 font-medium">You can Manage or Monitoring all your Order here.</p>
            <hr class="w-full bg-blue-950 rounded mt-4">
            <div class="columns-1 lg:columns-2">
               <div class="w-full pt-4 text-left">
                  <p class="font-medium text-md pb-1">Order Icons Condition Guide</p>
                  <span class="pr-4 font-medium text-sm">
                     <i class="fa fa-check-circle text-green-600 "></i>
                     is Done
                  </span>
                  <span class="pr-4 font-medium text-sm">
                     <i class="fa fa-clock animate-spin text-blue-600 "></i>
                     is on-Progress
                  </span>
                  <span class="pr-4 font-medium text-sm">
                     <i class="fa fa-times-circle text-yellow-600 "></i>
                     is Canceled
                  </span>
                  <span class="pr-4 font-medium text-sm">
                     <i class="fa fa-bullseye animate-pulse text-pink-600 "></i>
                     is Need Confirmation
                  </span>
                  <span class="pr-4 font-medium text-sm">
                     <i class="fa fa-times-circle text-red-600 "></i>
                     is Error ()
                  </span>
               </div>
               <div class="w-full pt-4 text-right">
                  <button class="w-full p-4 bg-blue-700 text-neutral-100 rounded-lg font-semibold text-md lg:w-fit" data-modal-target="add-order-modal" data-modal-toggle="add-order-modal">
                     Add Order
                     <i class="fa fa-plus text-sm"></i>
                  </button>
               </div>

            </div>
         </div>

         <!-- Add order modal -->
         <div id="add-order-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
               <!-- Modal content -->
               <div class="relative bg-white rounded-lg shadow">
                  <!-- Modal header -->
                  <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                     <h3 class="text-lg font-semibold text-neutral-900">
                        Add New Order
                     </h3>
                     <button type="button" class="text-neutral-400 bg-transparent hover:bg-neutral-200 hover:text-neutral-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="add-order-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                           <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                     </button>
                  </div>
                  <!-- Modal body -->
                  <form class="p-4 md:p-5" method="post" action="details_helper.php" enctype="multipart/form-data">
                     <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                           <label for="name" class="block mb-2 text-sm font-medium text-neutral-900">Nama Pemesan</label>
                           <input type="text" name="name" id="name" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Name" required="">
                        </div>
                        <div class="col-span-2">
                           <label for="product_name" class="block mb-2 text-sm font-medium text-neutral-900">Nama Item</label>
                           <select type="text" name="product_name" id="product_name" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type item name" required="">
                              <option value="" class="text-neutral-200"> -- Pilih Item</option>
                              <?php
                              $query = mysqli_query($con, "SELECT * FROM product ORDER BY product_id DESC ");
                              while ($product = mysqli_fetch_array($query)) { ?>
                                 <option value="<?= $product['product_name'] ?>" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-md font-semibold rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <?= $product['product_name'] ?>
                                 </option>
                              <?php } ?>
                           </select>
                        </div>
                        <div class="col-span-2 columns-2">
                           <div class="w-full">
                              <label for="size" class="block mb-2 text-sm font-medium text-neutral-900">Size</label>
                              <input type="text" name="size" id="size" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Size" required="">
                           </div>
                           <div class="w-full">
                              <label for="type" class="block mb-2 text-sm font-medium text-neutral-900">Type</label>
                              <input type="text" name="type" id="type" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type" required="">
                           </div>
                        </div>
                        <div class="col-span-2">
                           <label for="qty" class="block mb-2 text-sm font-medium text-neutral-900">Jumlah Pesanan</label>
                           <input type="number" name="qty" id="qty" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Jumlah Pesanan" required="">
                        </div>
                        <div class="col-span-2 w-full">
                           <label for="total" class="block mb-2 text-sm font-medium text-neutral-900">Item Price</label>
                           <div class="flex">
                              <span class="inline-flex items-center px-3 text-sm font-medium text-neutral-900 bg-neutral-200 border border-s-0 border-neutral-300 rounded-s-md uppercase">
                                 Rp.
                              </span>
                              <input type="text" min="0" name="total" id="quantity-input" data-input-counter data-input-counter-min="1" data-input-counter-max="9999999999" class="rounded-none rounded-e-lg bg-neutral-50 border border-neutral-300 text-neutral-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-md p-2.5 " placeholder="Total Price">
                           </div>
                        </div>

                     </div>
                     <div class="w-full">
                        <hr class="my-8">
                        <input type="hidden" name="book_date" value="<?= date('Y-m-d') ?>">
                     </div>
                     <div class="w-full">
                        <button type="submit" name="add-order" class="inline-flex w-full justify-center items-center px-3 py-2 text-md font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                           Add New Order
                           <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
                           </svg>

                        </button>
                        <button type="button" name="cancel" class="inline-flex w-full justify-center items-center mt-4 text-md font-medium text-center text-neutral-500 hover:text-neutral-800" data-modal-toggle="add-order-modal">
                           Cancel
                        </button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <!-- Modal End -->

         <!-- Tables Start -->
         <div class="w-full pt-4">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
               <table class="w-full text-sm text-left rtl:text-right text-neutral-500">
                  <thead class="text-xs text-neutral-700 uppercase bg-neutral-200">
                     <tr>
                        <th scope="col" class="px-6 py-3">
                           <i class="fa fa-question-circle text-xl text-neutral-600"></i>
                        </th>
                        <th scope="col" class="px-6 py-3">
                           Pemesan
                        </th>
                        <th scope="col" class="px-6 py-3">
                           Item

                        </th>
                        <th scope="col" class="px-6 py-3">
                           Ukuran

                        </th>
                        <th scope="col" class="px-6 py-3">
                           Tipe
                        </th>
                        <th scope="col" class="px-6 py-3">
                           Harga
                        </th>
                        <th scope="col" class="px-6 py-3">
                           Tanggal Order
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                           Change Status
                        </th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     include_once 'conn.php';
                     $query = mysqli_query($con, "SELECT * FROM book ORDER BY book_id DESC LIMIT 50");
                     while ($book = mysqli_fetch_array($query)) {
                        $status = $book['status'];
                        if ($status == '1') {
                           $book_status = 'Done';
                           $book_tooltip = 'Success';
                           $book_color = 'text-green-600';
                           $book_icon = 'fa fa-check-circle';
                        } else if ($status == '2') {
                           $book_status = 'On Progress';
                           $book_tooltip = 'Progress';
                           $book_color = 'text-blue-600';
                           $book_icon = 'fa fa-clock animate-spin';
                        } else if ($status == '3') {
                           $book_status = 'Canceled';
                           $book_Tooltip = 'Canceled!';
                           $book_color = 'text-yellow-600';
                           $book_icon = 'fa fa-times-circle';
                        } else if ($status == '4') {
                           $book_status = 'Pending';
                           $book_Tooltip = 'Waiting!';
                           $book_color = 'text-pink-600';
                           $book_icon = 'fa fa-bullseye animate-pulse';
                        } else {
                           $book_status = 'Error';
                           $book_Tooltip = 'Something Missing!';
                           $book_color = 'text-red-600';
                           $book_icon = 'fa fa-exclamation-circle';
                        }

                     ?>
                        <tr class="bg-white border-b hover:bg-neutral-50 text-neutral-900">
                           <th scope="row" class="px-6 py-4 font-medium text-neutral-900 whitespace-nowrap">
                              <i class="<?= $book_icon; ?> text-xl <?= $book_color; ?>"></i>
                           </th>
                           <th scope="row" class="px-6 py-4">
                              <?= $book['book_by'] ?>
                           </th>
                           <td class="px-6 py-4 font-medium text-md">
                              <?= $book['product_name'] ?> (<?= $book['qty'] ?>)
                           </td>
                           <td class="px-6 py-4 font-medium text-md">
                              <?= $book['size'] ?>
                           </td>
                           <td class="px-6 py-4 font-medium text-md">
                              <?= $book['type'] ?>
                           </td>
                           <td class="px-6 py-4 font-medium text-md rp">
                              <?= $book['total'] ?>
                           </td>
                           <td class="px-6 py-4 font-medium text-md">
                              <?php
                              $org_date = $book['book_date'];
                              $new_date = date("d, F Y", strtotime($org_date));
                              $book_id = $book['book_id'];
                              ?>
                              <?= $new_date; ?>
                           </td>
                           <td class="px-6 py-4 font-medium text-md text-center">
                              <button data-modal-target="con-modal-<?=$book_id;?>" data-modal-toggle="con-modal-<?=$book_id;?>" class="p-2 bg-green-800 text-neutral-100 rounded hover:bg-green-900">Options</button>

                              <!-- Modal Condition Start -->
                              <div id="con-modal-<?=$book_id;?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                 <div class="relative p-4 w-full max-w-2xl max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow">
                                       <!-- Modal header -->
                                       <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                          <h3 class="text-xl font-semibold text-neutral-900">
                                             Change Order Status
                                          </h3>
                                          <button type="button" class="text-neutral-400 bg-transparent hover:bg-neutral-200 hover:text-neutral-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="con-modal-<?=$book_id;?>">
                                             <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                             </svg>
                                             <span class="sr-only">Close modal</span>
                                          </button>
                                       </div>
                                       <!-- Modal body -->
                                       <form action="details_helper.php" method="post">
                                          <input type="hidden" name="book_id" value="<?= $book['book_id'] ?>">
                                          <div class="p-4 md:p-5">
                                             <button type="submit" name="done-order" class="w-full text-neutral-900 font-semibold rounded-lg text-md px-2 py-2.5 text-left inline-flex items-center me-2 mb-2 border border-green-600 hover:bg-green-200">
                                                <i class="text-lg fa fa-check-circle text-green-600 px-2"></i>
                                                <span class="font-light pr-2 pl-1 text-xl items-center text-neutral-400">|</span> Set Order to Done
                                             </button>
                                             <button type="submit" name="progress-order" class="w-full text-neutral-900 font-semibold rounded-lg text-md px-2 py-2.5 text-left inline-flex items-center me-2 mb-2 border border-blue-600 hover:bg-blue-200">
                                                <i class="text-lg fa fa-clock text-blue-600 px-2"></i>
                                                <span class="font-light pr-2 pl-1 text-xl items-center text-neutral-400">|</span> Set Order in Progress
                                             </button>
                                             <button type="submit" name="pending-order" class="w-full text-neutral-900 font-semibold rounded-lg text-md px-2 py-2.5 text-left inline-flex items-center me-2 mb-2 border border-pink-600 hover:bg-pink-200">
                                                <i class="text-lg fa fa-bullseye text-pink-600 px-2"></i>
                                                <span class="font-light pr-2 pl-1 text-xl items-center text-neutral-400">|</span> Set Order to Pending
                                             </button>
                                             <button type="submit" name="cancel-order" class="w-full text-neutral-900 font-semibold rounded-lg text-md px-2 py-2.5 text-left inline-flex items-center me-2 mb-2 border border-yellow-600 hover:bg-yellow-200">
                                                <i class="text-lg fa fa-times-circle text-yellow-600 px-2"></i>
                                                <span class="font-light pr-2 pl-1 text-xl items-center text-neutral-400">|</span> Cancel this Order
                                             </button>
                                          </div>
                                       </form>
                                       <!-- Modal footer -->
                                       <div class="flex items-center p-4 md:p-5 border-t border-neutral-200 rounded-b">
                                          <button data-modal-hide="con-modal-<?=$book_id;?>" type="button" class="inline-flex w-full justify-center items-center px-3 py-2 text-md font-medium text-center text-white bg-neutral-700 rounded-lg hover:bg-neutral-800 focus:ring-4 focus:outline-none focus:ring-neutral-300">Close</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- Modal Conditions End -->
                           </td>
                        </tr>
                     <?php } ?>
                  </tbody>
               </table>
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
