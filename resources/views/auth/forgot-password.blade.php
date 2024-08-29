<x-layout>
    <h1 class="title">Send Request to reset password </h1>

    {{-- session message --}}
    {{-- @if (session('status'))
        <x-flshMsg msg="{{session('status')}}" />
    @endif --}}

    <div class="mx-auto max-w-screen-sm card">
        <form action="{{route('password.request')}}" method="POST">
            @csrf
            <div class="mb-4 ">
                
                
                <div class="mb-4">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{old('email')}}" class="input @error('email') ring-red-500 border-red-500 @enderror">
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <p>if you are not register go to the <a class="text-blue-400" href="{{route('register')}}">Register page</a></p>
                <br>
                {{-- submit button --}}
                
                <button class="btn w-full">
                      Submit</button>
            </div>
        </form>

    </div>

</x-layout>