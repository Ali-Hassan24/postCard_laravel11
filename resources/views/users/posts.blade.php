<x-layout>
    <h1 class="title">{{$user -> name}}'s posts &#9830 {{$posts->count()}}</h1>
    {{-- posts --}}

    <div class="grid grid-cols-2 gap-6">
           
        @foreach ($posts as $post)
            <x-postCard :post="$post"/>
        @endforeach
    
    </div>
    {{-- <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Itaque, amet.</p> --}}
        <div class="m-2">
            {{ $posts->links()}}
        </div>
</x-layout>