<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-12 object-cover">
        </x-slot>

        <x-validation-errors class="mb-4" />

        <div id="error-message" class="mb-4 text-sm text-red-600 hidden"></div>

        <form id="login-form">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <button type="submit" id="login-button" class="ms-4 py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    {{ __('Log in') }}
                </button>

                <a class="ms-4 py-2 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="{{ route('register') }}">
                    {{ __('Register') }}
                </a>
            </div>
        </form>
    </x-authentication-card>

    <script>
        document.getElementById('login-form').addEventListener('submit', async function(event) {
            event.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const loginButton = document.getElementById('login-button');
            const errorMessage = document.getElementById('error-message');

            loginButton.disabled = true;
            loginButton.textContent = "Logging in...";

            try {
                const response = await fetch("{{ route('login') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json", 
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ email, password })
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || "Login failed");
                }

                // Store token in localStorage
                localStorage.setItem("token", data.token);
                localStorage.setItem("user", JSON.stringify(data.user));

                // Redirect to home page
                window.location.href = "/";
            } catch (error) {
                errorMessage.textContent = error.message;
                errorMessage.classList.remove("hidden");
                loginButton.disabled = false;
                loginButton.textContent = "Log in";
            }
        });
    </script>
</x-guest-layout>
