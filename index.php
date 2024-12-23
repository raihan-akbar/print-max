<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Title</title>
    <link rel="icon" href="assets/img/system/sq-logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet">
</head>

<body class="bg-neutral-100">
    <nav class="bg-blue-950 fixed top-0 z-40 start-0 w-full">
        <div class="max-w-screen-2xl flex flex-wrap items-center justify-between mx-auto p-2">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="assets/img/system/sq-logo.png" class="h-7" alt="Fox-Labs Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-blue-50"></span>
            </a>
            <button data-collapse-toggle="navbar-multi-level" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 hover:text-blue-50 rounded-lg md:hidden focus:outline-none focus:ring-2 focus:ring-gray-200"
                aria-controls="navbar-multi-level" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto rounded-lg py-2 bg-transparent" id="navbar-multi-level">
                <ul
                    class="flex flex-col font-medium p-4 md:p-0 mt-4 rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
                    <li>
                        <a href="#home"
                            class="block py-4 px-3 text-neutral-200 rounded md:p-0 hover:text-neutral-200 underline decoration-2 underline-offset-8">Beranda</a>
                    </li>
                    <li>
                        <a href="#catalogue"
                            class="block py-4 px-3 text-neutral-400 rounded md:p-0 hover:text-neutral-200 hover:underline decoration-2 underline-offset-8">Katalog</a>
                    </li>
                    <li>
                        <a href="contact.php"
                            class="block py-4 px-3 text-neutral-400 rounded md:p-0 hover:text-neutral-200 hover:underline decoration-2 underline-offset-8">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="home" class="my-14">
        <div
            class="bg-center bg-no-repeat bg-[url('https://images.unsplash.com/photo-1592312040834-bb0d621713e1?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')] bg-neutral-500 bg-blend-multiply">
            <div class="px-4 mx-auto max-w-screen-xl text-center py-4 lg:py-32">
                <div class="grid justify-center place-items-center items-center">
                    <div class="w-64 text-neutral-50 my-12">
                        <img src="assets/img/system/hr-logo.png" alt="">
                    </div>
                </div>
                <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                    <a href="contact.php"
                        class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                        Kontak
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="catalogue" class="my-12 w-full">
        <div class="w-full my-12 text-center">
            <h3 class="text-2xl font-semibold text-neutral-800">Katalog Pemesanan</h3>
            <hr class="w-16 h-1 mx-auto my-2 bg-blue-600 border-0 rounded ">
        </div>
        <div class="flex flex-wrap justify-center gap-6 px-4">

            <?php
            include_once "conn.php";
            $query = mysqli_query($con, "SELECT * FROM product ORDER BY product_sold DESC");
            while ($products = mysqli_fetch_array($query)) { ?>
                <div
                    class="max-w-full sm:max-w-full md:max-w-sm lg:max-w-sm xl:max-w-sm bg-neutral-50 border border-neutral-300 rounded-lg shadow-xl mb-10">
                    <a href="#">
                        <img class="rounded-t-lg" src="assets/img/item/<?= $products[
                            "product_thumbnail"
                        ] ?>" alt="" />
                    </a>
                    <div class="p-5">
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-semibold tracking-tight text-neutral-800 capitalize"><?= $products[
                                "product_name"
                            ] ?></h5>
                            <!-- <p class="text-neutral-700 font-regular"><span class="text-sm">Harga Mulai Dari </span> </p> -->
                            <p class="text-sm mt-4">Harga Mulai Dari</p>
                            <p class="text-xl font-medium text-neutral-800">
                                <span class="rp"><?= $products["product_price"] ?></span>
                                <span class="text-neutral-600 font-regular text-sm">IDR</span>
                            </p>
                            <p class="text-sm">Terjual ±<span class="font-medium"><?= $products["product_sold"] ?></span></p>
                        </a>
                        <hr class="mt-8 bg-blue-700 rounded border-1 border-blue-700">
                        <div class="mt-4 flex w-full text-center">
                            <a href="item.php?i=<?= $products["product_id"] ?>"
                                class="inline-flex w-full justify-center items-center text-base font-medium text-center text-neutral-500 hover:text-blue-700 hover:animate-pulse">
                                Rincian Produk
                                <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="4" d="m9 5 7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            <?php }
            ?>

            <!-- End of Card Looping -->
        </div>
    </section>
    <footer class="bg-white rounded-lg shadow">
        <div class="w-full max-w-screen-xl mx-auto pt-2">
            <p class="text-center text-neutral-600 text-sm">Ghina Nur Agsya</p>
            <hr class="my-2 border-neutral-200 sm:mx-auto" />
            <span class="block text-sm text-gray-500 sm:text-center pb-4">
                © <?= date(
                    "Y"
                ) ?> <a href="https://foxlabs.id/" class="hover:underline">Fox Labs ID</a>. All Rights Reserved.</span>
        </div>
    </footer>

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

</html>
