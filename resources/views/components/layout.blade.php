<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf8">
        <title>{{ $title ?? 'Laravel France : Les bases' }}</title>
    </head>
    <body>
        <header><h1><a href="/">Laravel France: Les bases</a></h1></header>
        <main>{{ $slot }}</main>
    </body>
</html>
