<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .navbar-scroll {
            transition: background-color 0.3s ease;
        }
        
        .navbar-scroll.scrolled {
            background-color: rgba(52, 152, 219, 0.9);
        }
    </style>
</head>
<body class="bg-gray-100 text-textDark">
    <nav class="navbar-scroll bg-primary text-white p-4 fixed w-full z-10">
        <div class="container mx-auto flex justify-between items-center">
            <a href="index.php" class="text-white font-bold text-xl">Blog</a>
            <div class="space-x-4">
                <a href="index.php" class="hover:text-secondary transition">Home</a>
                <a href="about.php" class="hover:text-secondary transition">About</a>
                <a href="contact.php" class="hover:text-secondary transition">Contact</a>
                <a href="admin/login.php" class="hover:text-secondary transition">Admin</a>
            </div>
        </div>
    </nav>

    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-scroll');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
                navbar.style.backgroundColor = 'blue';
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>
