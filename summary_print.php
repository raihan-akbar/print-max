<?php
include_once 'conn.php';
session_start();

if (!isset($_SESSION['auth'])) {
    session_destroy();
    header("Location: signin.php?error=3");
}

$role_name = $_SESSION['role_name'];

if ($role_name != 'Admin') {
    header("Location: dashboard.php");
}

if (isset($_POST['summary-print'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $new_start = date("d, M Y", strtotime($start_date));
    $new_end = date("d, M Y", strtotime($end_date));
    if ($start_date == null) {
        header("Location: summary.php?i=1");
    } else if ($end_date == null) {
        header("Location: summary.php?i=1");
    }
} else {
    header("Location: summary.php");
}

$summary_check = "SELECT * FROM `book` WHERE (book_date BETWEEN '$start_date' AND '$end_date') AND book_id != '0' ";
$result = mysqli_query($con, $summary_check);
$row = mysqli_num_rows($result);

if ($row == 0) {
    header("Location: summary.php?i=1");
}

// add item start
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

    <div class="no-print">
        <div class="mx-4 md:mx-4 mt-8 mb-16">
            <div class="columns-2 md:columns-3">
                <div class="w-full">
                    <a href="summary.php" class="font-semibold text-md"><i class="fa fa-chevron-left"></i> Go Back</a>
                </div>
                <div class="w-full text-center">
                    <pre class="text-yellow-600 invisible md:visible"><i>This is The Print Preview</i></pre>
                </div>
                <div class="w-full text-right">
                    <a onClick="window.print()" class="font-semibold text-md bg-green-600 hover:bg-green-800 text-white p-2 rounded-lg cursor-pointer">Print Summary</a>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full mx-auto">
        <!-- Print Header -->
        <div class="w-full">
            <div class="columns-3 m-4">
                <div class="w-full">
                    <img src="assets/img/system/sq-logo.png" class="h-12" alt="Print-Max Logo" />
                </div>
                <div class="w-full mt-8 text-center">
                    <p class="font-bold">Summary Details</p>
                    <p class="text-xs"><?= $new_start ?> ~ <?= $new_end ?></p>
                </div>
                <div class="w-full text-transparent">
                    <pre>Print Preview</pre>
                    <pre>Print Preview</pre>

                </div>
            </div>
            <div class="my-8">
                <hr>
            </div>
            <div class="w-full">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-4">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 w-fit">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Customer
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Item
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Size
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Type
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Order Date
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include_once 'conn.php';
                            $query = mysqli_query($con, "SELECT * FROM `book` WHERE (book_date BETWEEN '$start_date' AND '$end_date') AND book_id != '0'");
                            $no = 1;
                            while ($book = mysqli_fetch_array($query)) {
                                $status = $book['status'];
                                if ($status == '1') {
                                    $book_status = 'Finished';
                                    $book_tooltip = 'Success';
                                    $book_color = 'text-green-600';
                                    $book_icon = 'fa fa-check-circle';
                                } else if ($status == '2') {
                                    $book_status = 'Progress';
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
                                        <?= $no++; ?>
                                    </th>
                                    <th scope="row" class="px-6 py-4">
                                        <?= $book['book_by'] ?>
                                    </th>
                                    <td class="px-6 py-4 font-medium text-sm">
                                        <?= $book['product_name'] ?> (<?= $book['qty'] ?>)
                                    </td>
                                    <td class="px-6 py-4 font-medium text-sm">
                                        <?= $book['size'] ?>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-sm">
                                        <?= $book['type'] ?>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-sm rp">
                                        <?= $book['total'] ?>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-sm">
                                        <?= $book_status ?>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-sm">
                                        <?php
                                        $org_date = $book['book_date'];
                                        $new_date = date("d, m Y", strtotime($org_date));
                                        $book_id = $book['book_id'];
                                        ?>
                                        <?= $new_date; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="w-full mx-auto text-xs uppercase">
                    <p class="text-xs mx-4 mt-8 text-center">
                        <small>
                            Printed on <?= date('d,M Y') ?> |
                            By <?= $_SESSION["name"]; ?> |
                            Showing <?= $row; ?> Results
                        </small>
                    </p>
                </div>

            </div>
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
