<?php
session_start();

if (isset($_SESSION['auth'])) {
    header("Location: dashboard.php");
}

include_once 'conn.php';

if (isset($_POST['signin'])) {
    if (!isset($_POST['email'], $_POST['password'])) {
        header("Location: signin.php?error=0");
    } else if (isset($_POST['email'], $_POST['password'])) {

        $email  = $_POST['email'];
        $password = $_POST['password'];
        $user_check = "SELECT * FROM user,role WHERE user.email='$email' AND role.role_id=user.role_id ";
        $result = mysqli_query($con, $user_check);
        $row = mysqli_num_rows($result);
        
        if ($row == 1) {
            $data = mysqli_fetch_assoc($result);
            if (password_verify($password, $data['password'])) {
                header("Location: dashboard.php");
                // SESSION
                $_SESSION['auth']      = true;
                $_SESSION['id']        = $data['user_id'];
                $_SESSION['username']  = $data['username'];
                $_SESSION['email']     = $data['email'];
                $_SESSION['name']      = $data['name'];
                $_SESSION['role_id']   = $data['role_id'];
                $_SESSION['role_name'] = $data['role_name'];

            } else {
                header("Location: signin.php?error=2");
            }
        } else {
            header("Location: signin.php?error=1");
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRINT MAX</title>
    <link rel="icon" href="assets/img/system/sq-logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-blue-950">
    <main class="max-w-screen-2xl flex flex-wrap mx-auto p-4 h-full">
        <div class="w-full">
            <div class="flex justify-center mt-36">
                <div class="w-full lg:w-4/12 md:w-9/12 sm:w-full sm:mx-auto bg-white border border-blue-50 rounded-3xl shadow-2xl shadow-slate-400">
                    <div class="p-4 py-8">
                        <div class="grid justify-center place-items-center items-center">
                            <div class="w-20 text-blue-950">
                                <img src="assets/img/system/sq-logo.png" alt="">
                            </div>
                            <div>
                                <p class="text-red-700 font-medium p-2">
                                    <?php
                                    if (isset($_GET['error'])) {
                                        if ($_GET['error'] == 0) {
                                            echo 'Email dan Password Tidak Lengkap!';
                                        } else if ($_GET['error'] == 1) {
                                            echo 'Akun Tidak Ditemukan!';
                                        } else if ($_GET['error'] == 2) {
                                            echo 'Password Salah!';
                                        }else if ($_GET['error'] == 3) {
                                            echo 'Mohon Login!';
                                        }
                                    }
                                    else {
                                        echo "<span class='text-transparent'>.</span>";
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                        <form action="signin.php" method="post">
                            <label class="text-neutral-600 font-medium text-xs" for="email">Email</label>
                            <div class="py-2">
                                <input type="text" name="email" class="block mt-1 w-full text-neutral-900 border rounded-xl bg-neutral-100 focus:bg-neutral-100 focus:border-blue-400 focus:border-2 text-sm" placeholder="Email">
                            </div>
                            <div class="py-2">
                                <label class="text-neutral-600 font-medium text-xs" for="password">Password</label>
                                <input type="password" name="password" class="block mt-1 w-full text-neutral-900 border rounded-xl bg-neutral-100 focus:bg-neutral-100 focus:border-blue-400 focus:border-2 text-sm" placeholder="Password"">
                            </div>
                            <div class=" flex text-center justify-center py-2">
                                <button type="submit" name="signin" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-xl text-sm px-5 py-2.5 me-2 mb-2">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full text-center mt-14">
            <a href="/print-max" class="text-white text-sm">
                <p>Kembali ke Beranda</p>
            </a>
        </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

</body>

</html>
