<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
           
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
           
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Recuérdame') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a href="{{route('register')}}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Registrarse</a> 
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Iniciar sesión') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>


    <div class="px-8">
        <div class="flex items-stretch -mx-2">
            @foreach ($posts as $post)
                <div class="w-1/3 px-2">
                    <div class="bg-gray-400 h-12">
                        <div class="max-w-sm rounded overflow-hidden shadow-lg mb-4 me-4"
                            style="background-color: #f7e5d8; margin-left: 25px">
                            <div class=" mt-4 mb-4 flex flex-wrap justify-center ">
                                <img src="{{url('img/posts/'  .$post->image) }}" height="50%" width="50%"/>
                            </div>
                            <div class="px-6 py-4">
                                <div class="font-bold text-xl mb-2">{{ $post->title }}</div>
                                <p class="text-gray-700 text-base">
                                    {{ $post->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>




</x-guest-layout>
