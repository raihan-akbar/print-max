<?php
session_start();

if (!isset($_SESSION['auth'])) {
    session_destroy();
    header("Location: signin.php?error=3");
}

$role_name = $_SESSION['role_name'];

if ($role_name == 'Staff') {
    session_destroy();
    header("Location: signin.php?error=3");
}

// add item start
include_once 'conn.php';


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
                    Users
                </h2>
                <p class="text-neutral-700 font-medium">Admin or Higher Access can manage all user in this system.</p>
                <hr class="w-full bg-blue-950 rounded mt-4">
            </div>

            <div class="w-full">
                <div class="mt-4">
                    <div class="w-full p-4 bg-neutral-50 border border-neutral-300 rounded-lg shadow-xl sm:p-8">
                        <div class="flex items-center justify-between mb-4">
                            <div class="columns-1 md:columns-2 w-full">
                                <div class="w-full text-left">
                                    <h5 class="text-xl font-bold leading-none text-xl py-2"> All Users</h5>
                                </div>
                                <div class="w-full text-right pr-6">
                                    <button class="p-2 bg-blue-600 hover:bg-blue-700 text-neutral-100 rounded-md font-semibold sm:w-full md:w-fit" data-modal-target="add-user-modal" data-modal-toggle="add-user-modal">Add New User</button>
                                </div>
                                <!-- Main modal -->
                                <div id="add-user-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow">
                                            <!-- Modal header -->
                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                                <h3 class="text-lg font-semibold text-neutral-900">
                                                    Add New User
                                                </h3>
                                                <button type="button" class="text-neutral-400 bg-transparent hover:bg-neutral-200 hover:text-neutral-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="add-user-modal">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <form class="p-4 md:p-5" method="post" action="details_helper.php" enctype="multipart/form-data">
                                                <div class="grid gap-4 mb-4 grid-cols-2">
                                                    <div class="col-span-2">
                                                        <label for="name" class="block mb-2 text-sm font-medium text-neutral-900">Full Name</label>
                                                        <input type="text" name="name" id="name" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Insert Name" required="">
                                                    </div>
                                                    <div class="col-span-2">
                                                        <label for="email" class="block mb-2 text-sm font-medium text-neutral-900">Email Address</label>
                                                        <input type="text" name="email" id="email" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Insert Email Address" required="">
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label for="password" class="block mb-2 text-sm font-medium text-neutral-900">Password</label>
                                                        <input type="password" name="password" id="password" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="User Password" required="">
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label for="role" class="block mb-2 text-sm font-medium text-neutral-900">Role</label>
                                                        <select name="role" id="role" class="bg-neutral-50 border border-neutral-300 text-neutral-900 text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                                                            <option selected disabled>-- Select Role</option>
                                                            <?php
                                                            include_once 'conn.php';
                                                            $query = mysqli_query($con, "SELECT * FROM role WHERE role_id!='1' ");
                                                            while ($role = mysqli_fetch_array($query)) { ?>
                                                                <option value="<?= $role['role_id'] ?>"><?= $role['role_name'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="w-full pb-4">
                                                    <p class="text-sm w-full"><span class="text-blue-950 font-bold text-lg">* </span>
                                                        Do not share the password with anyone except the account owner.
                                                    </p>
                                                </div>
                                                <div class="w-full">
                                                    <button type="submit" name="add-user" class="inline-flex w-full justify-center items-center px-3 py-2 text-md font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                                        Save New User
                                                        <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
                                                        </svg>

                                                    </button>
                                                    <button type="button" name="cancel" class="inline-flex w-full justify-center items-center mt-4 text-md font-medium text-center text-neutral-500 hover:text-neutral-800" data-modal-toggle="add-user-modal">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal End -->

                            </div>
                        </div>
                        <hr class="pb-8 mr-6">
                        <div class="flow-root">
                            <ul role="list" class="divide-y divide-neutral-200 h-screen max-h-96 overflow-y-scroll pr-4">
                                <?php
                                include_once 'conn.php';
                                $query = mysqli_query($con, "SELECT * FROM user,role WHERE user.role_id=role.role_id AND user.role_id!=1 ORDER BY id ASC");

                                while ($user = mysqli_fetch_array($query)) {
                                ?>
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center">
                                            <div class="flex-1 min-w-0">
                                                <p class="text-lg font-medium text-neutral-900 truncate">
                                                    <?= $user['name'] ?>
                                                </p>
                                                <p class="text-md text-neutral-500 truncate space-x-">
                                                    <?php
                                                    if ($user['user_status'] == 'Active') {
                                                        $color = 'green';
                                                    } else if ($user['user_status'] == 'Deactive') {
                                                        $color = 'red';
                                                    } else {
                                                        $color = 'neutral';
                                                    }
                                                    ?>
                                                    <span class="bg-<?= $color; ?>-100 text-<?= $color; ?>-800 text-xs font-medium me-2 px-1 py-0.5 rounded"><?= $user['user_status'] ?></span>
                                                    <span><?= $user['role_name'] ?></span>
                                                </p>
                                            </div>
                                            <div class="inline-flex items-center text-base font-semibold text-neutral-900 space-x-1">
                                                <a class="p-1.5 text-sm bg-green-600 hover:bg-green-700 text-neutral-100 rounded-md" href="user_details.php?i=<?= $user['id'] ?>">Details</a>
                                            </div>
                                        </div>

                                    </li>

                                <?php } ?>

                            </ul>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- Tables End -->
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
