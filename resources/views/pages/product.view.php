<?php

use core\models\Model;

$id = $_GET['id'];

$title = "Продукт № $id";
include_once __DIR__ . '/components/head.component.php';


$product = Model::getOneProduct($id);

if (!$product) {
    http_response_code(404);
    echo "<h1>Товар не найден</h1>";
    die;
}

?>
    <main>

        <h1>Продукт № <?= $product['product_id'] ?></h1>

        <img src="<?= $product['product_img'] ?>" alt="da" style="max-width: 200px"> <br>
        <strong><?= $product['product_name'] ?></strong> <br>
        <small><?= $product['product_description'] ?></small> <br>
        <p><?= $product['product_price'] ?> руб</p>
        <br>
        <hr>

        <section>
            <form action="/updateProduct" method="post" enctype="multipart/form-data">
                <input name="id" type="hidden"  value="<?= $product['product_id'] ?>">
                <input name="name" type="text" placeholder="имя" value="<?= $product['product_name'] ?>"><br>
                <input name="desc" type="text" placeholder="описание" value="<?= $product['product_description'] ?>" ><br>
                <input name="price" type="number" step="any" placeholder="число с точкой" value="<?= $product['product_price'] ?>"><br>
                <input name="img" type="file" value="<?= $product['product_img'] ?>"><br>
                <button type="submit">send</button>
            </form>
        </section>
        <br>
        <br>
        <section>
            <form action="/deleteProduct" method="post" >
                <input name="id" type="hidden"  value="<?= $product['product_id'] ?>">
                <button type="submit">delete</button>
            </form>
        </section>

    </main>

<?php include_once __DIR__ . '/components/footer.component.php' ?>