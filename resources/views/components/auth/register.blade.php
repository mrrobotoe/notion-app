<form id="register-form" method="POST" action="{{ route('register') }}" class="min-w-sm flex flex-col space-y-5 bg-white border border-border shadow-sm rounded-2xl py-6">
    @csrf
    <div class="px-6 text-center space-y-1.5">
        <h2 class="font-medium text-xl">Your Notebook</h2>
        <p class="text-base text-muted-foreground">Fill in the details below to create an account.</p>
    </div>

    <div class="px-6 flex flex-col space-y-2">
        <x-forms.label for="name">Name</x-forms.label>
        <x-forms.input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Enter your name" />
        <x-forms.error :messages="$errors->first('name')" />
    </div>

    <div class="px-6 flex flex-col space-y-2">
        <x-forms.label for="email">Email</x-forms.label>
        <x-forms.input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="Enter your email address" />
        <x-forms.error :messages="$errors->first('email')" />
    </div>

    <div class="px-6 flex flex-col space-y-2">
        <x-forms.label for="password">Password</x-forms.label>
        <x-forms.input id="password" name="password" type="password" placeholder="Enter your password"/>
        <x-forms.error :messages="$errors->first('password')" />
    </div>

    <div class="px-6 flex flex-col space-y-2">
        <x-forms.label for="password_confirmation">Confirm Password</x-forms.label>
        <x-forms.input id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirm your password"/>
        <x-forms.error :messages="$errors->first('password_confirmation')" />
    </div>

    <div class="px-6 space-y-4">
        <x-button id="register-button" type="submit" class="w-full">
            <x-tabler-loader id="register-loader-icon" class="w-4 h-4 mr-2 animate-spin duration-300 hidden"/>
            <span>Register</span>
        </x-button>
        <p class="text-center text-sm text-muted-foreground">Already have an account? <a href="{{ route('login') }}" class="underline underline-offset-3 cursor-pointer hover:text-black">Sign in</a> </p>
    </div>
</form>

@once
    <script>
        const registerButton = document.getElementById('register-button');
        const registerForm = document.getElementById('register-form');

        registerForm.addEventListener('submit', () => {
            registerButton.disabled = true;
            registerButton.querySelector('#register-loader-icon').classList.remove('hidden');
            registerButton.querySelector('span').classList.add('hidden');
        })
    </script>
@endonce
