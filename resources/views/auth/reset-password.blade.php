<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Reset Password - UPA BAHASA POLINEMA</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body {
            background: url('{{ asset("assets/img/graha.png") }}') no-repeat center center fixed;
            background-size: cover;
            position: relative;
            min-height: 100vh;
        }
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }
        .login-container {
            position: relative;
            z-index: 10;
        }
        .card-shadow {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <!-- overlay warna biru transparan -->
    <div class="overlay"></div>

    <div class="login-container min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md bg-white rounded-lg card-shadow overflow-hidden">
            <!-- Header -->
            <div style="background-color: #007bff;" class="px-6 py-4">
                <div class="flex items-center justify-center">
                    <img src="{{ asset('assets/img/Logo Polinema.png') }}" alt="Logo" class="h-12 mr-3" />
                    <h2 class="text-white text-xl font-bold">UPA BAHASA POLINEMA</h2>
                </div>
                <p class="text-indigo-200 text-center mt-1">Reset Password Anda</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('password.update') }}" class="px-8 py-6">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-500 text-red-700">
                        <i class="fas fa-exclamation-circle mr-2"></i> Terdapat kesalahan pada input
                    </div>
                @endif

                <!-- Email Field -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        <i class="fas fa-envelope mr-2 text-indigo-600"></i>Email
                    </label>
                    <input type="email" name="email" id="email" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        value="{{ old('email', $email) }}" />
                </div>

                <!-- Password Field -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        <i class="fas fa-lock mr-2 text-indigo-600"></i>Password Baru
                    </label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Masukkan password baru" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">
                        <i class="fas fa-lock mr-2 text-indigo-600"></i>Konfirmasi Password
                    </label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Konfirmasi password baru" />
                </div>

                <!-- Submit Button -->
                <button type="submit" style="background-color: #007bff;"
                    onmouseover="this.style.backgroundColor='#0056b3'" onmouseout="this.style.backgroundColor='#007bff'"
                    class="w-full text-white font-bold py-2 px-4 rounded-md transition duration-300 flex items-center justify-center">
                    <i class="fas fa-sync-alt mr-2"></i> Reset Password
                </button>
            </form>

            <!-- Back to Login Link -->
            <div class="px-8 py-4 bg-gray-50 border-t border-gray-200 text-center">
                <p class="text-gray-600">
                    Ingat password Anda?
                    <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">
                        Kembali ke login
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>