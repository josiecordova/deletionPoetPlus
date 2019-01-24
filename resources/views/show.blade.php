<!DOCTYPE html>
<html>
  <head>
    <title>Poem {{ $poem->id }}</title>
  </head>
  <body>
    <h1>Poem {{ $poem->id }}</h1>
    <ul>
      <li>Text: {{ $poem->text }}</li>
      <li>Model: {{ $poem->author }}</li>
      <li>Produced on: {{ $poem->authored_on }}</li>
    </ul>
  </body>
</html>