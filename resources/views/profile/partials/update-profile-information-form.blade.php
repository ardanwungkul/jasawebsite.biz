<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div class="flex gap-5">
            <div class="flex-none">
                @if ($user->isAdmin == false && $user->isSupport == true)
                    <div class="relative">
                        @if ($user->image !== null)
                            <img id="fotoProfil" class="object-cover w-40 h-40"
                                src="{{ asset('storage/images/fotoProfil') }}/{{ $user->image }}" alt="">
                        @else
                            <img id="fotoProfil" class="object-cover w-40 h-40"
                                src="{{ asset('storage/images/fotoProfil') }}/default_image.jpg" alt="">
                        @endif
                        <div class="absolute z-10 top-0  opacity-0 hover:opacity-100">
                            <label for="fotoProfilInput">
                                <div class="w-40 h-40 bg-black opacity-60 flex items-center">
                                    <p class="text-center w-full"><i class="fa-solid fa-pen"
                                            style="color: #ffffff;"></i>
                                    </p>
                                </div>
                                <input accept="image/*" type="file" name="image" class="hidden"
                                    id="fotoProfilInput" />
                            </label>
                        </div>
                        <script>
                            fotoProfilInput.onchange = evt => {
                                const [file] = fotoProfilInput.files
                                if (file) {
                                    fotoProfil.src = URL.createObjectURL(file)
                                }
                            }
                        </script>
                    </div>
                @endif
            </div>
            <div class="w-full space-y-6">
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                        :value="old('name', $user->name)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                        :value="old('email', $user->email)" required autocomplete="username" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                        <div>
                            <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                                {{ __('Your email address is unverified.') }}

                                <button form="send-verification"
                                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>

                    @if (session('status') === 'profile-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </form>
</section>
