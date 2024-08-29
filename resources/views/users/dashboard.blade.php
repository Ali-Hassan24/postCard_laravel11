<x-layout>
    <h1 class="title text-left">Hello Welcome 
        <span class="text-black underline underline-offset-8">{{ auth()->user()->name }}</span>
    </h1> 

    <div class="grid grid-cols-2 gap-6">
        {{-- Profile Card --}}
        <div class="w-full h-4/5 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex justify-end px-4 pt-4">
                <button id="dropdownButton" data-dropdown-toggle="dropdown" class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5" type="button">
                    <span class="sr-only">Open dropdown</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                        <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdown" class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2" aria-labelledby="dropdownButton">
                        <li><a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a></li>
                        <li><a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Export Data</a></li>
                        <li><a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a></li>
                    </ul>
                </div>
            </div>
            <div class="flex flex-col items-center pb-10">
                <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="https://picsum.photos/200" alt="Profile Image"/>
                <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ auth()->user()->name }}</h5>
                <span class="text-sm text-gray-500 dark:text-gray-400">Visual Designer</span>
                <div class="flex mt-4 md:mt-6">
                    <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add friend</a>
                    <a href="#" class="py-2 px-4 ms-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Message</a>
                </div>
            </div>
        </div>
        
        {{-- Create Post Form --}}
        <div class="card mb-4">
            <h1 class="text-blue-500 text-center font-bold mb-4">Create a new post</h1>
            
            {{-- Success Message --}}
            @if (session('success'))
                <div class="mb-2">
                    <x-flashmsg msg="{{ session('success') }}" />
                </div>
            @endif

            <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                {{-- Post Title --}}
                <div class="mb-4">
                    <label for="title">Title</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="input @error('title') ring-red-500 border-red-500 @enderror">
                    @error('title')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Post Body --}}
                <div class="mb-4">
                    <label for="body">Post Body</label>
                    <textarea name="body" rows="5" class="input @error('body') ring-red-500 border-red-500 @enderror">{{ old('body') }}</textarea>
                    @error('body')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- upload image --}}
                <div class="mb-4">
                    <label for="image">Cover Photo</label>
                    <input type="file" id="image" name="image">
                    @error('image')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <button class="btn w-full">Create Post</button>
            </form>
        </div>
    </div>

    {{-- Your Posts --}}
    <div>
        <h1 class="title">Your latest posts</h1>
        @if ((@session('delete')))  

            <div class="mb-2">
               <x-flashmsg msg="{{session('delete')}}" class="bg-red-500" />
             </div>
        @endif
        <div class="grid grid-cols-2 gap-6">
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
        </div>
        
        {{-- <div class="grid grid-cols-2 gap-6">
            @foreach ($posts as $post)
                 @include('components.postCard', ['post' => $post])
            @endforeach
        </div>  --}}
        
        {{-- Pagination Links --}}
        <div class="m-2">
            {{ $posts->links()}}
        </div>
       {{-- {{ $posts->links()}} --}}
       
    </div>
</x-layout>
{{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A magni beatae expedita pariatur necessitatibus. Totam, laborum eum id sed optio nesciunt similique deserunt officiis mollitia placeat velit possimus est repellat.</p> --}}