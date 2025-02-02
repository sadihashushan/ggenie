<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genie Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-purple-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold text-purple-700 mb-4">Genie Login</h1>
        <form action="{{ route('genie.login') }}" method="POST" class="space-y-4">
            @csrf
            <input type="email" name="email" placeholder="Email" required 
                   class="w-full p-2 border border-purple-300 rounded-lg focus:ring focus:ring-purple-200">
            <input type="password" name="password" placeholder="Password" required 
                   class="w-full p-2 border border-purple-300 rounded-lg focus:ring focus:ring-purple-200">
            <button type="submit" class="w-full bg-purple-600 text-white p-2 rounded-lg hover:bg-purple-700">
                Login
            </button>
        </form>
        @if ($errors->any())
            <div class="text-red-500 mt-4">{{ $errors->first() }}</div>
        @endif
    </div>
</body>
</html>
