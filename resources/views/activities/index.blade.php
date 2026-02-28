<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Activities Dashboard') }}
            </h2>
            <a href="{{ route('activities.create') }}" class="bg-gradient-to-r from-nss-green-600 to-nss-green-700 hover:from-nss-green-700 hover:to-nss-green-800 text-white font-bold py-2.5 px-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-150">
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add New Activity
                </span>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-gradient-to-r from-nss-green-50 to-nss-green-100 border-l-4 border-nss-green-500 text-nss-green-800 px-6 py-4 rounded-xl shadow-sm">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <!-- Desktop Table View -->
            <div class="hidden md:block bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl sm:rounded-2xl border border-nss-green-100">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-nss-green-50 to-nss-yellow-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider rounded-tl-xl">Title</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Description</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Last Updated By</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider rounded-tr-xl">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @forelse($activities as $activity)
                                <tr class="hover:bg-nss-green-50/30 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                        {{ $activity->title }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ Str::limit($activity->description, 50) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($activity->latestUpdate)
                                            <span class="px-3 py-1.5 inline-flex text-xs leading-5 font-semibold rounded-full shadow-sm
                                                {{ $activity->latestUpdate->status === 'done' ? 'bg-gradient-to-r from-nss-green-100 to-nss-green-200 text-nss-green-800 border border-nss-green-300' : 'bg-gradient-to-r from-nss-yellow-100 to-nss-yellow-200 text-nss-yellow-800 border border-nss-yellow-300' }}">
                                                {{ ucfirst($activity->latestUpdate->status) }}
                                            </span>
                                        @else
                                            <span class="px-3 py-1.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-600 border border-gray-200">
                                                No Status
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $activity->latestUpdate?->user?->name ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('activities.show', $activity) }}" class="text-nss-green-600 hover:text-nss-green-800 transition-colors p-2 hover:bg-nss-green-50 rounded-lg" title="View">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </a>
                                            <a href="{{ route('activities.edit', $activity) }}" class="text-blue-600 hover:text-blue-800 transition-colors p-2 hover:bg-blue-50 rounded-lg" title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('activities.destroy', $activity) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 transition-colors p-2 hover:bg-red-50 rounded-lg" onclick="return confirm('Are you sure?')" title="Delete">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            <p class="text-gray-500 text-lg">No activities found</p>
                                            <a href="{{ route('activities.create') }}" class="mt-4 text-nss-green-600 hover:text-nss-green-700 font-semibold">Create your first activity</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Mobile Card View -->
            <div class="md:hidden space-y-4">
                @forelse($activities as $activity)
                <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl rounded-2xl border border-nss-green-100">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $activity->title }}</h3>
                                <p class="text-sm text-gray-600">{{ Str::limit($activity->description, 100) }}</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mb-4">
                            <div>
                                @if($activity->latestUpdate)
                                    <span class="px-3 py-1.5 inline-flex text-xs leading-5 font-semibold rounded-full shadow-sm
                                        {{ $activity->latestUpdate->status === 'done' ? 'bg-gradient-to-r from-nss-green-100 to-nss-green-200 text-nss-green-800 border border-nss-green-300' : 'bg-gradient-to-r from-nss-yellow-100 to-nss-yellow-200 text-nss-yellow-800 border border-nss-yellow-300' }}">
                                        {{ ucfirst($activity->latestUpdate->status) }}
                                    </span>
                                @else
                                    <span class="px-3 py-1.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-600 border border-gray-200">
                                        No Status
                                    </span>
                                @endif
                            </div>
                        </div>

                        @if($activity->latestUpdate?->user?->name)
                        <div class="mb-4 text-sm text-gray-600">
                            <span class="font-medium">Last updated by:</span> {{ $activity->latestUpdate->user->name }}
                        </div>
                        @endif

                        <div class="flex items-center justify-end space-x-2 pt-4 border-t border-gray-200">
                            <a href="{{ route('activities.show', $activity) }}" class="flex items-center justify-center bg-nss-green-600 hover:bg-nss-green-700 text-white p-3 rounded-xl transition-colors shadow-sm" title="View">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            <a href="{{ route('activities.edit', $activity) }}" class="flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-xl transition-colors shadow-sm" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form action="{{ route('activities.destroy', $activity) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex items-center justify-center bg-red-600 hover:bg-red-700 text-white p-3 rounded-xl transition-colors shadow-sm" onclick="return confirm('Are you sure?')" title="Delete">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl rounded-2xl border border-nss-green-100">
                    <div class="p-12 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p class="text-gray-500 text-lg">No activities found</p>
                            <a href="{{ route('activities.create') }}" class="mt-4 text-nss-green-600 hover:text-nss-green-700 font-semibold">Create your first activity</a>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
