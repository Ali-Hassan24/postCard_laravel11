<x-layout>

    <a href="{{ route('dashboard') }}" class="text-blue-500">&larr; Go Back to post</a>

    <div class="card mb-4">
        <h1 class="title text-center ">Update your Post</h1>
        
        {{-- Success Message --}}
        @if (session('success'))
            <div class="mb-2">
                <x-flashmsg msg="{{ session('success') }}" bg="bg-green-500"/>
            </div>
        @endif

        <form action="{{ route('posts.update', $post) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- Post Title --}}
            <div class="mb-4">
                <label for="title">Title</label>
                <input type="text" name="title" value="{{ $post->title }}" class="input @error('title') ring-red-500 border-red-500 @enderror">
                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Post Body --}}
            <div class="mb-4">
                <label for="body">Post Body</label>
                <textarea name="body" rows="5" class="input @error('body') ring-red-500 border-red-500 @enderror">{{ $post->body }}</textarea>
                @error('body')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- cover image --}}
            @if ($post->image)
                 <div class="mb-4 ">  
                    <label for="">Current Cover image </label>
                    <img src="{{asset('storage/'. $post->image)}}" alt="" class=" rounded-lg w-1/4">     
                 </div>
             @endif
             <div class="mb-4">
                <label for="image">Cover Photo</label>
                <input type="file" id="image" name="image">
                @error('image')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            {{-- updat button --}}
            <button class="btn w-full">Update post</button>
        </form>
    </div>

</x-layout>