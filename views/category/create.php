<?php
declare(strict_types=1);
require_once '../../app/model/Category.php';

if (!empty($_POST)) {
    if (isset($_POST["name"]) && isset($_POST["slug"])) {
        $name = $_POST["name"];
        $slug = $_POST["slug"];
        $category = new Category($name, $slug);

        $category->create();
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>カテゴリーを登録する | 自作の家計簿アプリ</title>
</head>
<body>
    <h1>カテゴリーを登録する</h1>
    <form action="" method="post">
        <div>
            <h2>カテゴリー名</h2>
            <input type="text" name="name" required>
        </div>
        <div>
            <h2>スラッグ</h2>
            <input type="text" name="slug" required>
        </div>
        <div>
            <button type="submit">登録する</button>
        </div>
    </form>
</body>
</html>