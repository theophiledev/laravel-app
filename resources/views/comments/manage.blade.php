<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-page-title text-gray-800 mb-2">💬 Comment Management</h1>
            <p class="text-body text-gray-600">Review and manage student feedback comments</p>
        </div>

        @if (session('success'))
            <div class="mb-6 rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 p-4 text-green-800 shadow-sm">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-600 mr-3"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Comments List -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-dashboard-title text-gray-800">All Comments</h2>
            </div>
            
            @if($comments->count() > 0)
                <div class="divide-y divide-gray-200">
                    @foreach($comments as $comment)
                        <div class="p-6 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-blue-600"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-card-title text-gray-800">{{ $comment->user->name }}</h3>
                                        <p class="text-caption text-gray-500">{{ $comment->created_at->format('M d, Y - H:i') }}</p>
                                    </div>
                                </div>
                                <span class="px-3 py-1 rounded-full text-xs font-medium
                                    @if($comment->status === 'approved') bg-green-100 text-green-800
                                    @elseif($comment->status === 'rejected') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800
                                    @endif">
                                    {{ ucfirst($comment->status) }}
                                </span>
                            </div>
                            
                            <div class="mb-4">
                                <p class="text-body text-gray-700 leading-relaxed">{{ $comment->content }}</p>
                            </div>
                            
                            @if($comment->admin_response)
                                <div class="mb-4 p-4 bg-blue-50 rounded-xl">
                                    <p class="text-sm font-medium text-blue-800 mb-2">Admin Response:</p>
                                    <p class="text-sm text-blue-700">{{ $comment->admin_response }}</p>
                                </div>
                            @endif
                            
                            @if($comment->status === 'pending')
                                <div class="flex items-center space-x-3">
                                    <form action="{{ route('manager.comments.approve', $comment) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                                            <i class="fas fa-check mr-1"></i>
                                            Approve
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('manager.comments.reject', $comment) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">
                                            <i class="fas fa-times mr-1"></i>
                                            Reject
                                        </button>
                                    </form>
                                    
                                    <button onclick="showResponseForm({{ $comment->id }})" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                        <i class="fas fa-reply mr-1"></i>
                                        Respond
                                    </button>
                                </div>
                                
                                <!-- Response Form (Hidden by default) -->
                                <div id="response-form-{{ $comment->id }}" class="hidden mt-4">
                                    <form action="{{ route('manager.comments.respond', $comment) }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="admin_response_{{ $comment->id }}" class="block text-label text-gray-700 mb-2">Your Response:</label>
                                            <textarea 
                                                id="admin_response_{{ $comment->id }}"
                                                name="admin_response" 
                                                rows="3" 
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none text-body"
                                                placeholder="Write your response to this comment..."
                                                required
                                            ></textarea>
                                        </div>
                                        <div class="flex items-center space-x-3">
                                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                                <i class="fas fa-paper-plane mr-1"></i>
                                                Send Response
                                            </button>
                                            <button type="button" onclick="hideResponseForm({{ $comment->id }})" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                                                Cancel
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $comments->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-comments text-gray-400 text-2xl"></i>
                    </div>
                    <h3 class="text-section-title text-gray-600 mb-3">No Comments Found</h3>
                    <p class="text-body text-gray-500">There are no comments to review at the moment.</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        function showResponseForm(commentId) {
            document.getElementById(`response-form-${commentId}`).classList.remove('hidden');
        }
        
        function hideResponseForm(commentId) {
            document.getElementById(`response-form-${commentId}`).classList.add('hidden');
        }
    </script>
</x-app-layout>
