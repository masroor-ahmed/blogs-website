<!-- blog.php -->
<?php
include 'includes/header.php';
$slug = $_GET['slug'];
$blogs = json_decode(file_get_contents('data/blogs.json'), true);
$blog = array_filter($blogs, function($b) use ($slug) {
    return $b['slug'] == $slug;
});
$blog = reset($blog);
?>

<div class="container mx-auto py-8">
    <img src="<?= $blog['image_url'] ?>" alt="<?= $blog['title'] ?>" class="w-full h-64 object-cover mb-4">
    <h1 class="text-3xl font-bold mb-4"><?= $blog['title'] ?></h1>
    <div class="text-gray-700 mb-8"><?= nl2br($blog['content']) ?></div>
    <h2 class="text-2xl font-bold mb-4">Related Blogs</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php foreach ($blogs as $related_blog): ?>
        <?php if ($related_blog['slug'] != $blog['slug']): ?>
        <a href="blog.php?slug=<?= $related_blog['slug'] ?>" class="bg-white p-4 rounded shadow hover:shadow-lg">
            <img src="<?= $related_blog['image_url'] ?>" alt="<?= $related_blog['title'] ?>" class="w-full h-32 object-cover mb-2">
            <h3 class="text-lg font-bold"><?= $related_blog['title'] ?></h3>
        </a>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
