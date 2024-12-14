<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить рецепт</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</head>
<body>
    <a href="{{ route('index') }}" style="text-decoration: none; color: white; background-color: green; padding: 10px 20px; border-radius: 5px;">Назад</a>
    <h1>Добавить рецепт</h1>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <form action="{{ route('recipes.create') }}" method="POST">
        @csrf
        <label for="name">Название рецепта:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" style="width: 400px" required>
        @error('name')
            <p style="color: red;">{{ $message }}</p>
        @enderror
        <br>

        <label for="description">Описание рецепта:</label>
        <textarea id="description" name="description" style="width: 400px" required>{{ old('description') }}</textarea>
        @error('description')
            <p style="color: red;">{{ $message }}</p>
        @enderror
        <br>

        <label for="ingredients">Ингредиенты:</label>
        <select id="ingredients" name="ingredients[]" multiple="multiple" required class="select2" style="width: 400px">
            @foreach($ingredients as $ingredient)
                <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
            @endforeach
        </select>
        @error('ingredients')
            <p style="color: red;">{{ $message }}</p>
        @enderror
        <br>

        <button type="submit">Добавить</button>
    </form>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'Выберите ингредиенты',
                allowClear: true
            });
        });
    </script>
</body>
</html>
