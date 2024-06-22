<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

include '../includes/functions.php';

$slug = $_GET['slug'];
$blogs = get_blogs();
$blogs = array_filter($blogs, function($blog) use ($slug) {
    return $blog['slug'] != $slug;
});
save_blogs($blogs);

if (file_exists("../blogs/$slug.php")) {
    unlink("../blogs/$slug.php");
}

header('Location: dashboard.php');
