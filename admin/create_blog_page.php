<?php
function create_blog_page($slug, $title, $description, $keywords, $content, $image_url, $author, $date) {
    $template = file_get_contents('template.php');

    $template = str_replace("<?= \$blog['title'] ?>", $title, $template);
    $template = str_replace("<?= \$blog['description'] ?>", $description, $template);
    $template = str_replace("<?= \$blog['keywords'] ?>", $keywords, $template);
    $template = str_replace("<?= nl2br(\$blog['content']) ?>", nl2br($content), $template);
    $template = str_replace("<?= \$blog['image_url'] ?>", $image_url, $template);
    $template = str_replace("<?= \$blog['author'] ?>", $author, $template);
    $template = str_replace("<?= \$blog['date'] ?>", $date, $template);
    $template = str_replace("basename(__FILE__, '.php')", "'$slug'", $template);

    file_put_contents("../blogs/$slug.php", $template);
}

// Call this function after a blog is successfully added
// create_blog_page($slug, $title, $description, $keywords, $content, $image_url, $author, $date);
