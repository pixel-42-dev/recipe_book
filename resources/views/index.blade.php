<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Поиск рецептов</title>

        <!-- Подключение CSS для Select2 -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('../css/style.css') }}">

        <!-- Подключение jQuery и JavaScript для Select2 -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    </head>
    <body class="page">
        <header class="header">
            <h1>Поиск рецептов по ингредиентам</h1>
        </header>
        <section class="section"></section>
        <footer class="footer"></footer>
        <form action="{{ route('search') }}" method="GET">
            <label for="ingredients">Выберите ингредиенты:</label>
            <select id="ingredients" name="ingredients[]" multiple="multiple" required class="select2" style="width: 100%">
                @foreach($ingredients as $ingredient)
                    <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                @endforeach
            </select>
            <button type="submit">Искать</button>
        </form>
        <a href="{{ route('recipes') }}" style="display: inline-block; margin-top: 10px; text-decoration: none; color: white; background-color: green; padding: 10px 20px; border-radius: 5px;">Добавить рецепт</a>

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
