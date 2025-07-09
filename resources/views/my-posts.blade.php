<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Posts') }}
        </h2>
    </x-slot>

    <div class="flex flex-row items-start ">
        <div class="relative flex h-svh w-full max-w-[15rem] flex-col bg-clip-border p-6 -mt-6 text-gray-700">
            <!-- Sidebar -->
            <x-sidebar />
            <!-- Post Form and List -->
            <div class="w-[60%] mx-5  sm:px-4 lg:px-8">
                <!-- Post Creation Form (Logged-in Users) -->
                <x-post-form />
                <!-- Post List -->
                @forelse ($posts as $post)
                <div class="bg-white p-4 rounded-lg shadow-md mb-6">
                    <h3 class="text-lg font-semibold mb-2">{{ $post->title }}</h3>
                    @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="w-full max-w-md rounded">
                    @endif
                    <p class="text-gray-700 mb-4">{{ $post->content }}</p>
                    <span class="text-sm text-gray-500">Posted by {{ $post->name }} on {{ $post->created_at->format('d/m/Y - H.i')}}</span>

                    <!-- Like buton and show comments -->
                    <x-like-button :post="$post" />

                    <!-- See more -->
                    <a href="{{ route('posts.show', $post->id) }}" class="inline-block mt-2 text-blue-500 hover:underline">
                        Read more →
                    </a>
                </div>
                @empty
                <div class="bg-white p-4 rounded-lg shadow-md mb-6">
                    <p class="text-gray-700">You have not created any posts yet.</p>
                </div>
                @endforelse
            </div>
        </div>

</x-app-layout>