<?php

namespace core\models;

use database\DB;
use Exception;

class Model
{
    public static function getAllProduct(): array
    {
        try {
            return DB::connect()->query("SELECT * FROM `products`")->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $exception) {
            die($exception->getMessage());
        }

    }

    public static function getOneProduct($id): bool|array|null
    {

        $idString = DB::connect()->real_escape_string($id);

        return DB::connect()->query("SELECT * FROM `products` where `product_id` = '$idString'")->fetch_assoc();


    }


    public function addProduct(): void
    {
        $name = DB::connect()->real_escape_string($_POST['name']);
        $desc = DB::connect()->real_escape_string($_POST['desc']);
        $price = DB::connect()->real_escape_string($_POST['price']);
        $img = isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK ? $_FILES['img'] : null;

        if (empty($name) || empty($desc) || empty($price) ) {
            echo "<h1>Поля не могут быть пустыми</h1> <br>";
            echo "<a href='/home'>Вернутся домой</a>";
            die;
        }

        if ($img !== null) {
            $path = __DIR__ . "/../../../uploads";
            $fileName = uniqid() . '-' . $img['name'];

            if (!is_dir($path)) {
                mkdir($path);
            }

            move_uploaded_file($img['tmp_name'], "$path/$fileName");
            $imgPath = "uploads/$fileName";
        } else {
            $imgPath = "uploads/nt.png";
        }

        try {
            DB::connect()->query("INSERT INTO `products`(`product_name`, `product_description`, `product_price`, `product_img`) VALUES ('$name','$desc','$price','$imgPath')");
        } catch (Exception $exception) {
            die($exception->getMessage());
        }

        header("Location: /home");
        die;
    }

    public function updateProduct(): void
    {
        $id = DB::connect()->real_escape_string($_POST['id']);
        $name = DB::connect()->real_escape_string($_POST['name']);
        $desc = DB::connect()->real_escape_string($_POST['desc']);
        $price = DB::connect()->real_escape_string($_POST['price']);
        $img = isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK ? $_FILES['img'] : null;

        if (empty($name) || empty($desc) || empty($price) ) {
            echo "<h1>Поля не могут быть пустыми</h1> <br>";
            echo "<a href='#' onclick=history.back() >Вернуться назад</a>";
            die;
        }

        $product = DB::connect()->query("SELECT * FROM `products` where `product_id` = '$id'")->fetch_assoc();

        if (!$product) {
            echo "Такого продукта нет";
            die;
        }

        if ($img !== null) {
            $path = __DIR__ . "/../../../uploads";
            $fileName = uniqid() . '-' . $img['name'];

            if (!is_dir($path)) {
                mkdir($path);
            }

            move_uploaded_file($img['tmp_name'], "$path/$fileName");
            $imgPath = "uploads/$fileName";
        } else {
            $imgPath = $product['product_img'];
        }

        try {
            DB::connect()->query("UPDATE `products` SET `product_name`='$name',`product_description`='$desc',`product_price`='$price',`product_img`='$imgPath' WHERE `product_id` = '$id'");
        } catch (Exception $exception) {
            die($exception->getMessage());
        }

        header('Location: /home');
        die;
    }

    public function deleteProduct(): void
    {
        $id = DB::connect()->real_escape_string($_POST['id']);

        try {
            DB::connect()->query("DELETE FROM `products` WHERE `product_id` = '$id'");
        } catch (Exception $exception) {
            die($exception->getMessage());
        }
        header('Location: /home');
        die;

    }
}