<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поиск рецептов</title>
</head>
<body>
    <h1>Поиск рецептов по ингредиентам</h1>
    <form action="{{ route('search') }}" method="GET">
        <label for="ingredients">Введите ингредиенты (через запятую):</label>
        <input type="text" id="ingredients" name="ingredients" placeholder="Например: картофель, масло, соль" required>
        <button type="submit">Искать</button>
    </form>
    <div style="margin-top: 20px;">
        <a href="{{ route('recipes') }}" style="display: inline-block; margin-right: 10px; text-decoration: none; color: white; background-color: green; padding: 10px 20px; border-radius: 5px;">Добавить рецепт</a>
        <a href="{{ route('ingredients') }}" style="display: inline-block; text-decoration: none; color: white; background-color: blue; padding: 10px 20px; border-radius: 5px;">Добавить ингредиент</a>
    </div>
</body>
</html>