<?php
if (isset($_GET['i'])) {
    if ($_GET['i'] == null) {
        header("Location: index.php");
    }
     else {
        include_once 'conn.php';
        $product_id = $_GET['i'];
        $id_check = is_numeric($product_id);
        
        if ($id_check != 1) {
            header("Location: index.php");

        }else{
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

// Xample
$a = 0;

if ($a == 1) {
    $modalHide  = 'overflow-hidden';
    $modalClass = 'flex';
} else {
    $modalHide  = '';
    $modalClass = 'hidden';
}

if (isset($_POST['sum'])) {
    $name         = $_POST['name'];
    $size_id      = $_POST['size_id'];
    $type_id      = $_POST['type_id'];
    $quantity     = $_POST['quantity'];
    $product_id   = $_GET['i'];
    
    $extend_price = ($type_price + $size_price) * $quantity;
    $base_price   = $item_price * $quantity;
    $total_price  = $base_price + $extend_price;
}

?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Title <?= $id_check?></title>
    <link rel="icon" href="assets/img/system/sq-logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<?php while ($products = mysqli_fetch_array($query)) {?>
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
                <form class="space-y-4" action="item.php">
                    <h5 class="text-xl font-bold text-neutral-900">Form Order</h5>
                    <hr class="border-1 border-blue-950">
                    <div>
                        <label for="nama" class="block mb-2 text-sm font-medium text-neutral-900">Nama Anda</label>
                        <input type="text" name="nama" id="nama" class="bg-neutral-50 font-semibold border border-neutral-300 text-neutral-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Nama Pemesan" required />
                    </div>
                    <div>
                        <label for="ukuran" class="block mb-2 text-sm font-medium text-neutral-900">Ukuran</label>
                        <select type="text" name="ukuran" id="ukuran" class="bg-neutral-50 font-semibold border border-neutral-300 text-neutral-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="name@company.com" required />
                        <option value="50000" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-md font-semibold rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" selected disabled>
                            -- Pilih Ukuran
                        </option>
                        <option value="50000" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-md font-semibold rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            50x10cm
                        </option>
                        </select>
                    </div>
                    <div>
                        <label for="jenis" class="block mb-2 text-sm font-medium text-neutral-900">Jenis</label>
                        <select type="text" name="jenis" id="jenis" class="bg-neutral-50 font-semibold border border-neutral-300 text-neutral-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="name@company.com" required />
                        <option value="50000" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-md font-semibold rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" selected disabled>
                            -- Pilih Ukuran
                        </option>
                        <option value="50000" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-md font-semibold rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            Glosy
                        </option>
                        </select>
                    </div>
                    <div>
                        <label for="jumlah" class="block mb-2 text-sm font-medium text-neutral-900">Jumlah Pesanan</label>
                        <div class="flex">
                            <input type="number" value="1" min="1" name="jumlah" id="jumlah" class="rounded-none rounded-s-lg bg-neutral-50 font-semibold border border-neutral-300 text-neutral-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5 " placeholder="Jumlah Item">
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
                    <form class="space-y-4" action="#">
                        <div>
                            <p class="block text-sm font-medium text-neutral-900">Nama Pemesan</p>
                            <p class="w-full text-neutral-900 text-lg font-semibold">Ghina Nur Agsya</p>
                        </div>
                        <div>
                            <p class="block text-sm font-medium text-neutral-900">Item</p>
                            <p class="w-full text-neutral-900 text-lg font-semibold">Sticker</p>
                        </div>
                        <div>
                            <p class="block text-sm font-medium text-neutral-900">Jumlah</p>
                            <p class="w-full text-neutral-900 text-lg font-semibold">3</p>
                        </div>
                        <div>
                            <p class="block text-sm font-medium text-neutral-900">Total Harga</p>
                            <p class="w-full text-neutral-900 text-lg font-semibold"><span class="rp">30000</span></p>
                        </div>
                        <div>
                            <hr>
                            <p class="w-full text-neutral-700 text-sm font-regular pt-2">Silahkan Klik Link/Tombol Dibawah dan Lanjutkan percakapan via WhatsApp.</p>
                        </div>
                        <hr>
                        <a target="_blank" href="https://wa.me/628111221030?text=Pemesan%20%3A%20Ghina%20Nur%20Agsya%0AUkuran%20%3A%20Default%0AJenis%20%3A%20Glossy%0AJumlah%20%3A%20100" type="submit" class="w-full text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Pesan via Whatsapp</a>
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