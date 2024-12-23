<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поиск рецептов</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>Результаты поиска рецептов</h1>

    @if($recipes->isEmpty())
        <p style="text-align: center;">Рецепты не найдены.</p>
    @else
        <div class="recipes-container">
            @foreach ($recipes as $recipe)
                <div class="recipe">
                    <h2>{{ $recipe->name }}</h2>
                    <p>{{ $recipe->description }}</p>

                    <h3>Ингредиенты:</h3>
                    <ul>
                        @foreach ($recipe->ingredients as $ingredient)
                            <li class="{{ in_array($ingredient->id, $recipe->presentIngredients) ? 'present' : 'missing' }}">
                                {{ $ingredient->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    @endif
</body>
</html>
