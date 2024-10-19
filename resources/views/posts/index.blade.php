
     <x-layout>
        <div class="grid grid-cols-2 gap-8">
            <h1 class="title">Latest post</h1>
            <a href="{{route('dashboard')}}" class="mx-auto bg-blue-500 text-white h-8 w-37  px-3 py-1 rounded-sm hover:bg-black ">Add Post</a>
        </div>
       
    <div class="grid grid-cols-3 gap-6">
            @foreach ($posts as $post)
                 @include('components.postCard', ['post' => $post])
            @endforeach
        </div> 

    {{-- <div class="grid grid-cols-2 gap-6">
        @foreach ($posts as $post)
            <div class="relative flex border border-l-4 border-black flex-col justify-between bg-white shadow-md rounded-lg p-4">
                <!-- Post content -->
                <x-postCard :post="$post"/>
    
                <!-- Button Container -->
                <div class="flex justify-end gap-2 mt-4">
                    <!-- Update Button -->
                    <a href="{{route('posts.edit', $post)}}" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-black">Update</a>
                    
                    <!-- Delete Button -->
                    <form class="m-0 p-0" action="{{ route('posts.destroy', $post) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-black">Delete</button>  
                    </form>
                </div>
            </div>
        @endforeach
    </div> --}}
    
{{-- <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Itaque, amet.</p> --}}
    <div class="m-2">
        {{ $posts->links()}}
    </div>
        {{-- <p>{{$posts}}</p> --}}
        {{-- @guest
            <h1>Guest</h1>
        @endguest --}}
        {{-- <x-demo></x-demo> --}}
    </x-layout>
