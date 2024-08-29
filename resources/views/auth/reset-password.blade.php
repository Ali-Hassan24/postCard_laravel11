<x-layout>
    <h1 class="title"> Reset your password</h1>

    <div class="mx-auto max-w-screen-sm card">
        <form action="{{route('password.update')}}" method="POST">
            @csrf
            <div class="py-4">
                 <input type="hidden" name="token" value="{{token}}">

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
                
                <button class="btn w-full">
                      Reset</button>
            </div>
        </form>

    </div>

</x-layout>