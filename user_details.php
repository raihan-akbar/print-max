<?php
session_start();

if (!isset($_SESSION['auth'])) {
    session_destroy();
    header("Location: signin.php?error=3");
}

$role_name = $_SESSION['role_name'];

if ($role_name == 'staff') {
    session_destroy();
    header("Location: signin.php?error=3");
}

if (isset($_GET['i'])) {
    if ($_GET['i'] == null) {
        header("Location: user.php?");
    } else {
        include_once 'conn.php';
        $id = $_GET['i'];
        $id_check = is_numeric($id);

        if ($id_check != 1) {
            header("Location: user.php?");
        } else {
            $query = mysqli_query($con, "SELECT * FROM user,role WHERE user.role_id=role.role_id AND role.role_id != '1' AND user.id='$id' ");
            $user_check = mysqli_num_rows($query);
            if ($user_check != 1) {
                header("Location: user.php?");
            }
        }
    }
} else {
    header("Location: user.php?");
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

    <?php while ($user = mysqli_fetch_array($query)) { ?>
        <?php include '_navside.php' ?>

        <div class="p-4 sm:ml-64">
            <div class="p-4 mt-12">

                <!-- Content Start Here -->
                <div class="w-full">
                    <h2 class="text-neutral-800 font-bold text-3xl">
                        User Details
                    </h2>
                    <p class="text-neutral-700 font-medium">Showing Details for <?= $user['name'] ?>, and you have access to manage their data.</p>
                    <hr class="w-full bg-blue-950 rounded mt-4">
                </div>

                <form action="details_helper.php" method="post">
                    <div class="w-full">
                        <div class="mt-4">
                            <div class="w-full p-4 bg-neutral-50 border border-neutral-300 rounded-lg shadow-xl sm:p-8 space-y-4">
                                <?php
                                if ($user['user_status'] == 'Active') {
                                    $status_color = "green-700";
                                    $inverse_status_color = "red-700";
                                    $inverse_status = "Deactive";
                                } else {
                                    $status_color = "red-700";
                                    $inverse_status_color = "green-700";
                                    $inverse_status = "Active";
                                }
                                ?>
                                <div class="w-full columns-2">
                                    <div class="text-left">
                                        <h3 class="font-semibold text-xl text-neutral-700"><?= $user['name'] ?> is <span class="text-<?= $status_color ?>"><?= $user['user_status'] ?></span></h3>
                                    </div>
                                    <div class="text-right">
                                        <button class="font-semibold text-<?= $inverse_status_color ?>"><?= $inverse_status ?> User</button>
                                    </div>
                                </div>
                                <div class="w-full columns-1 lg:columns-2 gap-8 space-y-4">
                                    <div class="w-full">
                                        <label for="name" class="text-neutral-700 p-1 font-medium">Name</label>
                                        <input type="text" name="name" class="w-full rounded-lg bg-neutral-100 border-blue-950" placeholder="Insert Name" value="<?= $user['name'] ?>">
                                    </div>
                                    <div class="w-full">
                                        <label for="email" class="text-neutral-700 p-1 font-medium">Email Address</label>
                                        <input type="text" name="email" class="w-full rounded-lg bg-neutral-100 border-blue-950" placeholder="Insert Email Address" value="<?= $user['email'] ?>">
                                    </div>
                                </div>
                                <div class="w-full columns-1 lg:columns-2 gap-8 space-y-4">
                                    <div class="w-full">
                                        <label for="role" class="text-neutral-700 p-1 font-medium">Role</label>
                                        <select name="role" id="role" class="w-full rounded-lg bg-neutral-100 border-blue-950 p-2" required>
                                            <!-- <option selected disabled>-- Select Role</option> -->
                                            <option selected disabled value="<?= $user['role_id'] ?>"><?= $user['role_name'] ?></option>
                                            <?php
                                            include_once 'conn.php';
                                            $query = mysqli_query($con, "SELECT * FROM role WHERE role_id!='1' ");
                                            while ($role = mysqli_fetch_array($query)) { ?>
                                                <option value="<?= $role['role_id'] ?>"><?= $role['role_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="w-full">
                                        <label for="status" class="text-neutral-700 p-1 font-medium">User Status</label>
                                        <select name="status" id="status" class="w-full rounded-lg bg-neutral-100 border-blue-950 p-2" required>
                                            <!-- <option selected disabled>-- Select Role</option> -->
                                            <option selected disabled value="<?= $user['user_status'] ?>"><?= $user['user_status'] ?></option>
                                            <option value="Active">Active</option>
                                            <option value="Deactive">Deactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="w-full columns-1 gap-8 space-y-4">
                                    <div class="w-full text-right">
                                        <input name="uid" type="hidden" value="<?= $user['id'] ?>">
                                        <button type="submit" name="update_user_profile" class="text-center w-full rounded-lg bg-blue-700 p-2 text-neutral-100 font-semibold hover:bg-blue-800 lg:w-fit">Save Edited <i class="fa-regular fa-floppy-disk"></i></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>

                <form action="details_helper.php" method="post">
                    <div class="w-full">
                        <div class="mt-4">
                            <div class="w-full p-4 bg-neutral-50 border border-neutral-300 rounded-lg shadow-xl sm:p-8 space-y-4">
                                <div class="w-full">
                                    <h3 class="font-semibold text-xl text-neutral-700">Change Password</h3>
                                </div>
                                <div class="w-full columns-1 lg:columns-2 gap-8 space-y-4">
                                    <div class="w-full">
                                        <label for="password" class="text-neutral-700 p-1 font-medium">Insert New Password</label>
                                        <input name="new_password" type="password" class="w-full rounded-lg bg-neutral-100 border-blue-950" placeholder="Insert Password" ">
                                </div>
                                <div class=" w-full">
                                        <label for="password-2" class="text-neutral-700 p-1 font-medium">Re-type New Password</label>
                                        <input name="re_new_password" type="password" class="w-full rounded-lg bg-neutral-100 border-blue-950" placeholder="Insert Again Password" ">
                                </div>
                            </div>
                            <div class=" w-full columns-1 gap-8 space-y-4">
                                        <div class="w-full text-right">
                                            <input name="uid" type="hidden" value="<?= $user['id'] ?>">
                                            <button type="submit" name="update_user_password" class="text-center w-full rounded-lg bg-blue-700 p-2 text-neutral-100 font-semibold hover:bg-blue-800 lg:w-fit">Save New Password <i class="fa-brands fa-keycdn text-lg"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>

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

    <?php } ?>

</body>

</html>