<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Activity History Report') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filters -->
            <div class="mb-6 bg-white overflow-hidden shadow-xl sm:rounded-xl backdrop-blur-sm">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Filter Reports</h3>
                    <form method="GET" action="{{ route('activities.report') }}">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700">
                                    Start Date
                                </label>
                                <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}"
                                    class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-nss-green-500 focus:ring-nss-green-500 text-gray-700">
                            </div>

                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700">
                                    End Date
                                </label>
                                <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                                    class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-nss-green-500 focus:ring-nss-green-500 text-gray-700">
                            </div>

                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">
                                    Status
                                </label>
                                <select name="status" id="status"
                                    class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-nss-green-500 focus:ring-nss-green-500 text-gray-700">
                                    <option value="">All Statuses</option>
                                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="done" {{ request('status') === 'done' ? 'selected' : '' }}>Done</option>
                                </select>
                            </div>

                            <div>
                                <label for="user_id" class="block text-sm font-medium text-gray-700">
                                    Personnel
                                </label>
                                <select name="user_id" id="user_id"
                                    class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-nss-green-500 focus:ring-nss-green-500 text-gray-700">
                                    <option value="">All Personnel</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mt-4 flex flex-wrap gap-2">
                            <button type="submit"
                                class="bg-gradient-to-r from-nss-green-600 to-nss-green-700 hover:from-nss-green-700 hover:to-nss-green-800 text-white font-semibold py-2 px-6 rounded-xl shadow-lg transition duration-300">
                                Apply Filters
                            </button>
                            <a href="{{ route('activities.report') }}"
                                class="bg-gradient-to-r from-nss-yellow-500 to-nss-yellow-600 hover:from-nss-yellow-600 hover:to-nss-yellow-700 text-white font-semibold py-2 px-6 rounded-xl shadow-lg transition duration-300">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Results -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl backdrop-blur-sm">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Activity History</h3>

                    @if($updates->count() > 0)
                        <div class="overflow-x-auto rounded-xl">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gradient-to-r from-nss-green-50 to-nss-yellow-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Date & Time</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Activity</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Remark</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Personnel</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($updates as $update)
                                    <tr class="hover:bg-gradient-to-r hover:from-nss-green-50/30 hover:to-nss-yellow-50/30 transition duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                            <div>{{ $update->created_at->format('M d, Y') }}</div>
                                            <div class="text-gray-600">{{ $update->created_at->format('h:i A') }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-800">
                                            <div class="font-medium">{{ $update->activity->title }}</div>
                                            <div class="text-gray-600 text-xs">{{ Str::limit($update->activity->description, 50) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $update->status === 'done' ? 'bg-nss-green-100 text-nss-green-800' : 'bg-nss-yellow-100 text-nss-yellow-800' }}">
                                                {{ ucfirst($update->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ $update->remark ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                            <div>{{ $update->user->name }}</div>
                                            <div class="text-gray-600 text-xs">{{ $update->user->email }}</div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $updates->withQueryString()->links() }}
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-600">No records found matching your criteria.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
