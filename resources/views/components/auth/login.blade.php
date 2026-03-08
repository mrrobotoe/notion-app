<form id="login-form" method="POST" action="{{ route('login') }}" class="flex flex-col space-y-5 bg-white border border-border shadow-sm rounded-2xl py-6">
    @csrf
    <div class="px-6 text-center space-y-1.5">
        <h2 class="font-medium text-xl">Your Notebook</h2>
        <p class="text-base text-muted-foreground">Log in to your Note account</p>
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

    <div class="px-6 space-y-4">
        <x-button id="login-button" type="submit" class="w-full">
            <x-tabler-loader id="login-loader-icon" class="w-4 h-4 mr-2 animate-spin duration-300 hidden"/>
            <span>Sign in</span>
        </x-button>
        <p class="text-center text-sm text-muted-foreground">Don't have an account? <a href="{{ route('register') }}" class="underline underline-offset-3 cursor-pointer hover:text-black">Sign up</a> </p>
    </div>
</form>

@once
    <script>
        const loginButton = document.getElementById('login-button');
        const loginForm = document.getElementById('login-form');

        loginForm.addEventListener('submit', () => {
            loginButton.disabled = true;
            loginButton.querySelector('#login-loader-icon').classList.remove('hidden');
            loginButton.querySelector('span').classList.add('hidden');
        })
    </script>
@endonce
