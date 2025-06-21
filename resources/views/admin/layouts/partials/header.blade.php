<header class="bg-white shadow-sm">
    <div class="flex justify-between items-center p-4">
        <h2 class="text-xl font-semibold text-gray-800">@yield('title')</h2>
        <div class="flex items-center space-x-4">
            <div class="relative">
                <i class="fas fa-bell text-gray-600"></i>
                <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
            </div>
            <div class="flex items-center">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->full_name) }}&background=22c55e&color=fff" 
                     alt="User" class="w-8 h-8 rounded-full mr-2">
                <span class="text-gray-700">{{ auth()->user()->full_name }}</span>
            </div>
        </div>
    </div>
</header>