<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body>
  <h1 class="text-3xl font-bold underline bg-green-500">
    Hello world!
  </h1>
  <form action="{{ route('logout')}}" method="post">
    @csrf
    <button type="submit"> Logout </button>
  </form>
</body>
</html>