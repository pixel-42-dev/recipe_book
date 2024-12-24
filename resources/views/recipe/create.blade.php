<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить рецепт</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
</head>
<body>
<div class="page">
    <header class="header">
        <img class="logo" src="{{ asset('icons/logo.svg') }}" alt="logo">
        <h1 class="header__title">Добавить рецепт</h1>
    </header>
    <main class="main">
        <section class="ingredients-section">
            @if(session('success'))
                <p style="color: green;">{{ session('success') }}</p>
            @endif
            <form action="{{ route('recipes.create') }}" method="POST">
                @csrf
                <div class="form-row">
                    <input class="select2 input__name" type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Название рецепта" required>
                    @error('name')
                    <p style="color: red;">{{ $message }}</p>
                    @enderror
                    <select id="ingredients" name="ingredients[]" multiple="multiple" required class="select2 select__ingredients">
                        @foreach($ingredients as $ingredient)
                            <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                        @endforeach
                    </select>
                    @error('ingredients')
                    <p style="color: red;">{{ $message }}</p>
                    @enderror
                </div>
                <textarea class="select2 description" id="description" name="description" placeholder="Описание рецепта" required>{{ old('description') }}</textarea>
                @error('description')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
                <div class="form-actions">
                    <button class="add-recipe" type="submit">Добавить рецепт</button>
                    <a class="add-ingredient" href="{{ route('ingredients') }}">Добавить ингредиент</a>
                </div>
            </form>
        </section>
        <section class="instructions-section">
            <h2 class="section__title">Инструкция по использованию:</h2>
            <ol class="items">
                <li class="item">В первую очередь напишите название вашего рецепта. Выберите необходимые ингредиенты. Если какой-то из них не был обнаружен, нажмите на кнопку “Добавить ингредиент”.</li>
                <li class="item">Постарайтесь как можно подробнее описать метод приготовления блюда в поле “Описание рецепта”.</li>
                <li class="item">После заполнения всех полей, вы можете нажать на кнопку “Добавить рецепт”.</li>
            </ol>
        </section>
    </main>
    <footer class="footer">
        <div class="connection__footer">
            <h2 class="footer__title">Как с нами связаться:</h2>
            <div class="connection-item">
                <img class="email-icon" src="{{ asset('icons/email.svg') }}" alt="email">
                <p class="footer__text">recipebook@gmail.com</p>
            </div>
            <div class="connection-item">
                <img class="phone-icon" src="{{ asset('icons/phone.svg') }}" alt="phone">
                <p class="footer__text">+7 (985)-599-55-35</p>
            </div>
            <div class="connection-item">
                <img class="telegram-icon" src="{{ asset('icons/telegram.svg') }}" alt="telegram">
                <p class="footer__text">@recipebook</p>
            </div>
        </div>
        <img class="qrcode" src="{{ asset('icons/qrcode.svg') }}" alt="qrcode">
        <div class="about__footer">
            <h2 class="footer__title">О нас:</h2>
            <p class="footer__text">Веселый коллектив, любим вкусно покушать</p>
        </div>
    </footer>
</div>
</body>
</html>
