<?php
session_start();

if (!isset($_SESSION['auth'])) {
    session_destroy();
    header("Location: signin.php?error=3");
}

// add item start

if (isset($_POST['add-item'])) {
    if (!isset($_POST['name'], $_POST['price'], $_POST['description'])) {
        header("Location: item.php?error=0");
    }
}

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
                    Product Management
                </h2>
                <p class="text-neutral-700 font-medium">You can Manage all your stuff here. All text is replaced by code style and different with <a href="/index.php#catalugue">catalogue view</a>.</p>
                <hr class="w-full bg-blue-950 rounded mt-4">
            </div>

            <div class="w-full mt-4">
                <div class="flex flex-wrap w-full justify-center gap-4">

                    <div class="max-w-full h-full w-full sm:max-w-full md:max-w-sm lg:max-w-xs xl:max-w-xs bg-neutral-50 border border-neutral-300 rounded-lg shadow-xl mb-10">
                        <div class="p-5 flex justify-center text-center items-center py-40">
                            <a class="text-neutral-500 hover:text-neutral-800" style="cursor: pointer;" data-modal-target="add-item-modal" data-modal-toggle="add-item-modal">
                                <i class="fa fa-plus text-5xl"></i>
                                <h5 class="mb-2 text-2xl font-semibold tracking-tight mt-4">Add Item</h5>
                            </a>
                        </div>
                    </div>


                    <!-- Main modal -->
                    <div id="add-item-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                    <h3 class="text-lg font-semibold text-neutral-900">
                                        Add New Item
                                    </h3>
                                    <button type="button" class="text-neutral-400 bg-transparent hover:bg-neutral-200 hover:text-neutral-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="add-item-modal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <form class="p-4 md:p-5" method="post" action="product.php">
                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                        <div class="col-span-2">
                                            <label for="name" class="block mb-2 text-sm font-medium text-neutral-900">Item</label>
                                            <input type="text" name="name" id="name" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type item name" required="">
                                        </div>
                                        <div class="col-span-2 sm:col-span-1">
                                            <label for="price" class="block mb-2 text-sm font-medium text-neutral-900">Item Price</label>
                                            <div class="flex">
                                                <span class="inline-flex items-center px-3 text-sm font-medium text-neutral-900 bg-neutral-200 border border-s-0 border-neutral-300 rounded-s-md uppercase">
                                                    Rp.
                                                </span>
                                                <input type="text" min="0" name="price" id="quantity-input" data-input-counter data-input-counter-min="1" data-input-counter-max="9999999999" class="rounded-none rounded-e-lg bg-neutral-50 border border-neutral-300 text-neutral-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-md p-2.5 " placeholder="Price of 1 Item">
                                            </div>
                                        </div>
                                        <div class="col-span-2 sm:col-span-1">
                                            <label for="thumbnail" class="block mb-2 text-sm font-medium text-neutral-900">Photo of Item</label>
                                            <input class="block w-full text-sm text-neutral-900 border border-neutral-300 rounded-lg cursor-pointer bg-neutral-50" id="file_input" type="file" accept="image/png, image/gif, image/jpeg">
                                        </div>
                                        <div class="col-span-2">
                                            <label for="description" class="block mb-2 text-sm font-medium text-neutral-900">Item Description</label>
                                            <textarea id="description" rows="4" class="block p-2.5 w-full text-md text-neutral-900 bg-neutral-50 rounded-lg border border-neutral-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Write Item description here"></textarea>
                                        </div>
                                    </div>
                                    <div class="w-full">
                                        <button type="submit" name="sum" class="inline-flex w-full justify-center items-center px-3 py-2 text-md font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                            Add New Item
                                            <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
                                            </svg>

                                        </button>
                                        <button type="submit" name="add-item" class="inline-flex w-full justify-center items-center mt-4 text-md font-medium text-center text-neutral-500 hover:text-neutral-800" data-modal-toggle="add-item-modal">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <?php

                    for ($i = 1; $i <= 30; $i++) { ?>

                        <div class="max-w-full sm:max-w-full md:max-w-sm lg:max-w-xs xl:max-w-xs bg-neutral-50 border border-neutral-300 rounded-lg shadow-xl mb-10">
                            <a href="#">
                                <img class="rounded-t-lg" src="http://fakeimg.pl/900x600?text=foo&font=bebas" alt="" />
                            </a>
                            <div class="p-5">
                                <a href="#">
                                    <h5 class="mb-2 text-2xl font-medium tracking-tight text-neutral-800 capitalize"><code>Product Name</code></h5>
                                    <!-- <p class="text-neutral-700 font-regular"><span class="text-sm"><code>Base Price</code> : </span> </p> -->
                                    <p class="text-sm mt-2"><code>Base Price :</code></p>
                                    <p class="text-xl font-medium text-neutral-800">
                                        <code>
                                            <span class="rp">250230</span>
                                            <span class="text-neutral-600 font-regular text-sm">IDR</span>
                                        </code>
                                    </p>
                                </a>
                                <hr class="mt-8 bg-neutral-700 rounded border-1 border-neutral-700">
                                <div class="mt-4 flex w-full text-center">
                                    <a href="item.php?i=1" class="inline-flex w-full justify-center items-center text-base font-medium text-center text-neutral-500 hover:text-blue-700 hover:animate-pulse">
                                        Customize
                                    </a>
                                </div>
                            </div>
                        </div>

                    <?php } ?>

                </div>

            </div>
            <!-- !Content Start Here -->

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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>

</html>
