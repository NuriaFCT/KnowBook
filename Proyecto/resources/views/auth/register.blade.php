<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">

            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />

        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirmación Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('¿Ya esta registrado?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Registrarse') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>

<!--Muestra de algunos post-->
    <div class="px-8">
        <div class="flex items-stretch -mx-2">
            @foreach ($posts as $post)
                <div class="w-1/3 px-2">
                    <div class="bg-gray-400 h-12">
                        <div class="max-w-sm rounded overflow-hidden shadow-lg mb-4 me-4"
                            style="background-color: #f7e5d8; margin-left: 25px">
                            <img class="w-full" src="{{URL::asset('/img/LogoSinVectorizar.PNG')}}"
                                alt="Sunset in the mountains">
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
