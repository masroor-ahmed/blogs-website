<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

include '../includes/functions.php';
include 'create_blog_page.php';

$blogs = get_blogs();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $author = $_POST['author'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $slug = generate_slug($title);
    $description = $_POST['description'];
    $keywords = $_POST['keywords'];
    $image_url = '';

    if (!empty($_FILES['image']['name'])) {
        $target_dir = "../images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $image_url = 'images/' . basename($_FILES["image"]["name"]);
    } else if (!empty($_POST['image_url'])) {
        $image_url = $_POST['image_url'];
    }

    $blogs[] = [
        'author' => $author,
        'date' => date('Y-m-d'),
        'title' => $title,
        'content' => $content,
        'slug' => $slug,
        'description' => $description,
        'keywords' => $keywords,
        'image_url' => $image_url,
    ];

    save_blogs($blogs);
    create_blog_page($slug, $title, $description, $keywords, $content, $image_url, $author, date('Y-m-d'));
    header('Location: dashboard.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <nav class="bg-blue-500 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="dashboard.php" class="text-white font-bold text-xl">Admin Dashboard</a>
            <a href="logout.php" class="text-white">Logout</a>
        </div>
    </nav>

    <div class="container mx-auto py-8">
        <h2 class="text-2xl mb-6">Upload New Blog</h2>
        <form method="POST" enctype="multipart/form-data" action="">
            <div class="mb-4">
                <label for="author" class="block text-gray-700">Uploaded by</label>
                <input type="text" id="author" name="author" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Blog heading</label>
                <input type="text" id="title" name="title" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700">Page description</label>
                <input type="text" id="description" name="description" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label for="keywords" class="block text-gray-700">Keywords</label>
                <input type="text" id="keywords" name="keywords" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label for="content" class="block text-gray-700">Blog body</label>
                <textarea id="content" name="content" class="w-full p-2 border border-gray-300 rounded" required></textarea>
            </div>
            <div class="mb-4">
                <label for="image" class="block text-gray-700">Blog image</label>
                <input type="file" id="image" name="image" class="w-full p-2 border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label for="image_url" class="block text-gray-700">Image URL (Optional)</label>
                <input type="text" id="image_url" name="image_url" class="w-full p-2 border border-gray-300 rounded">
            </div>
            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Upload</button>
        </form>

        <h2 class="text-2xl mt-8 mb-4">Manage Posts</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php foreach ($blogs as $blog): ?>
            <div class="bg-white p-4 rounded shadow hover:shadow-lg">
                <img src="../<?= $blog['image_url'] ?>" alt="<?= $blog['title'] ?>" class="w-full h-32 object-cover mb-4">
                <h3 class="text-xl font-bold mb-2"><?= $blog['title'] ?></h3>
                <p class="text-gray-600 mb-2"><?= $blog['date'] ?> by <?= $blog['author'] ?></p>
                <a href="edit.php?slug=<?= $blog['slug'] ?>" class="text-blue-500">Edit</a> | 
                <a href="delete.php?slug=<?= $blog['slug'] ?>" class="text-red-500">Delete</a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
