<?php
include_once 'conn.php';

// Remove Size
if (isset($_POST['size-remove'])) {
    $size_id = $_POST['size_id'];
    $product_id = $_POST['product_id'];
    $size_delete  = "DELETE FROM product_size WHERE product_size_id = $size_id";
    $execute = mysqli_query($con, $size_delete);

    if ($execute) {
        header("Location: item_details.php?i=" . $product_id);
    } else {
        header('Location: item_details.php?i=' . $product_id);
    }
}

// Size Update
if (isset($_POST['size-update'])) {
    $size_id = $_POST['size_id'];
    $product_id = $_POST['product_id'];
    $product_size_price = $_POST['product_size_price'];
    $product_size_value = $_POST['product_size_value'];
    if ($product_size_value == null) {
        header("Location: items_details.php?i=$product_id");
    } else if ($product_size_value != null) {
        $size_update = "UPDATE `product_size` SET `product_size_value` = '$product_size_value', `product_size_price` = '$product_size_price' WHERE `product_size_id` = $size_id;";
        $execute = mysqli_query($con, $size_update);
        if ($execute) {
            header("Location: item_details.php?i=" . $product_id);
        } else {
            header('Location: item_details.php?i=' . $product_id);
        }
    }
}


// Remove Size
if (isset($_POST['type-remove'])) {
    $type_id = $_POST['type_id'];
    $product_id = $_POST['product_id'];
    $type_delete  = "DELETE FROM product_type WHERE product_type_id = $type_id";
    $execute = mysqli_query($con, $type_delete);

    if ($execute) {
        header("Location: item_details.php?i=" . $product_id);
    } else {
        header('Location: item_details.php?i=' . $product_id);
    }
}

// Type Update
if (isset($_POST['type-update'])) {
    $type_id = $_POST['type_id'];
    $product_id = $_POST['product_id'];
    $product_type_price = $_POST['product_type_price'];
    $product_type_value = $_POST['product_type_value'];
    if ($product_type_value == null) {
        header("Location: items_details.php?i=$product_id");
    } else if ($product_type_value != null) {
        $type_update = "UPDATE `product_type` SET `product_type_value` = '$product_type_value', `product_type_price` = '$product_type_price' WHERE `product_type_id` = $type_id;";
        $execute = mysqli_query($con, $type_update);
        if ($execute) {
            header("Location: item_details.php?i=" . $product_id);
        } else {
            header('Location: item_details.php?i=' . $product_id);
        }
    }
}

// Edit Product
if (isset($_POST['edit-item'])) {
    if (!isset($_POST['name'], $_POST['price'], $_POST['description'])) {
        header("Location: product.php?i=2");
    } else if (isset($_POST['name'], $_POST['price'], $_POST['description'])) {
        $product_id = $_POST['product_id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $thumbnails = $_FILES["thumbnails"]["name"];
        $cur_thumb = $_POST['cur_thumb'];
        if ($description == null) {
            $description = $name;
        }
        if ($thumbnails == null) {
            $rename = $cur_thumb;
        } else {
            $allowed_ext = array("jpg", "png", "jpeg", "gif");
            $ext = explode(".", $_FILES['thumbnails']['name']);
            $end = end($ext);
            $rename = random_int(100, 999) . round(microtime(true) * 9) . random_int(100, 999) . "." . $end;
            move_uploaded_file($_FILES["thumbnails"]["tmp_name"], "assets/img/item/" . $rename);
            unlink("assets/img/item/" . $cur_thumb);
        }

        $update_query = "UPDATE `product` SET `product_name` = '$name', `product_thumbnail` = '$rename', `product_desc` = '$description', `product_price` = '$price' WHERE `product`.`product_id` = '$product_id';
";

        $execute = mysqli_query($con, $update_query);
        if ($execute) {
            header("Location: item_details.php?i=" . $product_id);
        } else {
            header("Location: item_details.php?i=" . $product_id);
        }
    } else {
        header("Location: item_details.php?i=" . $product_id);
    }
}

// Delete Product
if (isset($_POST['delete-product'])) {
    $product_id = $_POST['product_id'];

    $delete_query = "DELETE FROM product WHERE product_id='$product_id' ";
    $execute = mysqli_query($con, $delete_query);

    if ($execute) {
        unlink("assets/img/item/" . $cur_thumb);
        header("Location: product.php?");
    } else {
        header("Location: product.php?id=");
    }
}

// Add Order

if (isset($_POST['add-order'])) {
    $name = $_POST['name'];
    $product_name = $_POST['product_name'];
    $size = $_POST['size'];
    $type = $_POST['type'];
    $qty = $_POST['qty'];
    $total = $_POST['total'];
    $book_date = $_POST['book_date'];
    // $status = '2';

    $insert_query = "INSERT INTO `book` (`book_id`, `book_by`, `product_name`, `size`, `type`, `qty`, `total`, `status`, `book_date`) VALUES (NULL, '$name', '$product_name', '$size', '$type', '$qty', '$total', '2', '$book_date');";

    $execute = mysqli_query($con, $insert_query);
    if ($execute) {
        header("Location: order.php");
    } else {
        header("Location: order.php?");
    }
}

if (isset($_POST['done-order'])) {
    $book_id = $_POST['book_id'];

    $update_query = "UPDATE `book` SET `status` = '1' WHERE `book`.`book_id` = $book_id;";

    $execute = mysqli_query($con, $update_query);
    if ($execute) {
        header("Location: order.php");
    } else {
        header("Location: order.php?");
    }
}

if (isset($_POST['cancel-order'])) {
    $book_id = $_POST['book_id'];

    $update_query = "UPDATE `book` SET `status` = '3' WHERE `book`.`book_id` = $book_id;";

    $execute = mysqli_query($con, $update_query);
    if ($execute) {
        header("Location: order.php");
    } else {
        header("Location: order.php?");
    }
}


if (isset($_POST['progress-order'])) {
    $book_id = $_POST['book_id'];

    $update_query = "UPDATE `book` SET `status` = '2' WHERE `book`.`book_id` = $book_id;";

    $execute = mysqli_query($con, $update_query);
    if ($execute) {
        header("Location: order.php");
    } else {
        header("Location: order.php?");
    }
}

if (isset($_POST['pending-order'])) {
    $book_id = $_POST['book_id'];

    $update_query = "UPDATE `book` SET `status` = '4' WHERE `book`.`book_id` = $book_id;";

    $execute = mysqli_query($con, $update_query);
    if ($execute) {
        header("Location: order.php");
    } else {
        header("Location: order.php?");
    }
}


if (isset($_POST['add-user'])) {
    if (!isset($_POST['role'])) {
        header("Location: user.php?not_inserted");
    } else {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role_id = $_POST['role'];

        // encrypt user password using bcrypt
        $options = [
            'cost' => 12
        ];
        $encrypt = password_hash($password, PASSWORD_BCRYPT, $options);

        $user_status = "Active";

        $email_check = "SELECT * FROM user WHERE email='$email' ";
        $result = mysqli_query($con, $email_check);
        $email_row = mysqli_num_rows($result);

        if ($email_row != 0) {
            header("Location: user.php?");
        } else {
            $insert_query = "INSERT INTO `user` (`id`, `name`, `email`, `password`, `role_id`, `user_status`) VALUES (NULL, '$name', '$email', '$encrypt', '$role_id', 'Active');";

            $execute = mysqli_query($con, $insert_query);
            if ($execute) {
                header("Location: user.php");
            } else {
                // echo 'No redirect means query failed';
                header("Location: user.php?");
            }
        }
    }
}

if (isset($_POST['update_user_profile'])) {
    $uid = $_POST['uid'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $status = $_POST['status'];

    if ($role == null) {
        $role = '2';
    }

    $email_check = "SELECT * FROM user WHERE email='$email' ";
    $result = mysqli_query($con, $email_check);
    $email_row = mysqli_num_rows($result);

    if ($email_row != 0) {
        header("Location: user_details.php?i=" . $uid);
    } else {
        header("Location: item_details.php?i=" . $uid);
    }
    $update_query = "UPDATE `user` SET `name` = '$name', `email` = '$email',  `role_id` = '$role' WHERE `user`.`id` = $uid;";

    $execute = mysqli_query($con, $update_query);
    if ($execute) {
        header("Location: user_details.php?i=" . $uid);
    } else {
        header("Location: user_details.php?i=" . $uid);
    }
} else {
    header("Location: item_details.php?i=" . $uid);
}
