<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

$slug = $_GET['slug'];
$blogs = json_decode(file_get_contents('../data/blogs.json'), true);

$blog = array_filter($blogs, function($b) use ($slug) {
    return $b['slug'] == $slug;
});
$blog = reset($blog);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $author = $_POST['author'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image_url = $blog['image_url'];

    if (!empty($_FILES['image']['name'])) {
        $target_dir = "../images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $image_url = 'images/' . basename($_FILES["image"]["name"]);
    } else if (!empty($_POST['image_url'])) {
        $image_url = $_POST['image_url'];
    }

    foreach ($blogs as &$b) {
        if ($b['slug'] == $slug) {
            $b['author'] = $author;
            $b['title'] = $title;
            $b['content'] = $content;
            $b['image_url'] = $image_url;
            break;
        }
    }

    file_put_contents('../data/blogs.json', json_encode($blogs, JSON_PRETTY_PRINT));
    header('Location: dashboard.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog</title>
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
        <h2 class="text-2xl mb-6">Edit Blog</h2>
        <form method="POST" enctype="multipart/form-data" action="">
            <div class="mb-4">
                <label for="author" class="block text-gray-700">Uploaded by</label>
                <input type="text" id="author" name="author" value="<?= $blog['author'] ?>" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Blog heading</label>
                <input type="text" id="title" name="title" value="<?= $blog['title'] ?>" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label for="content" class="block text-gray-700">Blog body</label>
                <textarea id="content" name="content" class="w-full p-2 border border-gray-300 rounded" required><?= $blog['content'] ?></textarea>
            </div>
            <div class="mb-4">
                <label for="image" class="block text-gray-700">Blog image</label>
                <input type="file" id="image" name="image" class="w-full p-2 border border-gray-300 rounded">
                <p>Current Image: <img src="../<?= $blog['image_url'] ?>" alt="<?= $blog['title'] ?>" class="w-32 h-32 object-cover mt-2"></p>
            </div>
            <div class="mb-4">
                <label for="image_url" class="block text-gray-700">Image URL (Optional)</label>
                <input type="text" id="image_url" name="image_url" value="<?= $blog['image_url'] ?>" class="w-full p-2 border border-gray-300 rounded">
            </div>
            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Update</button>
        </form>
    </div>
</body>
</html>
