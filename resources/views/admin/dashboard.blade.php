<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <script>
        function confirmRecipeDelete(event, recipeId) {
            event.preventDefault();  // Отменяем обычное поведение ссылки

            // Диалоговое окно подтверждения
            const confirmation = confirm('Вы уверены, что хотите удалить этот рецепт?');

            if (confirmation) {
                // Если пользователь подтвердил, отправляем форму
                document.getElementById('delete-form-' + recipeId).submit();
            }
        }
        function confirmIngredientDelete(event, recipeId, ingredientId) {
            event.preventDefault();  // Отменяем обычное поведение ссылки

            // Диалоговое окно подтверждения
            const confirmation = confirm('Вы уверены, что хотите удалить этот ингредиент?');

            if (confirmation) {
                // Если пользователь подтвердил, отправляем форму
                document.getElementById('delete-form-' + recipeId + '-' + ingredientId).submit();
            }
        }
    </script>
</head>
<body>
    <h1>Добро пожаловать в админ-панель</h1>
    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit">Выйти</button>
    </form>
    <h2>Список рецептов:</h2>

    @if($recipes->isEmpty())
        <p>В базе данных нет рецептов.</p>
    @else
        @foreach($recipes as $recipe)
            <div style="border-style: solid; border-color: green; margin-bottom: 20px; width: 400px">
                <h3>{{ $recipe->name }}</h3>
                <h4>{{ $recipe->description }}</h4>
                @foreach($recipe->ingredients as $ingredient)
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding: 10px; width: parent; border-bottom: solid; border-color: green;">
                        <h5>{{ $ingredient->name }}</h5>
                         <!-- <a href="{{ route('admin.ingredient.delete', ['recipeId' => $recipe->id, 'ingredientId' => $ingredient->id]) }}"><button style="margin-bottom: 10px";>Удалить</button></a> -->
                         <form
                            id="delete-form-{{ $recipe->id }}-{{ $ingredient->id }}"
                            action="{{ route('admin.ingredient.delete', ['recipeId' => $recipe->id, 'ingredientId' => $ingredient->id]) }}"
                            method="POST"
                            style="display: none;">
                            @csrf
                            @method('GET')
                        </form>
                         <a href="#" onclick="confirmIngredientDelete(event, {{ $recipe->id }}, {{ $ingredient->id }})">
                            <button style="margin-bottom: 10px;">Удалить</button>
                        </a>
                    </div>
                @endforeach
                <a href="{{ route('search', ['ingredients' => $recipe->ingredients->pluck('id')->toArray()]) }}"><button style="margin-bottom: 10px;">Детальнее</button></a>
                <form
                        id="delete-form-{{ $recipe->id }}"
                        action="{{ route('admin.recipe.delete', $recipe->id) }}"
                        method="POST"
                        style="display: none;">
                        @csrf
                        @method('GET')
                    </form>
                <a href="#" onclick="confirmRecipeDelete(event, {{ $recipe->id }})"><button style="margin-bottom: 10px";>Удалить</button></a>
            </div>
        @endforeach
    @endif
</body>
</html>
