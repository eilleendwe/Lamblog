@props(['post'])
<div class="flex items-center mt-4">
    <div class="mr-4">
        <form action="{{ route('posts.like', $post->id) }}" method="POST" class="inline">
            @csrf
            @if (auth()->check() && $post->isLikedBy(auth()->user()))
            <button type="submit" class="text-red-500 hover:text-red-700">❤️</button>
            @else
            <button type="submit" class="text-red-500 hover:text-red-700">♡</button>
            @endif
        </form>
        <span class="text-sm text-gray-600">{{ $post->likes->count() }}</span>

    </div>
    <div>
        <!-- Show how many comments -->
        <p class="text-sm text-gray-500">
            {{ Str::plural('💬', $post->comments->count()) }} {{ $post->comments->count() }}
        </p>
    </div>

</div>