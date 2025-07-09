<div class="bg-white p-4 rounded-lg shadow-md mb-6">
    <h3 class="text-lg font-semibold mb-4">Create a Post</h3>
    <!-- Success Message -->
    @if (session('success'))
    <div x-data="{ open: true }" x-show="open" class="fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg shadow-slate-800 p-6 w-full max-w-md">
            <h2 class="text-lg font-bold text-black mb-2">Success</h2>
            <p class="text-gray-700">{{ session('success') }}</p>
            <button @click="open = false" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Close
            </button>
        </div>
    </div>
    @endif

    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-gray-700 mb-2">Title</label>

            <input
                type="text"
                id="title"
                name="title"
                class="w-full p-2 border border-gray-300 rounded"
                placeholder="Enter post title"
                required>
            @error('title')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="image" class="block text-gray-700 mb-2">Image</label>
            <input type="file" name="image">
        </div>
        <div class="mb-4">
            <label for="content" class="block text-gray-700 mb-2">Content</label>
            <textarea
                id="content"
                name="content"
                class="w-full p-2 border border-gray-300 rounded"
                placeholder="Enter post content"></textarea>
            @error('content')
            <p class="text-red-500 text-sm mt-1">Error message</p>
            @enderror
        </div>
        <button
            type="submit"
            class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">
            Post
        </button>
    </form>
</div>