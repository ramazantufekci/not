<?php
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../../templates');
$twig = new \Twig\Environment($loader, [
    'cache' => __DIR__ . '/../../templates/cache',
]);

echo $twig->render('index.html.twig', ['name' => 'Fabien']);
