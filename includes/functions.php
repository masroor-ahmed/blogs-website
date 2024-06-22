<?php
function get_blogs() {
    return json_decode(file_get_contents(__DIR__ . '/../data/blogs.json'), true);
}

function save_blogs($blogs) {
    file_put_contents(__DIR__ . '/../data/blogs.json', json_encode($blogs, JSON_PRETTY_PRINT));
}

function generate_slug($title) {
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
}
