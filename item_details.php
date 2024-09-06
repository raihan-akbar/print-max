<?php
session_start();

if (!isset($_SESSION['auth'])) {
    session_destroy();
    header("Location: signin.php?error=3");
}

// add item start
include_once 'conn.php';

if (isset($_GET['i'])) {
    if ($_GET['i'] == null) {
        header("Location: product.php");
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
                header("Location: product.php");
            }
        }
    }
}

// Size Add
if (isset($_POST['add-size'])) {
    $product_size_value = $_POST['product_size_value'];
    if ($product_size_value == null) {
        header("Location: items_details.php?i=$product_id");
    } else if ($product_size_value != null) {
        $product_size_price = $_POST['product_size_price'];
        $product_id = $_GET['i'];
        $size_insert_query = "INSERT INTO `product_size` VALUES (NULL, '$product_id', '$product_size_value', '$product_size_price')";
        $execute_size = mysqli_query($con, $size_insert_query);
        if ($execute_size) {
            header("Location: item_details.php?i=$product_id");
        }
    }
}
// Size Add End

// Type  Add
if (isset($_POST['add-type'])) {
    $product_type_value = $_POST['product_type_value'];
    if ($product_type_value == null) {
        header("Location: items_details.php?i=$product_id");
    } else if ($product_type_value != null) {
        $product_type_price = $_POST['product_type_price'];
        $product_id = $_GET['i'];
        $type_insert_query = "INSERT INTO `product_type` VALUES (NULL, '$product_id', '$product_type_value', '$product_type_price')";
        $execute_type = mysqli_query($con, $type_insert_query);
        if ($execute_type) {
            header("Location: item_details.php?i=$product_id");
        }
    }
}
// Type Add End



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

<?php while ($products = mysqli_fetch_array($query)) { ?>

    <body class="bg-slate-100">

        <?php include '_navside.php' ?>

        <div class="p-4 sm:ml-64">
            <div class="p-4 mt-12">
                <!-- Content Start Here -->
                <div class="w-full">
                    <h2 class="text-neutral-800 font-bold text-3xl">
                        Item Details
                    </h2>
                    <p class="text-neutral-700 font-medium">Manage Details of Item like size and variant/type here.</p>
                    <hr class="w-full bg-blue-950 rounded mt-4">
                    <section id="item" class="w-full mb-12 my-8">
                        <div class="flex flex-wrap justify-center px-2 lg:px-16 xl:px-16 gap-8 mt-2 ">

                            <div class="min-w-screen max-w-full xs:max-w-full sm:max-w-full md:max-w-full lg:max-w-6xl xl:max-w-6xl bg-white border border-neutral-200 rounded-lg shadow">
                                <a href="#">
                                    <img class="rounded-t-lg" src="assets/img/item/<?= $products['product_thumbnail']; ?>" alt="" />
                                </a>
                                <div class="p-5">
                                    <div class="columns-2">
                                        <div class="w-full">
                                            <h5 class="text-2xl font-bold tracking-tight text-neutral-900"><?= $products['product_name']; ?></h5>
                                        </div>
                                        <div class="w-full text-right">
                                            <h5 class="text-lg font-medium tracking-tight text-blue-700"><a class="cursor-pointer" data-modal-target="edit-product-modal" data-modal-toggle="edit-product-modal">Edit Product</a></h5>
                                        </div>

                                        <div class="w-full text-right">
                                            <h5 class="text-lg font-medium tracking-tight text-red-700"><a class="cursor-pointer" data-modal-target="delete-product-modal" data-modal-toggle="delete-product-modal">Delete Product</a></h5>
                                        </div>

                                        <!-- Delete Product Modal -->
                                        <div id="delete-product-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-md max-h-full">
                                                <div class="relative bg-white rounded-lg shadow">
                                                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="delete-product-modal">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                    <div class="p-4 md:p-5 text-center">
                                                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                        </svg>
                                                        <h3 class="mb-5 text-lg font-medium text-gray-500">Are you sure you want to delete <?= $products['product_name'] ?></h3>
                                                        <form action="details_helper.php" method="post">
                                                            <input type="hidden" name="product_id" value="<?= $products['product_id'] ?>">
                                                            <input type="hidden" name="cur_thumb" value="<?= $products['product_thumbnail'] ?>">
                                                            <button type="submit" name="delete-product" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                                Yes, Delete Product
                                                            </button>
                                                        </form>
                                                        <button data-modal-hide="delete-product-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">No, cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Edit Product modal -->
                                        <div id="edit-product-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow">
                                                    <!-- Modal header -->
                                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                                        <h3 class="text-lg font-semibold text-neutral-900">
                                                            Edit
                                                        </h3>
                                                        <button type="button" class="text-neutral-400 bg-transparent hover:bg-neutral-200 hover:text-neutral-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="edit-product-modal">
                                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <form class="p-4 md:p-5" method="post" action="details_helper.php?i=<?= $product_id ?>" enctype="multipart/form-data">
                                                        <div class="grid gap-4 mb-4 grid-cols-2">
                                                            <div class="col-span-2">
                                                                <label for="name" class="block mb-2 text-sm font-medium text-neutral-900">Item</label>
                                                                <input type="text" name="name" id="name" value="<?= $products['product_name'] ?>" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type item name" required="">
                                                            </div>
                                                            <div class="col-span-2 sm:col-span-1">
                                                                <label for="price" class="block mb-2 text-sm font-medium text-neutral-900">Item Price</label>
                                                                <div class="flex">
                                                                    <span class="inline-flex items-center px-3 text-sm font-medium text-neutral-900 bg-neutral-200 border border-s-0 border-neutral-300 rounded-s-md uppercase">
                                                                        Rp.
                                                                    </span>
                                                                    <input type="text" min="0" name="price" id="quantity-input" value="<?= $products['product_price'] ?>" data-input-counter data-input-counter-min="1" data-input-counter-max="9999999999" class="rounded-none rounded-e-lg bg-neutral-50 border border-neutral-300 text-neutral-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-md p-2.5 " placeholder="Price of 1 Item">
                                                                </div>
                                                            </div>
                                                            <div class="col-span-2 sm:col-span-1">
                                                                <label for="thumbnail" class="block mb-2 text-sm font-medium text-neutral-900">Photo of Item</label>
                                                                <input class="block w-full text-sm text-neutral-900 border border-neutral-300 rounded-lg cursor-pointer bg-neutral-50" id="file_input" name="thumbnails" type="file" accept="image/png, image/gif, image/jpeg, image/jpg">
                                                                <input type="hidden" name="cur_thumb" value="<?= $products['product_thumbnail'] ?>">
                                                                <input type="hidden" name="product_id" value="<?= $products['product_id'] ?>">
                                                                <p class="mt-1 text-xs text-neutral-700" id="file_input_help">Image File (Suggestion Size 900x600px).</p>
                                                            </div>
                                                            <div class="col-span-2">
                                                                <label for="description" class="block mb-2 text-sm font-medium text-neutral-900">Item Description</label>
                                                                <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-md text-neutral-900 bg-neutral-50 rounded-lg border border-neutral-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Write Item description here"><?= $products['product_desc'] ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="w-full pb-4">
                                                            <p class="text-sm w-full"><span class="text-red-700 font-bold text-lg">* </span>The recommended image size is 900x600 (px)</p>
                                                        </div>
                                                        <div class="w-full">
                                                            <button type="submit" name="edit-item" class="inline-flex w-full justify-center items-center px-3 py-2 text-md font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                                                Add New Item
                                                                <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
                                                                </svg>

                                                            </button>
                                                            <button type="button" name="cancel" class="inline-flex w-full justify-center items-center mt-4 text-md font-medium text-center text-neutral-500 hover:text-neutral-800" data-modal-toggle="add-item-modal">
                                                                Cancel
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Edit Product Modal End -->

                                    </div>
                                    <?php
                                    setlocale(LC_MONETARY, "ID");
                                    $price = $products['product_price'];
                                    $rp = number_format($price);
                                    ?>
                                    <p class="font-semibold text-lg text-blue-800">Rp. <span class=""><?php echo $rp; ?></span></p>
                                    <p class="font-semibold text-lg text-neutral-600"><?= $products['product_desc']; ?></p>
                                </div>
                            </div>

                            <div class="w-screen max-w-full xs:max-w-full sm:max-w-full md:max-w-full lg:max-w-full xl:max-w-md p-4 bg-white border border-neutral-200 rounded-lg shadow sm:p-6 md:p-8 space-y-4">
                                <div class="columns-2">
                                    <h5 class="text-xl font-bold text-neutral-900">Size</h5>
                                    <p class="text-right cursor-pointer">
                                        <a class="text-right text-blue-700 font-bold" data-modal-target="add-size-modal" data-modal-toggle="add-size-modal">Add <i class="fa fa-plus"></i></a>

                                        <!-- Add Size Modal -->
                                    <div id="add-size-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow">
                                                <!-- Modal header -->
                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                                    <h3 class="text-lg font-semibold text-neutral-900">
                                                        Add New Size for <?= $products['product_name'] ?>
                                                    </h3>
                                                    <button type="button" class="text-neutral-400 bg-transparent hover:bg-neutral-200 hover:text-neutral-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="add-size-modal">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <form class="p-4 md:p-5" method="post" action="item_details.php?i=<?= $products['product_id']; ?>" enctype="multipart/form-data">
                                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                                        <div class="col-span-2">
                                                            <label for="name" class="block mb-2 text-sm font-medium text-neutral-900">Size Label</label>
                                                            <input type="text" name="product_size_value" id="product_size_value" class="bg-neutral-50 font-medium border border-neutral-300 text-neutral-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Example: 10x10cm" required="">
                                                        </div>
                                                        <div class="col-span-2">
                                                            <label for="name" class="block mb-2 text-sm font-medium text-neutral-900">Add-on Price</label>
                                                            <div class="flex w-full">
                                                                <span class="inline-flex items-center px-3 text-sm font-medium text-neutral-900 bg-neutral-200 border border-s-0 border-neutral-300 rounded-s-md uppercase">
                                                                    Rp.
                                                                </span>
                                                                <input type="number" min="0" name="product_size_price" id="product_size_price" class="rounded-none rounded-e-lg bg-neutral-50 font-medium border border-neutral-300 text-neutral-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5 " placeholder="Add-on Size Price">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="w-full mt-8 mb-4">
                                                    <div class="w-full pb-4">
                                                        <p class="text-sm w-full"><span class="text-red-700 font-bold text-lg">* </span>You can leave add-on price blank if size doesn't have add-on price.</p>
                                                        <p class="text-sm w-full"><span class="text-red-700 font-bold text-lg">* </span>Put only Number in price, no need to put Point "." or Comma",".</p>
                                                    </div>
                                                    <div class="w-full">
                                                        <button type="submit" name="add-size" class="inline-flex w-full justify-center items-center px-3 py-2 text-md font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                                            Add New Item
                                                            <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
                                                            </svg>
                                                        </button>
                                                        <button type="button" name="cancel" class="inline-flex w-full justify-center items-center mt-4 text-md font-medium text-center text-neutral-500 hover:text-neutral-800" data-modal-toggle="add-size-modal">
                                                            Cancel
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Add Size Modal End -->

                                    </p>
                                </div>
                                <hr class="border-1 border-blue-950">
                                <div class="w-full">
                                    <?php
                                    $query = mysqli_query($con, "SELECT * FROM product_size WHERE product_id='$product_id' ");
                                    while ($size = mysqli_fetch_array($query)) {
                                        $size_id = $size['product_size_id'] ?>
                                        <form class="mb-4" method="post" action="details_helper.php">
                                            <div class="columns-2 gap-2">
                                                <div class="w-full gap-2">
                                                    <input type="text" name="product_size_value" id="product_size_value" value="<?= $size['product_size_value']; ?>" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type item name" required="">
                                                    <div class="flex pt-2">
                                                        <span class="inline-flex items-center px-3 text-sm font-medium text-neutral-900 bg-neutral-200 border border-s-0 border-neutral-300 rounded-s-md uppercase">
                                                            Rp.
                                                        </span>
                                                        <input type="text" min="0" name="product_size_price" id="quantity-input" value="<?= $size['product_size_price'] ?>" data-input-counter data-input-counter-min="1" data-input-counter-max="9999999999" class="rounded-none rounded-e-lg bg-neutral-50 border border-neutral-300 text-neutral-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-md p-2.5 " placeholder="Price of 1 Item">
                                                    </div>
                                                </div>
                                                <div class="w-full gap-2">
                                                    <input type="hidden" name="size_id" value="<?= $size_id ?>">
                                                    <input type="hidden" name="product_id" value="<?= $product_id ?>">
                                                    <button type="submit" name="size-remove" class="text-white w-full bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-3 me-2 mb-2 focus:outline-none dark:focus:ring-red-800 h-full mt-1">Remove</button>

                                                    <button type="submit" name="size-update" class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3 me-2 mb-2 focus:outline-none dark:focus:ring-blue-800">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                        <hr class="bg-neutral-100 mt-1">
                                    <?php } ?>
                                    <hr class="border-1 border-blue-100">

                                    <div class="mt-12 space-y-4">
                                        <div class="columns-2">
                                            <h5 class="text-xl font-bold text-neutral-900">Type</h5>
                                            <p class="text-right cursor-pointer"><a class="text-right text-blue-700 font-bold" data-modal-target="add-type-modal" data-modal-toggle="add-type-modal">Add <i class="fa fa-plus"></i></a></p>

                                            <!-- Add Type Modal -->
                                            <div id="add-type-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow">
                                                        <!-- Modal header -->
                                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                                            <h3 class="text-lg font-semibold text-neutral-900">
                                                                Add New type for <?= $products['product_name'] ?>
                                                            </h3>
                                                            <button type="button" class="text-neutral-400 bg-transparent hover:bg-neutral-200 hover:text-neutral-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="add-type-modal">
                                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <form class="p-4 md:p-5" method="post" action="item_details.php?i=<?= $products['product_id']; ?>" enctype="multipart/form-data">
                                                            <div class="grid gap-4 mb-4 grid-cols-2">
                                                                <div class="col-span-2">
                                                                    <label for="name" class="block mb-2 text-sm font-medium text-neutral-900">Type Label</label>
                                                                    <input type="text" name="product_type_value" id="product_type_value" class="bg-neutral-50 font-medium border border-neutral-300 text-neutral-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Example: Glossy" required="">
                                                                </div>
                                                                <div class="col-span-2">
                                                                    <label for="name" class="block mb-2 text-sm font-medium text-neutral-900">Add-on Price</label>
                                                                    <div class="flex w-full">
                                                                        <span class="inline-flex items-center px-3 text-sm font-medium text-neutral-900 bg-neutral-200 border border-s-0 border-neutral-300 rounded-s-md uppercase">
                                                                            Rp.
                                                                        </span>
                                                                        <input type="number" min="0" name="product_type_price" id="product_type_price" class="rounded-none rounded-e-lg bg-neutral-50 font-medium border border-neutral-300 text-neutral-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5 " placeholder="Add-on type Price">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr class="w-full mt-8 mb-4">
                                                            <div class="w-full pb-4">
                                                                <p class="text-sm w-full"><span class="text-red-700 font-bold text-lg">* </span>You can leave add-on price blank if size doesn't have add-on price.</p>
                                                                <p class="text-sm w-full"><span class="text-red-700 font-bold text-lg">* </span>Put only Number in price, no need to put Point "." or Comma",".</p>
                                                            </div>
                                                            <div class="w-full">
                                                                <button type="submit" name="add-type" class="inline-flex w-full justify-center items-center px-3 py-2 text-md font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                                                    Add New Item
                                                                    <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
                                                                    </svg>
                                                                </button>
                                                                <button type="button" name="cancel" class="inline-flex w-full justify-center items-center mt-4 text-md font-medium text-center text-neutral-500 hover:text-neutral-800" data-modal-toggle="add-type-modal">
                                                                    Cancel
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Add Size Modal End -->

                                        </div>
                                        <hr class="border-1 border-blue-950">
                                        <?php
                                        $query = mysqli_query($con, "SELECT * FROM product_type WHERE product_id='$product_id' ");
                                        while ($type = mysqli_fetch_array($query)) {
                                            $type_id = $type['product_type_id'] ?>
                                            <form class="mb-4" method="post" action="details_helper.php">
                                                <div class="columns-2 gap-2">
                                                    <div class="w-full gap-2">
                                                        <input type="text" name="product_type_value" id="product_type_value" value="<?= $type['product_type_value']; ?>" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type Value name" required="">
                                                        <div class="flex pt-2">
                                                            <span class="inline-flex items-center px-3 text-sm font-medium text-neutral-900 bg-neutral-200 border border-s-0 border-neutral-300 rounded-s-md uppercase">
                                                                Rp.
                                                            </span>
                                                            <input type="text" min="0" name="product_type_price" id="quantity-input" value="<?= $type['product_type_price'] ?>" data-input-counter data-input-counter-min="1" data-input-counter-max="9999999999" class="rounded-none rounded-e-lg bg-neutral-50 border border-neutral-300 text-neutral-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-md p-2.5 " placeholder="Price of 1 Item">
                                                        </div>
                                                    </div>
                                                    <div class="w-full gap-2">
                                                        <input type="hidden" name="type_id" value="<?= $type_id ?>">
                                                        <input type="hidden" name="product_id" value="<?= $product_id ?>">
                                                        <button type="submit" name="type-remove" class="text-white w-full bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-3 me-2 mb-2 focus:outline-none dark:focus:ring-red-800 h-full mt-1">Remove</button>

                                                        <button type="submit" name="type-update" class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3 me-2 mb-2 focus:outline-none dark:focus:ring-blue-800">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <hr class="bg-neutral-100 mt-1">
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
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
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    </body>
<?php } ?>

</html>
