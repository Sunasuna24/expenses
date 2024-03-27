<?php
declare(strict_types=1);
require_once '../../app/model/Category.php';
require_once '../../app/model/Expense.php';
require_once '../../database/pdo.php';

try {
    $pdo_connection = new PDOConnection();
    $pdo = $pdo_connection->connect();
    $statement = $pdo->prepare('SELECT * FROM categories ORDER BY id;');
    $statement->execute();
} catch (PDOException $e) {
    echo $e->getMessage();
}

$fetchedCategories = $statement->fetchAll(PDO::FETCH_ASSOC);

$categories = [];
foreach ($fetchedCategories as $fCategory) {
    $category = new Category($fCategory['name'], $fCategory['slug']);
    $categories[] = $category;
}

if ($_POST) {
    if (isset($_POST['amount']) && isset($_POST['category_slug']) && isset($_POST['purpose'])) {
        $amount = (int)$_POST['amount'];
        $category_slug = $_POST['category_slug'];
        $purpose = $_POST['purpose'];
        $expense = new Expense($amount, $category_slug, $purpose);
        $expense->create();
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>支出を登録する | 自作の家計簿アプリ</title>
</head>
<body>
    <h1>支出を登録する</h1>
    <form action="" method="post">
        <div>
            <h2>金額</h2>
            <input type="number" name="amount" min="1" required>円
        </div>
        <div>
            <h2>カテゴリー</h2>
            <?php if (1 <= count($categories)): ?>
            <?php foreach ($categories as $category): ?>
            <div>
                <input type="radio" name="category_slug" value="<?= $category->getSlug(); ?>" id="<?= $category->getSlug(); ?>" required>
                <label for="<?= $category->getSlug(); ?>"><?= $category->getName(); ?></label>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <p>カテゴリーがありません。<a href="">こちら</a>から追加。</p>
            <?php endif; ?>
        </div>
        <div>
            <h2>用途</h2>
            <textarea name="purpose" id="" cols="30" rows="10" required></textarea>
        </div>
        <div>
            <?php if (1 <= count($categories)): ?>
            <button type="submit">登録する</button>
            <?php else: ?>
            <button type="submit" disabled>登録する</button>
            <?php endif; ?>
        </div>
    </form>
</body>
</html>