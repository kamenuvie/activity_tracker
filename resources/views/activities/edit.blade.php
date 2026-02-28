<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Activity') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl sm:rounded-2xl border border-nss-green-100">
                <div class="p-8">
                    <form method="POST" action="{{ route('activities.update', $activity) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                                Activity Title
                            </label>
                            <input type="text" name="title" id="title" value="{{ old('title', $activity->title) }}" required
                                class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-nss-green-500 focus:ring-nss-green-500 transition-all">
                            @error('title')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                                Description <span class="text-gray-400 font-normal">(Optional)</span>
                            </label>
                            <textarea name="description" id="description" rows="5"
                                class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-nss-green-500 focus:ring-nss-green-500 transition-all">{{ old('description', $activity->description) }}</textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end space-x-4 pt-4">
                            <a href="{{ route('activities.index') }}"
                                class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2.5 px-6 rounded-xl transition-all duration-150">
                                Cancel
                            </a>
                            <button type="submit"
                                class="bg-gradient-to-r from-nss-green-600 to-nss-green-700 hover:from-nss-green-700 hover:to-nss-green-800 text-white font-semibold py-2.5 px-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-150">
                                Update Activity
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
