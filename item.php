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
                <!-- <h3 class="text-neutral-50 text-lg font-extrabold">< MAX PRINT /></h3> -->
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-bluzi-50"></span>
            </a>
            <button data-collapse-toggle="navbar-multi-level" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 hover:text-bluzi-50 rounded-lg md:hidden focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-multi-level" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto rounded-lg py-2 bg-transparent" id="navbar-multi-level">
                <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
                    <li>
                        <a href="#home" class="block py-4 px-3 text-neutral-200 rounded md:p-0 hover:text-neutral-200 underline decoration-2 underline-offset-8">Beranda</a>
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

    <section id="item" class="w-full mb-24 my-16">
        <div class="w-full text-center">
            <h3 class="text-2xl xs:text-xl lg:text-2xl font-semibold text-neutral-800">Order Item</h3>
            <hr class="w-16 h-1 mx-auto my-2 bg-blue-950 border-0 rounded ">
        </div>
        <div class="flex flex-wrap justify-center px-2 lg:px-16 xl:px-16 gap-8 mt-8">


            <div class="min-w-screen max-w-full xs:max-w-full sm:max-w-full md:max-w-full lg:max-w-6xl xl:max-w-6xl bg-white border border-gray-200 rounded-lg shadow">
                <a href="#">
                    <img class="rounded-t-lg" src="http://fakeimg.pl/900x600?text=FOO&font=lobster" alt="" />
                </a>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Noteworthy technology acquisitions 2021</h5>
                    </a>
                </div>
            </div>


            <div class="w-screen max-w-full xs:max-w-full sm:max-w-full md:max-w-full lg:max-w-full xl:max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8">
                <form class="space-y-4" action="#">
                    <h5 class="text-xl font-medium text-gray-900">Order</h5>
                    <hr class="border-1 border-blue-950">
                    <div>
                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama Anda</label>
                        <input type="text" name="nama" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="name@company.com" required />
                    </div>
                    <div>
                        <label for="ukuran" class="block mb-2 text-sm font-medium text-gray-900">Ukuran</label>
                        <select type="text" name="ukuran" id="ukuran" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="name@company.com" required />
                        <option class="bg-gray-50 border border-gray-300 text-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" selected disabled>
                            -- Pilih Ukuran
                        </option>
                        <option class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            -- Pilih Ukuran
                        </option>
                        <option class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            -- Pilih Ukuran
                        </option>
                        </select>
                    </div>
                    <div>
                        <label for="ukuran" class="block mb-2 text-sm font-medium text-gray-900">Jenis</label>
                        <select type="text" name="ukuran" id="ukuran" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="name@company.com" required />
                        <option class="bg-gray-50 border border-gray-300 text-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" selected disabled>
                            -- Pilih Jenis
                        </option>
                        </select>
                    </div>
                    <div>
                        <label for="jumlah" class="block mb-2 text-sm font-medium text-gray-900">Jumlah Pesanan</label>
                        <div class="flex">
                            <input type="number" name="jumlah" id="jumlah" class="rounded-none rounded-s-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5 " placeholder="Jumlah Item">
                            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-s-0 border-gray-300 rounded-e-md">
                                pcs
                            </span>
                        </div>
                    </div>
                    <hr class="border-1 border-blue-950">
                    <div class="space-y-0 py-2 text-left">
                        <p class="text-xl">
                            <span class="text-lg font-medium text-gray-900">Total Harga</span>
                            Rp.
                            <span class="rp">50000</span>
                        </p>
                    </div>
                    <hr class="border-1 border-blue-950">
                    <a href="#" class="inline-flex w-full justify-center items-center px-3 py-2 text-md font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        Read more
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                    <a href="#" class="inline-flex w-full justify-center items-center px-3 py-2 text-md font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 gap-2">
                        Pesan via Whatsapp
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path fill="currentColor" fill-rule="evenodd" d="M12 4a8 8 0 0 0-6.895 12.06l.569.718-.697 2.359 2.32-.648.379.243A8 8 0 1 0 12 4ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10a9.96 9.96 0 0 1-5.016-1.347l-4.948 1.382 1.426-4.829-.006-.007-.033-.055A9.958 9.958 0 0 1 2 12Z" clip-rule="evenodd" />
                            <path fill="currentColor" d="M16.735 13.492c-.038-.018-1.497-.736-1.756-.83a1.008 1.008 0 0 0-.34-.075c-.196 0-.362.098-.49.291-.146.217-.587.732-.723.886-.018.02-.042.045-.057.045-.013 0-.239-.093-.307-.123-1.564-.68-2.751-2.313-2.914-2.589-.023-.04-.024-.057-.024-.057.005-.021.058-.074.085-.101.08-.079.166-.182.249-.283l.117-.14c.121-.14.175-.25.237-.375l.033-.066a.68.68 0 0 0-.02-.64c-.034-.069-.65-1.555-.715-1.711-.158-.377-.366-.552-.655-.552-.027 0 0 0-.112.005-.137.005-.883.104-1.213.311-.35.22-.94.924-.94 2.16 0 1.112.705 2.162 1.008 2.561l.041.06c1.161 1.695 2.608 2.951 4.074 3.537 1.412.564 2.081.63 2.461.63.16 0 .288-.013.4-.024l.072-.007c.488-.043 1.56-.599 1.804-1.276.192-.534.243-1.117.115-1.329-.088-.144-.239-.216-.43-.308Z" />
                        </svg>

                    </a>
                </form>
            </div>


        </div>
    </section>

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
