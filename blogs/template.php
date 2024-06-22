<?php
include '../header.php';

$slug = basename(__FILE__, '.php');
$blogs = json_decode(file_get_contents('../data/blogs.json'), true);

$blog = array_filter($blogs, function($b) use ($slug) {
    return $b['slug'] == $slug;
});
$blog = reset($blog);

if (!$blog) {
    header('HTTP/1.0 404 Not Found');
    echo "Blog not found!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $blog['title'] ?></title>
    <meta name="description" content="<?= $blog['description'] ?>">
    <meta name="keywords" content="<?= $blog['keywords'] ?>">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <?php include '../header.php'; ?>

    <div class="container mx-auto py-8">
        <h1 class="text-4xl font-bold mb-4"><?= $blog['title'] ?></h1>
        <p class="text-gray-600 mb-4"><?= $blog['date'] ?> by <?= $blog['author'] ?></p>
        <img src="../<?= $blog['image_url'] ?>" alt="<?= $blog['title'] ?>" class="w-full mb-4">
        <div class="prose">
            <?= nl2br($blog['content']) ?>
        </div>
        
        <div class="mt-8">
            <h2 class="text-2xl font-bold mb-4">Related Blogs</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php foreach ($blogs as $related_blog): ?>
                    <?php if ($related_blog['slug'] != $slug): ?>
                    <div class="bg-white p-4 rounded shadow hover:shadow-lg">
                        <img src="../<?= $related_blog['image_url'] ?>" alt="<?= $related_blog['title'] ?>" class="w-full h-32 object-cover mb-4">
                        <h3 class="text-xl font-bold mb-2"><?= $related_blog['title'] ?></h3>
                        <a href="../blogs/<?= $related_blog['slug'] ?>.php" class="text-blue-500">Read more</a>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <?php include '../footer.php'; ?>
</body>
</html>
