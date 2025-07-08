<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Trending') }}
        </h2>
    </x-slot>
    <div class="flex flex-row items-start ">
        <div class="relative flex h-svh w-full max-w-[15rem] flex-col bg-clip-border p-6 -mt-6 text-gray-700">
            <!-- Sidebar -->
            <x-sidebar />
            <div class="w-[60%] mx-5  sm:px-4 lg:px-8">
                <h1 class="text-3xl font-bold mb-6 text-white">🔥 TOP 5 POSTS</h1>
                @forelse ($trendingPosts as $post)
                <div class="bg-white p-4 rounded-lg shadow-md mb-6">
                    <h2 class="text-xl font-semibold">{{ $post->title }}</h2>

                    <p class="text-gray-600">{{ Str::limit($post->content, 200) }}</p>

                    <p class="text-sm text-gray-500 my-2">
                        Posted by {{ $post->user->name }} on {{ $post->created_at->format('d/m/Y - H.i') }}
                    </p>

                    <!-- Like Button and show many comments-->
                    <x-like-button :post="$post" />

                    <a href="{{ route('posts.show', $post->id) }}" class="inline-block mt-2 text-blue-500 hover:underline">
                        Read more →
                    </a>
                </div>
                @empty
                <p>No trending posts for today.</p>
                @endforelse
            </div>
        </div>
    </div>

</x-app-layout>