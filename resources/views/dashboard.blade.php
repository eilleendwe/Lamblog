<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Welcome to Lamblog') }}
        </h2>
    </x-slot>

    <div class="flex flex-row items-start ">
        <!-- Sidebar -->
        <div class="relative flex h-svh w-full max-w-[15rem] flex-col bg-clip-border p-6 -mt-6 text-gray-700 ">
            <!-- Profile for Logged-in -->
            <x-sidebar />
            <!-- Post Form and List -->
            <div class="w-[60%] mx-5  sm:px-4 lg:px-8">
                <!-- Post Creation Form (Logged-in Users) -->
                @auth
                <x-post-form />

                @endauth

                <!-- Post  -->
                @foreach ($posts as $post)
                <div class="bg-white p-4 rounded-lg shadow-md mb-6">
                    <h2 class="text-xl font-semibold">{{ $post->title }}</h2>
                    @if ($post->content)
                    <p class="text-gray-600">{{ $post->content }}</p>
                    @endif
                    <p class="text-sm text-gray-500 my-2">Posted by {{ $post->user->name }} on {{ $post->created_at->format('F j, Y') }}</p>
                    <a href="{{ route('posts.show', $post->id) }}"
                        class="inline-block mt-2 bg-blue-500 text-white p-2 rounded hover:bg-blue-600">
                        See More
                    </a>
                </div>
                @endforeach

                <!-- No Posts Message -->
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