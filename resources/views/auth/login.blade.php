<x-guest-layout>
    <x-authentication-card>
        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 text-sm font-medium text-green-600">
                {{ $value }}
            </div>
        @endsession

        <h2 class="px-4 py-2 text-lg font-bold bg-primary text-secondary">Iniciar sesión</h2>

        <form method="POST" action="{{ route('login') }}" class="grid gap-4 p-4">
            @csrf
            <x-input label="Correo electronico" id="email" class="block w-full mt-1" type="email" name="email"
                :value="old('email')" required autofocus autocomplete="username" />
            <x-input label="Contraseña" id="password" class="block w-full mt-1" type="password" name="password"
                :value="old('password')" required />
            {{-- <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div> --}}
            <section class="flex justify-end gap-2">
                <x-buttons.primary text="Iniciar sesión" type="submit" />
            </section>
        </form>
    </x-authentication-card>
</x-guest-layout>
