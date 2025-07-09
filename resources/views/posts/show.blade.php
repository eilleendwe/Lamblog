<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md">


        <a href="{{ route('dashboard') }}" class="inline-block mb-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Back to Posts</a>
        <h2 class="text-2xl font-bold mb-4">{{ $post->title }}</h2>
        @if ($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="w-full max-w-md rounded">
        @endif
        <p class="text-gray-700 mb-4">{{ $post->content }}</p>
        <p class="text-sm text-gray-500 mb-6">Posted by {{ $post->user->name }} on {{ $post->created_at->format('d/m/Y - H.i') }}</p>

        <!-- Like Button and show many comments -->
        <x-like-button :post="$post" />

        <!-- Comments Section -->
        <h3 class="text-lg font-semibold my-2">Comments</h3>
        @foreach ($post->comments as $comment)
        <div class="border-t pt-2 mb-2">
            <p class="text-sm text-gray-800">{{ $comment->content }}</p>
            <p class="text-xs text-gray-500">By {{ $comment->user->name }} - {{ $comment->created_at->format('d/m/Y - H.i')}}</p>
        </div>
        @endforeach

        <!-- Add Comment Form -->
        <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-4">
            @csrf
            <textarea name="content" rows="3" class="w-full border p-2 rounded" placeholder="Add a comment..." required></textarea>
            <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Comment</button>
        </form>
    </div>
</x-app-layout>