<x-layout> 
    <h1 class="title text-center"> Login  </h1>
   {{-- //session   --}}
    {{-- @if (session('status'))
    <x-flshMsg msg="{{session('status')}}" />
@endif --}}

    <div class="mx-auto max-w-screen-sm card">
        <form action="{{ route('login')}}" method="POST">
            @csrf
            <div class="mb-4 ">
                
                
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
                
                <div class="mb-4 flex justify-between items-center">
                    
                    <div>
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    
                    <a href="{{route('password.request')}}" class="text-blue-400">Forgot your Password?</a>
                </div>
                @error('failed')
                        <p class="error">{{ $message }}</p>
                @enderror

                <p>if you are not register go to the <a class="text-blue-400" href="{{route('register')}}">Register page</a></p>
                <br>
                {{-- submit button --}}
                
                <button class="btn w-full">
                      Login</button>
            </div>
        </form>

    </div>

</x-layout>