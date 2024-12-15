<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>
    <h1>Вход в админ-панель</h1>
    @if ($errors->has('invalid'))
        <p style="color: red;">{{ $errors->first('invalid') }}</p>
    @endif
    <form method="POST" action="{{ url('/admin/login') }}">
        @csrf
        <div>
            <label for="username">Логин</label>
            <input type="text" id="username" name="username" value="{{ old('username') }}" required>
        </div>
        <div>
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Войти</button>
    </form>
</body>
</html>
