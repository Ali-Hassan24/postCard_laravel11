<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post Card</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-slate-100 text-slate-900">

    {{-- navbar section --}}

    <nav class="bg-white dark:bg-gray-900 sticky w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Post Card Website</span>
            </a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                {{-- Only show these buttons if the user is not authenticated --}}
                @guest
                    <a href="{{ route('login') }}" type="button" class="button">Login</a>
                    <a href="{{ route('register') }}" type="button" class="button">Register</a>
                @endguest

                {{-- Show the logout button if the user is authenticated --}}
                @auth   
                    <div class="relative grid place-items-center" @click.outside="open= false" x-data="{ open: false }">
                         <button @click="open = !open" type="button" class="round-btn">
                            <img src="https://picsum.photos/200" alt="" class="img">
                         </button>

                         {{-- dropdown menu --}}
                          <div x-show="open" class="bg-blue-400 text-white shadow-lg absolute top-10 px-5 py-3 right-10 rounded-lg overflow-hidden font-light">
                              <p class="username">{{ auth()->user()->name}} </p>
                              <hr>
                              <a href="{{route('dashboard')}}" class="mt-3 w-full hover:text-black  hover:bg-white">DashBoard</a>
                              
                              <form method="POST" action="{{route('logout')}}">
                                  @csrf
                                  <button type="submit" class="w-full hover:bg-white hover:text-black">Logout</button>
                              </form>
                              
                          </div>
                    </div>   
                @endauth

                <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="{{ route('posts.index') }}" class="nav-link active" aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="#" class="nav-link">About</a>
                    </li>
                    <li>
                        <a href="#" class="nav-link">Services</a>
                    </li>
                    <li>
                        <a href="#" class="nav-link">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-8 px-4 mx-auto max-w-screen-lg">
        {{ $slot }}
    </main>

    <footer class="w-full py-14 bg-blue-500  text-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 ">
            <div class="max-w-3xl mx-auto">
                <a href="" class="flex justify-center text-6xl text-white ">Post Card Website </a>
                    <ul class="text-lg flex items-center justify-center flex-col gap-7 md:flex-row md:gap-12 transition-all duration-500 py-16 mb-10 border-b border-gray-200">
                        <li><a href="#" class="text-gray-200 hover:text-gray-900">Home</a></li>
                        <li><a href="#" class=" text-gray-200 hover:text-gray-900">about</a></li>
                        <li><a href="#" class=" text-gray-200 hover:text-gray-900">services</a></li>
                        <li><a href="#" class=" text-gray-200 hover:text-gray-900">contact</a></li>
                    
                    </ul>
                    </div>
                    <span class="text-lg text-white text-center block">©<a href="https://pagedone.io/">Post Card</a> 2024, All rights reserved.</span>
            </div>
        </div>
    </footer>
                                            
</body>
</html>
