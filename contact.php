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

    <section id="home" class="my-14 h-screen">
        <div class="bg-center bg-no-repeat bg-[url('https://images.unsplash.com/photo-1592312040834-bb0d621713e1?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')] bg-neutral-500 bg-blend-multiply">
            <div class="px-4 mx-auto max-w-screen-xl text-center py-4 lg:py-32">
                <div class="grid justify-center place-items-center items-center">
                    <div class="w-64 text-neutral-50 my-12">
                        <img src="assets/img/system/hr-logo.png" alt="">
                    </div>
                </div>
                <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 mt-12 my-64">
                    <div class="columns-1 lg:columns-3 gap-32">
                        <div class="w-full pt-12 text-white">
                            <p><i class="fa fa-phone text-3xl"></i></p>
                            <h3 class="text-2xl font-semibold pt-2">08111221030</h3>
                        </div>
                        <div class="w-full pt-12 text-white">
                            <p><i class="fa fa-map-pin text-3xl"></i></p>
                            <h3 class="text-2xl font-semibold pt-2">Jl. Surya Kencana No.101, Kota Sukabumi</h3>
                        </div>
                        <div class="w-full pt-12 text-white">
                            <p><i class="fa fa-camera text-3xl"></i></p>
                            <h3 class="text-2xl font-semibold pt-2">@printmax.id</h3>
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <p class="text-white font-medium"><a href="index.php">Kembali ke Beranda</a></p>
                </div>
            </div>
        </div>
    </section>


    <footer class="bg-white rounded-lg shadow">
        <div class="w-full max-w-screen-xl mx-auto pt-2">
            <p class="text-center text-neutral-600 text-sm">Ghina Nur Agsya</p>
            <hr class="my-2 border-neutral-200 sm:mx-auto" />
            <span class="block text-sm text-gray-500 sm:text-center pb-4">
                © <?= date('Y') ?> <a href="https://foxlabs.id/" class="hover:underline">Fox Labs ID</a>. All Rights Reserved.</span>
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
