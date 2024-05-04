<?php

use core\models\Model;

$title = "Главная страница";
include_once __DIR__ . '/components/head.component.php';

?>

<section>
    <h1>Добавление товара</h1>
    <form action="/addProduct" method="post" enctype="multipart/form-data">
        <input name="name" type="text" placeholder="имя"><br>
        <input name="desc" type="text" placeholder="описание"><br>
        <input name="price" type="number" step="any" placeholder="число с точкой"><br>
        <input name="img" type="file"><br>
        <button type="submit">send</button>
    </form>
</section>
<hr>
<h1>Товары</h1>
<section>

    <?php
        if (!Model::getAllProduct()) {
            echo 'Товаров нет';
            die;
        }

        foreach (Model::getAllProduct() as $product) {
            ?>
            <div style="background-color: aqua; width: 12rem;">
                <img src="<?= $product['product_img'] ?>" alt="" style="max-width: 200px"> <br>
                <strong><?= $product['product_name'] ?></strong> <br>
                <small><?= $product['product_description'] ?></small> <br>
                <p><?= $product['product_price'] ?> руб</p>
                <button>
                    <a href="/product?id=<?= $product['product_id'] ?>">Открыть</a>
                </button>
            </div>

            <?php
        }
    ?>
</section>
<hr>

<?php include_once __DIR__ . '/components/footer.component.php' ?>

