<x-app-layout title="Edit User">

    <section class="bg-white dark:bg-gray-900 p-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <form method="post" action="{{ route('profile.update', Auth::user()->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="sm:flex gap-5">
                        <div class="flex-none">
                            @if ($user->isAdmin == false && $user->isSupport == true)
                                <div class="flex justify-center">
                                    <div class="relative">
                                        @if ($user->image !== null)
                                            <img id="fotoProfil" class="object-cover w-40 h-40"
                                                src="{{ asset('storage/images/fotoProfil') }}/{{ $user->image }}"
                                                alt="">
                                        @else
                                            <img id="fotoProfil" class="object-cover w-40 h-40"
                                                src="{{ asset('storage/images/fotoProfil') }}/default_image.jpg"
                                                alt="">
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
                                </div>
                            @endif
                        </div>
                        <section class="w-full">
                            <header>
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Profile Informations') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ __("Update your account's profile information and email address.") }}
                                </p>
                            </header>


                            <div class="space-y-6">
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
                                </div>
                                <div>
                                    <x-input-label for="no_hp" :value="__('Nomor Hp')" />
                                    <x-text-input id="no_hp" name="no_hp" type="text" class="mt-1 block w-full"
                                        :value="old('no_hp', $user->no_hp)" autofocus autocomplete="name" />
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>
                                <div class="flex items-center gap-4">
                                    <x-primary-button>{{ __('Save') }}</x-primary-button>

                                    @if (session('status') === 'profile-updated')
                                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                            class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                                    @endif
                                </div>
                            </div>

                        </section>
                    </div>
                </div>
            </form>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Update Password') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Ensure your account is using a long, random password to stay secure.') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')

                            <div>
                                <x-input-label for="current_password" :value="__('Current Password')" />
                                <x-text-input id="current_password" name="current_password" type="password"
                                    class="mt-1 block w-full" autocomplete="current-password" />
                                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="password" :value="__('New Password')" />
                                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                                    autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                    class="mt-1 block w-full" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>

                                @if (session('status') === 'password-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>


        </div>
    </section>



</x-app-layout>
