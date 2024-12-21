<!DOCTYPE html>
<html>
<head>
    <title>Редактирование рецепта</title>
</head>
<body>
    <h1>Редактирование рецепта: {{ $recipe->name }}</h1>

    <form action="{{ route('admin.recipe.update', $recipe->id) }}" method="POST">
        @csrf

        <label for="description">Описание рецепта:</label><br>
        <textarea id="description" name="description" rows="4" cols="50" required>{{ old('description', $recipe->description) }}</textarea><br>

        <button type="submit">Сохранить изменения</button>
        <a href="{{ route('admin.dashboard') }}"><button type="button">Отмена</button></a>
    </form>

    @if ($errors->any())
        <div style="color: red;">
            <h4>Ошибки:</h4>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>
