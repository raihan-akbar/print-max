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
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>


</head>

<body class="bg-slate-100">

    <?php include '_navside.php' ?>

    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-12">

            <!-- Content Start Here -->
            <div class="w-full">
                <h2 class="text-neutral-800 font-bold text-3xl">
                    Order Summary
                </h2>
                <p class="text-neutral-700 font-medium">You can Monitoring and Print out the order summary.</p>
                <hr class="w-full bg-blue-950 rounded mt-4">
            </div>

            <!-- // Order Status // 1 = Finished // 2 = Progress // 3 = Cancelled // 4 = Pending -->

            <?php

            $one = true;
            $two = false;
            $three = true;
            $four = true;
            $date_start = '2024-08-01';
            $date_end = '2024-09-01';

            if ($one == true) {
                $query_finish = " OR status = '1'";
            } else {
                $query_finish = null;
            }

            if ($two == true) {
                $query_progress = " OR status = '2'";
            } else {
                $query_progress = null;
            }

            if ($three == true) {
                $query_cancel = " OR status = '3'";
            } else {
                $query_cancel = null;
            }

            if ($three == true) {
                $query_pending = " OR status = '4'";
            } else {
                $query_pending = null;
            }

            $today=date("m/d/Y");

            $query = "SELECT * FROM `book` WHERE (book_date BETWEEN '$date_start' AND '$date_end' AND book_id != '0' $query_finish $query_progress $query_cancel $query_pending) ;"

            ?>

            <!-- Printout Form -->
            <div class="w-full mt-4">
                <form action="summary_print.php" method="post">
                    <!-- <label class="font-medium text-sm">Status Category <span class="font-regular">(Select at least 1)</span></label>
                    <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex">
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                            <div class="flex items-center ps-3">
                                <input id="vue-checkbox-list" type="checkbox" value="" class="w-6 h-6 text-lg text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label for="vue-checkbox-list" class="w-full py-3 ms-2 text-lg font-medium text-gray-900 font-semibold">Finished</label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                            <div class="flex items-center ps-3">
                                <input id="vue-checkbox-list" type="checkbox" value="" class="w-6 h-6 text-lg text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label for="vue-checkbox-list" class="w-full py-3 ms-2 text-lg font-medium text-gray-900 font-semibold">Progress</label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                            <div class="flex items-center ps-3">
                                <input id="vue-checkbox-list" type="checkbox" value="" class="w-6 h-6 text-lg text-yellow-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label for="vue-checkbox-list" class="w-full py-3 ms-2 text-lg font-medium text-gray-900 font-semibold">Canceled</label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                            <div class="flex items-center ps-3">
                                <input id="vue-checkbox-list" type="checkbox" value="" class="w-6 h-6 text-lg text-pink-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label for="vue-checkbox-list" class="w-full py-3 ms-2 text-lg font-medium text-gray-900 font-semibold">Pending</label>
                            </div>
                        </li>
                    </ul> -->
                    <div class="w-full mt-4 mb-4 columns-3">
                        <div class="w-full">
                            <label class="font-medium text-sm">Start Date</label>
                            <input name="start_date" datepicker id="default-datepicker" datepicker-format="yyyy-mm-dd" type="date" class="w-full font-semibold rounded-lg" placeholder="Start Date">
                        </div>
                        <div class="w-full">
                            <label class="font-medium text-sm">End Date</label>
                            <input name="end_date" datepicker id="datepicker-autohide" datepicker-format="yyyy-mm-dd" type="date" class="w-full font-semibold rounded-lg" placeholder="Start Date" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="w-full">
                            <button name="summary-print" type="submit" class="w-full bg-blue-600 mt-6 p-2 h-fit rounded-lg text-neutral-100 font-bold hover:bg-blue-800">Print Now</button>
                        </div>
                    </div>
            </div>
            </form>
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
                swal('Sorry','No Data for That Date Range, Please Select Again', 'info')}</script>";
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
