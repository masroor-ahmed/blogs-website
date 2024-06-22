<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <footer class="bg-gray-800 text-white p-8">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
            <div>
                <h2 class="text-xl font-bold mb-4">About Us</h2>
                <p>World's best blog website; Haha just kidding.
                    Yeh website abhi bs testing phase me hain.
                    Agr ap website pe hain tw mubarak ho.

                </p>
            </div>
            <div>
                <h2 class="text-xl font-bold mb-4">Quick Links</h2>
                <ul>
                    <li><a href="index.php" class="hover:text-secondary transition">Home</a></li>
                    <li><a href="about.php" class="hover:text-secondary transition">About</a></li>
                    <li><a href="contact.php" class="hover:text-secondary transition">Contact</a></li>
                    <li><a href="admin/login.php" class="hover:text-secondary transition">Admin</a></li>
                </ul>
            </div>
            <div>
                <h2 class="text-xl font-bold mb-4">Contact Us</h2>
                <p>Lahore, Punjab, Pakistan</p>
                <p>Email: maliktools35@gmail.com</p>
                <p>Phone: 001 hahahaha</p>
            </div>
        </div>
        <div class="mt-8 text-center">
            <p>&copy; <?= date('Y') ?> Blog.com . All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
