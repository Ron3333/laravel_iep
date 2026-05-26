<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <!-- Mostrar errores de validación -->
    @if ($errors->any())
    <div>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
         @endforeach
    </ul>
    </div>
    @endif
    <form method="POST" action="{{ route('register') }}">
            @csrf
        <div>
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
        </div>
        <div style="margin-top: 1rem;">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div style="margin-top: 1rem;">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        </div>
        <div style="margin-top: 1rem;">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" 
        required>
        </div>
        <div style="margin-top: 1rem;">
        <button type="submit">Register</button>
    </div>
</form>
</body>
</html>