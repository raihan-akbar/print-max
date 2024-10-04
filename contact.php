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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="bg-neutral-100">
    <nav class="bg-blue-950 fixed top-0 z-40 start-0 w-full">
        <div class="max-w-screen-2xl flex flex-wrap items-center justify-between mx-auto p-2">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="assets/img/system/sq-logo.png" class="h-7" alt="Fox-Labs Logo" />
                <!-- <h3 class="text-neutral-50 text-lg font-extrabold">< MAX PRINT /></h3> -->
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-blue-50"></span>
            </a>
            <button data-collapse-toggle="navbar-multi-level" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 hover:text-blue-50 rounded-lg md:hidden focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-multi-level" aria-expanded="false">
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
                        <a href="#catalogue" class="block py-4 px-3 text-neutral-400 rounded md:p-0 hover:text-neutral-200 hover:underline decoration-2 underline-offset-8">Katalog</a>
                    </li>
                    <li>
                        <a href="contact.php" class="block py-4 px-3 text-neutral-400 rounded md:p-0 hover:text-neutral-200 hover:underline decoration-2 underline-offset-8">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="home" class="">
        <div class="bg-neutral-50 h-screen">
            <div class="px-4 mx-auto max-w-screen-xl text-center py-16 lg:py-28">
                <h3 class="text-3xl font-bold pb-8 pt-4 text-blue-950">Kontak & Alamat</h3>
                <div class="bg-blue-950 rounded-lg shadow-xl">
                    <div class="w-full columns-1 md:columns-2 space-y-8 md:space-y-0">
                        <div class="w-full rounded-lg">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15843.314325647201!2d106.9348136!3d-6.9110898!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68493f84c24701%3A0x9bbad8a95961ef87!2sPRINTMAX%20-%20Digital%20Printing%20Sukabumi!5e0!3m2!1sen!2sid!4v1725646948381!5m2!1sen!2sid" height="650" class="w-full rounded-t md:rounded-l max-h-96 lg:max-h-screen" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <div class="w-full text-left space-y-4 p-4 justify-between w-full">
                            <div class="py-2">
                                <h3 class="font-bold text-neutral-50 text-3xl text-center">Detail</h3>
                            </div>
                            <div class="py-2">
                                <h3 class="font-semibold text-neutral-50 text-2xl"><i class="fa-regular fa-map text-xl fa-xs"></i> Alamat</h3>
                                <p class="font-medium text-neutral-200 text-lg">Jl. Surya Kencana No.101, Selabatu, Kec. Cikole, Kota Sukabumi, Jawa Barat 43111</p>
                            </div>
                            <div class="py-2">
                                <h3 class="font-semibold text-neutral-50 text-2xl"><i class="fa-brands fa-whatsapp"></i> Whatsapp</h3>
                                <p class="font-medium text-neutral-200 text-lg"><a target='_blank' href="https://wa.me/6283127201109">+6283127201109</a></p>
                            </div>
                            <div class="py-2">
                                <h3 class="font-semibold text-neutral-50 text-2xl"><i class="fa-regular fa-envelope"></i> Email</h3>
                                <p class="font-medium text-neutral-200 text-lg"><a>printmax.id@gmail.com</a></p>
                            </div>
                            <div class="py-2">
                                <h3 class="font-semibold text-neutral-50 text-2xl"><i class="fa-brands fa-instagram"></i> Instagram</h3>
                                <p class="font-medium text-neutral-200 text-lg"><a target='_blank' href="https://www.instagram.com/printmax.id/">@printmax.id</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center pb-8">
        <a href="index.php#home">Kembali ke Beranda</a>
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
