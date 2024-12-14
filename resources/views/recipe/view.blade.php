<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поиск рецептов</title>
</head>
<body>
    <h1>Результаты поиска</h1>

    @if($recipes->isEmpty())
        <p>Рецепты не найдены.</p>
    @else
        <ul>
            @foreach($recipes as $recipe)
                <li>{{ $recipe->name }} - {{ $recipe->description }}</li>
            @endforeach
        </ul>
    @endif
</body>
</html>