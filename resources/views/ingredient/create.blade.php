<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить ингредиент</title>
</head>
<body>
    <a href="{{ route('index') }}" style="text-decoration: none; color: white; background-color: green; padding: 10px 20px; border-radius: 5px;">Назад</a>
    <h1>Добавить ингредиент</h1>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <form action="{{ route('ingredients.create') }}" method="POST">
        @csrf

        <label for="name">Название ингредиента:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        @error('name')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <label for="description">Описание ингредиента:</label>
        <textarea id="description" name="description" required>{{ old('description') }}</textarea>
        @error('description')
            <p style="color: red;">{{ $message }}</p>
        @enderror
        
        <button type="submit">Добавить</button>
    </form>
</body>
</html>
