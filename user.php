<?php
session_start();

if (!isset($_SESSION['auth'])) {
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
                            <h5 class="text-xl font-bold leading-none"> All Users</h5>
                        </div>
                        <div class="flow-root">
                            <ul role="list" class="divide-y divide-neutral-200 h-screen max-h-96 overflow-y-scroll pr-4">
                                <?php
                                include_once 'conn.php';
                                $query = mysqli_query($con, "SELECT * FROM user,role WHERE user.role_id=role.role_id AND user.role_id!=1 ORDER BY id DESC");

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
                                                <button class="p-1.5 text-sm bg-green-600 hover:bg-green-700 text-neutral-100 rounded-md">Details</button>
                                            </div>
                                            <!-- User Details Modal -->
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
