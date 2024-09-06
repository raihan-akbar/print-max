<?php
if (isset($_GET['i'])) {
    if ($_GET['i'] == null) {
        header("Location: index.php");
    } else {
        include_once 'conn.php';
        $product_id = $_GET['i'];
        $id_check = is_numeric($product_id);

        if ($id_check != 1) {
            header("Location: index.php");
        } else {
            $query = mysqli_query($con, "SELECT * FROM product WHERE product_id='$product_id' ");
            $item_check = mysqli_num_rows($query);
            if ($item_check != 1) {
                header("Location: index.php");
            }
        }
    }
} else {
    header("Location: index.php");
}

if (isset($_POST['sum'])) {
    $name         = $_POST['name'];
    $size_id      = $_POST['size_id'];
    $type_id      = $_POST['type_id'];
    $qty          = $_POST['qty'];
    $product_id   = $_GET['i'];
    $modalHide    = 'overflow-hidden';
    $modalClass   = 'flex';

    $sum_order = "SELECT * FROM `product`,`product_size`,`product_type` WHERE product_size.product_size_id = '$size_id' AND product_type.product_type_id = '$type_id' AND product.product_id = '$product_id' ";
    $execute = mysqli_query($con, $sum_order);
    while ($sum = mysqli_fetch_array($execute)) {
        $product_name     = $sum['product_name'];
        $product_price = $sum['product_price'];
        $size_price    = $sum['product_size_price'];
        $type_price    = $sum['product_type_price'];
        $size_value    = $sum['product_size_value'];
        $type_value    = $sum['product_type_value'];

        $price = $product_price + $type_price + $size_price;
        $total = $price * $qty;
        setlocale(LC_MONETARY, "ID");
        $total_display = "Rp" . number_format($total);

        $order_link = "https://wa.me/6283127201109?text=Nama%20Pemesan%20%3A%20$name%0AItem%20%3A%20$product_name%0AUkuran%20%3A%20$size_value%0ATIpe%20%3A%20$type_value%0AJumlah%20%3A%20$qty%0ATotal%20%3A%20$total_display";
    }

    // header("Location: item.php?1=".$product_id);

} else {
    $modalHide  = '';
    $modalClass = 'hidden';
}

date_default_timezone_set('Asia/Jakarta');

if (isset($_POST['do_order'])) {
    $name = $_POST['name'];
    $product_name = $_POST['product_name'];
    $size = $_POST['size'];
    $type = $_POST['type'];
    $qty = $_POST['qty'];
    $total = $_POST['total'];
    $book_date = $_POST['book_date'];

    setlocale(LC_MONETARY, "ID");
    $total_display = "Rp" . number_format($total);

    $order_link = "https://wa.me/6283127201109?text=Nama%20Pemesan%20%3A%20$name%0AItem%20%3A%20$product_name%0AUkuran%20%3A%20$size%0ATIpe%20%3A%20$type%0AJumlah%20%3A%20$qty%0ATotal%20%3A%20$total_display";

    $insert_query = "INSERT INTO `book` (`book_id`, `book_by`, `product_name`, `size`, `type`, `qty`, `total`, `status`, `book_date`) VALUES (NULL, '$name', '$product_name', '$size', '$type', '$qty', '$total', '4', '$book_date');";

    $execute = mysqli_query($con, $insert_query);
    if ($execute) {
        header("Location: $order_link");
        // header("Location: item.php?i=1");

        exit();
    } else {
        header("Location: item.php?i=1");
    }
}

?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Title <?= $id_check ?></title>
    <link rel="icon" href="assets/img/system/sq-logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<?php while ($products = mysqli_fetch_array($query)) { ?>

    <body class="bg-neutral-100 <?php echo $modalHide; ?>">
        <nav class="bg-blue-950 fixed top-0 z-40 start-0 w-full">
            <div class="max-w-screen-2xl flex flex-wrap items-center justify-between mx-auto p-2">
                <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <img src="assets/img/system/sq-logo.png" class="h-7" alt="Fox-Labs Logo" />
                    <!-- <h3 class="text-neutral-50 text-lg font-extrabold">< MAX PRINT /></h3> -->
                    <span class="self-center text-2xl font-semibold whitespace-nowrap text-bluzi-50"></span>
                </a>
                <button data-collapse-toggle="navbar-multi-level" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-neutral-500 hover:text-bluzi-50 rounded-lg md:hidden focus:outline-none focus:ring-2 focus:ring-neutral-200" aria-controls="navbar-multi-level" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
                <div class="hidden w-full md:block md:w-auto rounded-lg py-2 bg-transparent" id="navbar-multi-level">
                    <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
                        <li>
                            <a href="index.php#home" class="block py-4 px-3 text-neutral-200 rounded md:p-0 hover:text-neutral-200 underline decoration-2 underline-offset-8">Beranda</a>
                        </li>
                        <li>
                            <a href="/index.php#catalogue" class="block py-4 px-3 text-neutral-400 rounded md:p-0 hover:text-neutral-200 hover:underline decoration-2 underline-offset-8">Katalog</a>
                        </li>
                        <li>
                            <a href="#" class="block py-4 px-3 text-neutral-400 rounded md:p-0 hover:text-neutral-200 hover:underline decoration-2 underline-offset-8">Order</a>
                        </li>
                        <li>
                            <a href="#" class="block py-4 px-3 text-neutral-400 rounded md:p-0 hover:text-neutral-200 hover:underline decoration-2 underline-offset-8">Kontak</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <section id="item" class="w-full mb-12 my-16">
            <div class="w-full text-center">
                <h3 class="text-2xl xs:text-xl lg:text-2xl font-semibold text-neutral-800">Order Item</h3>
                <hr class="w-16 h-1 mx-auto my-2 bg-blue-950 border-0 rounded ">
            </div>
            <div class="flex flex-wrap justify-center px-2 lg:px-16 xl:px-16 gap-8 mt-8">


                <div class="min-w-screen max-w-full xs:max-w-full sm:max-w-full md:max-w-full lg:max-w-6xl xl:max-w-6xl bg-white border border-neutral-200 rounded-lg shadow">
                    <a href="#">
                        <img class="rounded-t-lg" src="assets/img/item/<?= $products['product_thumbnail']; ?>" alt="" />
                    </a>
                    <div class="p-5">
                        <h5 class="text-2xl font-bold tracking-tight text-neutral-900"><?= $products['product_name']; ?></h5>
                        <!-- <p class="font-semibold text-lg text-blue-800">Rp. <span class="rp">50000</span></p> -->
                        <?php
                        setlocale(LC_MONETARY, "ID");
                        $price = $products['product_price'];
                        $rp = number_format($price);
                        ?>
                        <p class="font-semibold text-lg text-blue-800">Rp. <span class=""><?php echo $rp; ?></span></p>
                        <p class="font-semibold text-lg text-neutral-600"><?= $products['product_desc']; ?></p>
                    </div>
                </div>


                <div class="w-screen max-w-full xs:max-w-full sm:max-w-full md:max-w-full lg:max-w-full xl:max-w-md p-4 bg-white border border-neutral-200 rounded-lg shadow sm:p-6 md:p-8">
                    <form class="space-y-4" action="item.php?i=<?= $product_id; ?>" method="post">
                        <h5 class="text-xl font-bold text-neutral-900">Form Order</h5>
                        <hr class="border-1 border-blue-950">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-neutral-900">Nama Anda</label>
                            <input type="text" name="name" id="name" class="bg-neutral-50 font-semibold border border-neutral-300 text-neutral-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Nama Pemesan" required />
                        </div>
                        <div>
                            <label for="size_id" class="block mb-2 text-sm font-medium text-neutral-900">Ukuran</label>
                            <select type="text" name="size_id" id="size_id" class="bg-neutral-50 font-semibold border border-neutral-300 text-neutral-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="name@company.com" required />
                            <option value="50000" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-md font-semibold rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" selected disabled>
                                -- Pilih Ukuran
                            </option>
                            <?php
                            $query = mysqli_query($con, "SELECT * FROM product_size WHERE product_id='$product_id' ");
                            while ($size = mysqli_fetch_array($query)) { ?>
                                <option value="<?= $size['product_size_id'] ?>" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-md font-semibold rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <?= $size['product_size_value'] ?>
                                    <?= '(+' . $size['product_size_price'] . ')' ?>
                                </option>
                            <?php } ?>
                            </select>
                        </div>
                        <div>
                            <label for="type_id" class="block mb-2 text-sm font-medium text-neutral-900">Jenis</label>
                            <select type="text" name="type_id" id="type_ids" class="bg-neutral-50 font-semibold border border-neutral-300 text-neutral-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="name@company.com" required />
                            <option value="50000" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-md font-semibold rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" selected disabled>
                                -- Pilih Tipe
                            </option>

                            <?php
                            $query = mysqli_query($con, "SELECT * FROM product_type WHERE product_id='$product_id' ");
                            while ($type = mysqli_fetch_array($query)) { ?>
                                <option value="<?= $type['product_type_id'] ?>" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-md font-semibold rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <?= $type['product_type_value'] ?>
                                    <?= '(+' . $type['product_type_price'] . ')' ?>
                                </option>
                            <?php } ?>
                            </select>
                        </div>
                        <div>
                            <label for="qty" class="block mb-2 text-sm font-medium text-neutral-900">Jumlah Pesanan</label>
                            <div class="flex">
                                <input type="number" value="1" min="1" name="qty" id="qty" class="rounded-none rounded-s-lg bg-neutral-50 font-semibold border border-neutral-300 text-neutral-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5 " placeholder="Jumlah Item">
                                <span class="inline-flex items-center px-3 text-sm font-bold text-neutral-900 bg-neutral-200 border border-s-0 border-neutral-300 rounded-e-md uppercase">
                                    PCS
                                </span>
                            </div>
                        </div>
                        <hr class="border-1 border-neutral-300">
                        <div class="space-y-0 py-1 text-left">
                            <p class="text-sm font-medium text-neutral-600 py-2">
                                <i class="fa fa-angle-right fa-xs fa-fw pr-4 text-blue-700 text-xs"></i>Ukuran dan Jenis Item Menentukan Harga
                            </p>
                            <p class="text-sm font-medium text-neutral-600 py-2">
                                <i class="fa fa-angle-right fa-xs fa-fw pr-4 text-blue-700 text-xs"></i>
                                Isi Form dan Klik Hitung/Order untuk Melihat Detail Harga dan Memesan Item Langsung via WhatsApp
                            </p>
                        </div>
                        <hr class="border-1 border-neutral-300">
                        <button type="submit" name="sum" class="inline-flex w-full justify-center items-center px-3 py-2 text-md font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            Hitung/Order
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </button>

                    </form>
                </div>
            </div>
        </section>
        <section class="text-center">
            <a href="index.php#home">Kembali ke Beranda</a>
        </section>

        <button data-modal-target="order-modal" data-modal-toggle="order-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 hidden" type="button">
        </button>

        <!-- Main modal -->
        <div id="order-modal" data-modal-backdrop="static" tabindex="-1" aria-modal="true" role="dialog" class="bg-center w-screen h-screen bg-no-repeat bg-[url('assets/img/system/backdrop-blur.png')] h-screen overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center backdrop-blur-sm md:inset-0 h-[calc(100%-1rem)] <?php echo $modalClass; ?>">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-2 px-4 border-b rounded-t">
                        <h3 class="text-xl font-bold text-neutral-900">
                            Order Detail
                        </h3>
                        <button type="button" class="end-2.5 text-neutral-400 bg-transparent hover:bg-neutral-200 hover:text-neutral-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="order-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5">
                        <form class="space-y-4" action="item.php?i=<?= $product_id ?>" method="post">
                            <div>
                                <p class="block text-sm font-medium text-neutral-900">Nama Pemesan</p>
                                <p class="w-full text-neutral-900 text-lg font-semibold"><?= $name; ?></p>
                            </div>
                            <div>
                                <p class="block text-sm font-medium text-neutral-900">Item</p>
                                <p class="w-full text-neutral-900 text-lg font-semibold"><?= $product_name; ?></p>
                            </div>
                            <div class="w-full">
                                <p class="block text-sm font-medium text-neutral-900">Ukuran and Tipe</p>
                                <div class="columns-2">
                                    <p class="w-full text-neutral-900 text-lg font-semibold"><?= $size_value; ?></p>
                                    <p class="w-full text-neutral-900 text-lg font-semibold"><?= $type_value; ?></p>

                                </div>
                            </div>
                            <div>
                                <p class="block text-sm font-medium text-neutral-900">Jumlah</p>
                                <p class="w-full text-neutral-900 text-lg font-semibold"><?= $qty; ?></p>
                            </div>
                            <div>
                                <p class="block text-sm font-medium text-neutral-900">Total Harga</p>
                                <p class="w-full text-neutral-900 text-xl font-semibold">Rp<span class="rp"><?= $total ?></span></p>
                            </div>
                            <div>
                                <hr>
                                <p class="w-full text-neutral-700 text-sm font-regular pt-2">Silahkan Klik Link/Tombol Dibawah dan Lanjutkan percakapan via WhatsApp.</p>
                            </div>
                            <hr>
                            <!-- <a target="_blank" href="<?= $order_link ?>" type="submit" class="w-full text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Pesan via Whatsapp</a> -->
                            <input type="hidden" name="name" value="<?= $name ?>">
                            <input type="hidden" name="product_name" value="<?= $product_name ?>">
                            <input type="hidden" name="size" value="<?= $size_value ?>">
                            <input type="hidden" name="type" value="<?= $type_value ?>">
                            <input type="hidden" name="total" value="<?= $total ?>">
                            <input type="hidden" name="qty" value="<?= $qty ?>">
                            <input type="hidden" name="book_date" value="<?= date('Y-m-d') ?>">
                            <button type="submit" name="do_order" class="w-full text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Pesan via Whatsapp</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


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
    </body>
<?php } ?>

</html>
