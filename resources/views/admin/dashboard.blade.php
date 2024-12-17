<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
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
            <div style="border-style: solid; border-color: green; margin-bottom: 20px;">
                <h3>{{ $recipe->name }}</h3>
                <h4>{{ $recipe->description }}</h4>
                @foreach($recipe->ingredients as $ingredient)
                    <p>{{ $ingredient->name }}</p>
                @endforeach
                <a href="{{ route('search', ['recipe' => $recipe->id]) }}"><button style="margin-bottom: 10px;">Детальнее</button></a>
                <a href="{{ route('admin.delete', $recipe->id) }}"><button style="margin-bottom: 10px";>Удалить</button></a>
            </div>
        @endforeach
    @endif
</body>
</html>
