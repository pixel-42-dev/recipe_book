<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поиск рецептов</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="page">
    <header class="header">
        <img class="logo" src="{{ asset('icons/logo.svg') }}" alt="logo">
        <h1 class="title header__title">Поиск рецептов по ингредиентам</h1>
    </header>
    <main class="main">
        <section class="ingredients-section">
            <label class="main__label" for="ingredients">Выберите ингредиенты:</label>
            <form class="form" action="{{ route('search') }}" method="GET">
                <select id="ingredients" name="ingredients[]" multiple="multiple" required class="select2" style="width: 100%">
                    @foreach($ingredients as $ingredient)
                        <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                    @endforeach
                </select>
                <button class="search" type="submit">Искать</button>
            </form>
            <a class="add-recipe" href="{{ route('recipes') }}">Добавить рецепт</a>
        </section>
        <section class="instructions-section">
            <h2 class="title section__title">Инструкция по использованию:</h2>
                <ol class="items">
                    <li class="item">Для того, чтобы найти рецепт, вам необходимо выбрать ингредиенты из списка предложенных.</li>
                    <li class="item">После выбора ингредиентов нажмите на кнопку "Искать". Вам будет предложен список рецептов, в которых используются ваши ингредиенты.</li>
                    <li class="item">Если вы не нашли нужный вам рецепт, то помогите найти его остальным! Добавьте его с помощью кнопки "Добавить рецепт".</li>
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
            <p class="footer__text">Веселый коллектив, любим
            вкусно покушать</p>
        </div>
    </footer>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'Выберите ингредиенты',
                allowClear: true
            });
        });
    </script>
    </div>
</body>
</html>
