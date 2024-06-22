<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Website</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<!-- index.php -->
<?php
include 'includes/header.php';
$blogs = json_decode(file_get_contents('data/blogs.json'), true);
?>

<div class="container mx-auto py-8">
    <input type="text" id="search" placeholder="Search blogs..." class="p-2 border border-gray-300 rounded mb-4">
    <div id="blog-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php foreach ($blogs as $blog): ?>
        <div class="bg-white p-4 rounded shadow hover:shadow-lg">
            <img src="<?= $blog['image_url'] ?>" alt="<?= $blog['title'] ?>" class="w-full h-48 object-cover mb-4">
            <h2 class="text-xl font-bold mb-2"><?= $blog['title'] ?></h2>
            <p class="text-gray-600 mb-2"><?= $blog['date'] ?> by <?= $blog['author'] ?></p>
            <a href="blog.php?slug=<?= $blog['slug'] ?>" class="text-blue-500">Read More</a>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="js/main.js"></script>



<script src="js/main.js"></script>

</body>
</html>
