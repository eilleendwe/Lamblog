<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Welcome to Lamblog') }}
        </h2>
    </x-slot>

    <div class="flex flex-row items-start ">
        <!-- Sidebar -->
        <div class="relative flex h-svh w-full max-w-[15rem] flex-col bg-clip-border p-6 -mt-6 text-gray-700 ">
            <div role="button"
                class="flex items-center text-white w-full p-1 mb-4 rounded-lg outline-none">
                Home
            </div>
            <div role="button"
                class="flex items-center text-white w-full p-1 rounded-lg outline-none">
                Trending
            </div>

        </div>

        <!-- Post Form and List -->
        <div class="w-[60%] mx-5  sm:px-4 lg:px-8">
            <!-- Post Creation Form (Logged-in Users) -->
            @auth
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

                <form method="POST" action="{{ route('posts.store') }}">
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
                        Post (Coming Soon)
                    </button>
                </form>
            </div>
            @endauth

            <!-- Post  -->
            @foreach ($posts as $post)
            <div class="bg-white p-4 rounded-lg shadow-md mb-6">
                <h2 class="text-xl font-semibold">{{ $post->title }}</h2>
                @if ($post->content)
                <p class="text-gray-600">{{ $post->content }}</p>
                @endif
                <p class="text-sm text-gray-500 mt-2">Posted by {{ $post->user->name }}</p>
            </div>
            @endforeach
            @if ($posts->isEmpty())
            <div class="bg-white p-4 rounded-lg shadow-md">
                <p class="text-gray-600">No posts yet. Be the first to post!</p>
            </div>
            @endif
        </div>

        <!-- Register Prompt (Guests) -->
        @guest
        <div class="max-w-xs mx-4 sm:px-6 lg:px-8">
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-4">New to Lamblog?</h3>
                <p class="text-gray-600 mb-4">Join our community to share your thoughts!</p>
                <a href="{{ route('register') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Register Now</a>
            </div>
        </div>
        @endguest
    </div>
</x-app-layout>