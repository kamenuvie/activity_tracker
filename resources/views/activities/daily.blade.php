<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daily Activities View') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Date Selector -->
            <div class="mb-6 bg-white overflow-hidden shadow-xl sm:rounded-xl backdrop-blur-sm">
                <div class="p-6">
                    <form method="GET" action="{{ route('activities.daily') }}" class="flex flex-wrap items-center gap-4">
                        <label for="date" class="text-sm font-medium text-gray-700">
                            Select Date:
                        </label>
                        <input type="date" name="date" id="date" value="{{ $date }}"
                            class="rounded-xl border-gray-300 shadow-sm focus:border-nss-green-500 focus:ring-nss-green-500 text-gray-700">
                        <button type="submit"
                            class="bg-gradient-to-r from-nss-green-600 to-nss-green-700 hover:from-nss-green-700 hover:to-nss-green-800 text-white font-semibold py-2 px-6 rounded-xl shadow-lg transition duration-300">
                            View
                        </button>
                        <a href="{{ route('activities.daily') }}"
                            class="bg-gradient-to-r from-nss-yellow-500 to-nss-yellow-600 hover:from-nss-yellow-600 hover:to-nss-yellow-700 text-white font-semibold py-2 px-6 rounded-xl shadow-lg transition duration-300">
                            Today
                        </a>
                    </form>
                </div>
            </div>

            <!-- Updates for the Day -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl backdrop-blur-sm">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        Activities Updated on {{ \Carbon\Carbon::parse($date)->format('F d, Y') }}
                    </h3>

                    @if($updates->count() > 0)
                        <div class="space-y-4">
                            @foreach($updates as $update)
                            <div class="border border-gray-200 rounded-xl p-4 bg-gradient-to-r from-nss-green-50/30 to-nss-yellow-50/30 hover:shadow-lg transition duration-300">
                                <div class="flex justify-between items-start mb-2">
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-800">
                                            {{ $update->activity->title }}
                                        </h4>
                                        <p class="text-sm text-gray-600 mt-1">
                                            {{ $update->activity->description }}
                                        </p>
                                    </div>
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $update->status === 'done' ? 'bg-nss-green-100 text-nss-green-800' : 'bg-nss-yellow-100 text-nss-yellow-800' }}">
                                        {{ ucfirst($update->status) }}
                                    </span>
                                </div>

                                @if($update->remark)
                                <div class="mt-2 p-3 bg-white/80 rounded-xl">
                                    <p class="text-sm text-gray-700">
                                        <span class="font-medium">Remark:</span> {{ $update->remark }}
                                    </p>
                                </div>
                                @endif

                                <div class="mt-3 flex items-center justify-between text-sm text-gray-600">
                                    <div class="flex items-center space-x-4">
                                        <span class="font-medium">{{ $update->user->name }}</span>
                                        <span>{{ $update->user->email }}</span>
                                    </div>
                                    <span class="font-medium">{{ $update->created_at->format('h:i A') }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="mt-6 p-6 bg-gradient-to-r from-nss-green-50 to-nss-yellow-50 rounded-xl shadow-lg">
                            <h4 class="font-semibold text-gray-800 mb-4">Summary</h4>
                            <div class="grid grid-cols-3 gap-4 text-center">
                                <div>
                                    <p class="text-2xl font-bold text-gray-800">{{ $updates->count() }}</p>
                                    <p class="text-sm text-gray-600">Total Updates</p>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-nss-green-600">{{ $updates->where('status', 'done')->count() }}</p>
                                    <p class="text-sm text-gray-600">Completed</p>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-nss-yellow-600">{{ $updates->where('status', 'pending')->count() }}</p>
                                    <p class="text-sm text-gray-600">Pending</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-600">No activity updates recorded for this date.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
