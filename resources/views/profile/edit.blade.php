<x-app-layout>
    <div class="mt-3 sm:ml-4 lg:mx-3 lg:ml-60 xl:ml-60">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sm:mx-2">
            <div class="p-6 text-gray-900">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm mt-3 sm:rounded-lg sm:mx-2">
            <div class="p-6 text-gray-900">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm mt-3 mb-3 sm:rounded-lg sm:mx-2">
            <div class="p-6 text-gray-900">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>