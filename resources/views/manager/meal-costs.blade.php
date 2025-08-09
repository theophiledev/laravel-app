<x-app-layout>
    <div class="max-w-6xl mx-auto">
        <!-- Page Header -->
        <div class="mb-6 md:mb-8">
            <h1 class="text-2xl md:text-4xl font-bold text-gray-800 mb-2">💰 Meal Cost Management</h1>
            <p class="text-gray-600 text-sm md:text-base">Set and manage meal costs for all students</p>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                <i class="fas fa-exclamation-circle mr-2"></i>
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <!-- Bulk Update Section -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4">
                <i class="fas fa-cogs mr-2"></i>Bulk Update Meal Costs
            </h2>
            <p class="text-gray-600 mb-4">Update meal cost for all students at once</p>
            
            <form method="POST" action="{{ route('manager.meal-costs.bulk-update') }}" class="flex items-end gap-4">
                @csrf
                <div class="flex-1">
                    <label for="bulk_meal_cost" class="block text-sm font-medium text-gray-700 mb-2">
                        New Meal Cost (RWF)
                    </label>
                    <input type="number" 
                           id="bulk_meal_cost" 
                           name="meal_cost" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="Enter meal cost (e.g., 5000)"
                           min="1"
                           max="100000"
                           required>
                </div>
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition-colors flex items-center">
                    <i class="fas fa-save mr-2"></i>
                    Update All
                </button>
            </form>
        </div>

        <!-- Individual Student Meal Costs -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">
                <i class="fas fa-users mr-2"></i>Individual Student Meal Costs
            </h2>
            <p class="text-gray-600 mb-6">Set specific meal costs for individual students</p>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Student
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Registration
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Campus
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Current Meal Cost
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Balance
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-white font-bold text-sm">{{ substr($user->name, 0, 2) }}</span>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $user->regnumber ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $user->campus ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($user->foodTaken)
                                        <span class="text-lg font-bold text-green-600">
                                            {{ number_format($user->foodTaken->meal_cost > 0 ? $user->foodTaken->meal_cost : 1000) }} RWF
                                        </span>
                                    @else
                                        <span class="text-sm text-gray-500">No record</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($user->foodTaken)
                                        <span class="text-sm font-medium text-blue-600">
                                            {{ number_format($user->foodTaken->payment_amount) }} RWF
                                        </span>
                                    @else
                                        <span class="text-sm text-gray-500">No record</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    @if($user->foodTaken)
                                        <button onclick="openEditModal('{{ $user->id }}', '{{ $user->name }}', '{{ $user->foodTaken->meal_cost > 0 ? $user->foodTaken->meal_cost : 1000 }}')" 
                                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded text-xs transition-colors">
                                            <i class="fas fa-edit mr-1"></i>Edit
                                        </button>
                                    @else
                                        <span class="text-gray-400 text-xs">No food record</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="flex items-center justify-between p-6 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">Update Meal Cost</h3>
                    <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form id="editForm" method="POST" class="p-6">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Student Name
                        </label>
                        <input type="text" id="studentName" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50" readonly>
                    </div>
                    
                    <div class="mb-6">
                        <label for="editMealCost" class="block text-sm font-medium text-gray-700 mb-2">
                            Meal Cost (RWF)
                        </label>
                        <input type="number" 
                               id="editMealCost" 
                               name="meal_cost" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Enter meal cost"
                               min="1"
                               max="100000"
                               required>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeEditModal()" 
                                class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                            <i class="fas fa-save mr-1"></i>Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openEditModal(userId, studentName, currentMealCost) {
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('studentName').value = studentName;
            document.getElementById('editMealCost').value = currentMealCost;
            document.getElementById('editForm').action = `/manager/meal-costs/${userId}/update`;
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });

        // Close modal on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeEditModal();
            }
        });
    </script>
</x-app-layout> 