@props(['post', 'full' => "true"])

<div class="card p-4 border card-hight border-gray-200 rounded-md shadow-sm">
    {{-- cover image --}}
    <div class="mb-4 ">
        @if ($post->image)
            <img src="{{asset('storage/'. $post->image)}}" alt="" class=" rounded-lg w-full h-2/3">  
        @else
            <img src="{{asset('storage/posts_images/default.jpg')}}" alt="" class=" rounded-lg w-full">   
        @endif
    </div>
    {{-- Title --}}
    <h2 class="font-bold text-xl bg-blue-600 text-white p-2 rounded-sm">
        {{ Str::words($post->title, 5, '.') }}
    </h2>

    {{-- Author and Date --}}
    <div class="font-light mb-4 mt-2">
        <span>Posted {{ $post->created_at->diffForHumans() }} by</span>
        <a href="{{ route('posts.user', $post->user) }}" class="text-sm text-blue-500 font-bold">
            {{ $post->user->name }}
        </a>
    </div>

    {{-- Post Content --}}
    @if ($full)
        <div class="text-sm">
            <span>{{ Str::words($post->body, 20) }}</span>
            <div class="flex justify-between mt-4">
                <a href="{{ route('posts.show', $post) }}" class="text-blue-500">Read more &rarr;</a>
                {{-- <a href="" class="bg-red-600 text-white p-2 rounded-md ml-auto hover:bg-black">Delete Post</a> --}}
            </div>
        </div>
    @else
        <div class="text-sm">
            <span>{{ $post->body }}</span>
            <br><br>
            {{-- <a href="#" class="bg-red-600 text-white p-2 rounded-md mx-auto hover:bg-black">Delete Post</a> --}}
        </div>
    @endif
</div>
