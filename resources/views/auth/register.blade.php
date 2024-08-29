<x-layout>
    <h1 class="title"> Register A New Account </h1>

    <div class="mx-auto max-w-screen-sm card">
        <form action="{{ route('register')}}" method="POST">
            @csrf
            <div class="mb-4 ">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700">User Name</label>
                    <input type="text" name="username" value="{{old('username')}}" 
                           class="input @error('username') ring-red-500 border-red-500 @enderror">
                    @error('username')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{old('email')}}" class="input @error('email') ring-red-500 border-red-500 @enderror">
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password">Password</label>
                    <input type="password" name="password"  class="input @error('password') ring-red-500 border-red-500 @enderror">
                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password_confirmation">Confirm password</label>
                    <input type="password" name="password_confirmation" id="" class="input @error('password') ring-red-500 border-red-500 @enderror">
                    {{-- @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror --}}
                </div>
                {{-- submit button --}}
                
                <p class="mb-3">if you are already register go to the <a class="text-blue-400" href="{{route('login')}}">Login page</a></p>
                <button class="btn w-full">
                      Register</button>
            </div>
        </form>

    </div>

</x-layout>