<x-guest-layout>
    <div class="lg:flex lg:items-center lg:justify-center lg:space-x-12">
    <div class="lg:w-1/2 max-w-md mx-auto p-6 bg-white rounded-lg shadow-md">
        <header class="text-center mb-8">
            <h2 class="text-bgray-900 dark:text-white text-4xl font-semibold font-poppins mb-2">
                Create an Account
            </h2>
            <p class="font-urbanis text-base font-medium text-bgray-600 dark:text-bgray-50">
                Join us and start managing your finances today.
            </p>
        </header>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <input id="name" class="block mt-1 w-full text-bgray-800 text-base border border-bgray-300 dark:border-darkblack-400 dark:bg-darkblack-500 dark:text-white h-14 focus:border-success-300 focus:ring-0 rounded-lg px-4 py-3.5 placeholder:text-bgray-500 placeholder:text-base" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <input id="email" class="block mt-1 w-full text-bgray-800 text-base border border-bgray-300 dark:border-darkblack-400 dark:bg-darkblack-500 dark:text-white h-14 focus:border-success-300 focus:ring-0 rounded-lg px-4 py-3.5 placeholder:text-bgray-500 placeholder:text-base" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <input id="password" class="block mt-1 w-full text-bgray-800 text-base border border-bgray-300 dark:border-darkblack-400 dark:bg-darkblack-500 dark:text-white h-14 focus:border-success-300 focus:ring-0 rounded-lg px-4 py-3.5 placeholder:text-bgray-500 placeholder:text-base" type="password" name="password" required autocomplete="new-password" placeholder="Password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <input id="password_confirmation" class="block mt-1 w-full text-bgray-800 text-base border border-bgray-300 dark:border-darkblack-400 dark:bg-darkblack-500 dark:text-white h-14 focus:border-success-300 focus:ring-0 rounded-lg px-4 py-3.5 placeholder:text-bgray-500 placeholder:text-base" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Register Button -->

                <x-primary-button type="submit" class="py-3.5 flex items-center justify-center text-white font-bold bg-success-300 hover:bg-success-400 transition-all rounded-lg w-full">
                    {{ __('Register') }}
                </x-primary-button>


            <!-- Already registered? -->
            <p class="text-center text-bgray-900 dark:text-bgray-50 text-base font-medium pt-7">
                {{ __('Already registered?') }} <a href="{{ route('login') }}" class="font-semibold underline">{{ __('Sign In') }}</a>
            </p>
        </form>

        <!-- Footer Links -->


        <p class="text-bgray-600 dark:text-white text-center text-sm mt-6">
            @ 2024 Emils Eduards Timma. All Rights Reserved.
        </p>
    </div>
    <!-- Right Column: Image and Description -->
    <div class="hidden lg:block lg:w-1/2 p-10 bg-[#F6FAFF] rounded-lg">
        <div class="relative">
            <img src="https://spaceraceit.com/html/bankco/assets/images/illustration/signin.svg" alt="" class="mx-auto">
            <div class="text-center mt-8">
                <h3 class="text-bgray-900 font-semibold text-4xl mb-4">
                    Speedy, Easy, and Fast
                </h3>
                <p class="text-bgray-600 text-sm font-medium">
                    We'll help you transfer and receive funds, and grow your crypto holdings.
                </p>
            </div>
        </div>
    </div>
    </div>

</x-guest-layout>
