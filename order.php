<?php
session_start();

if (!isset($_SESSION['auth'])) {
   session_destroy();
   header("Location: signin.php?error=3");
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
      <div class="p-4 mt-14">

      <!-- Content Start Here -->

      <!-- !Content Start Here -->

      </div>
   </div>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>
