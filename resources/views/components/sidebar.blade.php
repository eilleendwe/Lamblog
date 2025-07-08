@auth
<div role="button"
    class="flex items-center text-white w-full p-1 mb-4 rounded-lg outline-none">
    <!-- <a href="{{ route('posts.mine') }}">My Posts</a> -->
    <x-nav-link :href="route('posts.mine')" :active="request()->routeIs('posts.mine')">
        {{ __('My Posts') }}
    </x-nav-link>
</div>
@endauth
<div role="button"
    class="flex items-center text-white w-full p-1 mb-4 rounded-lg outline-none">
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Home') }}
    </x-nav-link>
</div>
<div role="button"
    class="flex items-center text-white w-full p-1 rounded-lg outline-none">
    <x-nav-link :href="route('posts.trending')" :active="request()->routeIs('posts.trending')">
        {{ __('Trending') }}
    </x-nav-link>
</div>
</div>