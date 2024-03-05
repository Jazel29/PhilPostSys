<x-guest-layout>
    <h1 class="mb-3 font-semibold text-center">To set up an account, log in using the root account.</h1>
    <form method="POST" action="{{ route('verify-root-account') }}">
        @csrf
        <div>
            <x-input-label for="email" :value="__('Root Account Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Root Account Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="w-full h-10 rounded-xl bg-secondary text-center hover:bg-secondary_hover transition-colors duration:200">
                {{ __('Verify') }}
            </x-primary-button>

            <section>
                
            </section>
        </div>
    </form>
</x-guest-layout>