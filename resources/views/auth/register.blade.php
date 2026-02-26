<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Invoicing SaaS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">
<div class="max-w-md w-full bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-center mb-6">Create your Company Account</h2>

    <form action="{{ route('register') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium">Company Name</label>
            <input type="text" name="company_name" class="w-full border rounded-md p-2 mt-1">
        </div>
        <div>
            <label class="block text-sm font-medium">Your Name</label>
            <input type="text" name="name" class="w-full border rounded-md p-2 mt-1">
        </div>
        <div>
            <label class="block text-sm font-medium">Email Address</label>
            <input type="email" name="email" class="w-full border rounded-md p-2 mt-1">
        </div>
        <div>
            <label class="block text-sm font-medium">Password</label>
            <input type="password" name="password" class="w-full border rounded-md p-2 mt-1">
        </div>
        <div>
            <label class="block text-sm font-medium">Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full border rounded-md p-2 mt-1">
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">
            Register & Start Invoicing
        </button>
    </form>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    @endif
</div>
</body>
</html>
