<?php
$db = getDbConnection();
$result = $db->query("SELECT * FROM posts ORDER BY id DESC LIMIT 10");
if (!$result) {
    echo "error";
    die();
}

$posts = $result->fetchAll(PDO::FETCH_ASSOC);
if (!$posts) {
    echo "no posts";
    die;
}

$postUserIds = array_column($posts, "user_id");
$userIdsStr = implode(",", array_unique($postUserIds)); //Он удаляет второй пост от пользователя?
$result = $db->query("SELECT * FROM users WHERE id IN($userIdsStr)");
$users = $result->fetchAll(PDO::FETCH_ASSOC);

$usersById = array_combine(
    array_column($users, "id"),
    $users
);
?>

<?php foreach ($posts as $post): ?>
    <div class="post">
        <span class="user">Message from<b><?=$usersById[$post["user_id"]]["name"]?></b> отправлено <?=$post["datetime"]?></span>
        <div class="message"><?=htmlspecialchars($post["message"])?></div>
        <? if (file_exists("../../images/" . $post["id"] . ".jpg")):?>
            <img src="image.php/?id=<?=$post["id"];?>">
        <? endif; ?>
    </div>
<?php endforeach;?>

<style>
    .post {
        border: 1px solid black;
    }
</style>
