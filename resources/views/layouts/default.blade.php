<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Chivo:wght@400;700;900&family=Noto+Sans+JP:wght@300;400;500;700&display=swap"
    rel="stylesheet">
  @yield('css')
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  @yield('js')
  <title>Rese</title>
</head>

<body>
  @yield('content')

  @yield('js2')
</body>

</html>