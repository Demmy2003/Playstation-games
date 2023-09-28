<?php
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playstation Games</title>
    <!-- Include your CSS and JavaScript files, if necessary -->
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/games">Games</a></li>
                <!-- Add more navigation links as needed -->
            </ul>
        </nav>
    </header>

    <main>
@yield('content') <!-- This is where the content from each view will be injected -->
</main>

<footer>
    <!-- Footer content -->
</footer>

<!-- Include your JavaScript files, if necessary -->
</body>
</html>
