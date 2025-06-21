<div class="w-64 bg-primary-800 text-white">
    <div class="p-4 border-b border-primary-700">
        <h1 class="text-2xl font-bold">Innovative Environmental Solutions</h1>
        <p class="text-primary-200 text-sm">Admin Dashboard</p>
    </div>
    <nav class="p-4">
        <ul>
            <li class="mb-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center p-2 rounded hover:bg-primary-700 @if(request()->routeIs('admin.dashboard')) bg-primary-700 @endif">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
            </li>
            <li class="mb-2">
                <a href="{{ route('admin.users.index') }}" class="flex items-center p-2 rounded hover:bg-primary-700 @if(request()->routeIs('admin.users.*')) bg-primary-700 @endif">
                    <i class="fas fa-users mr-3"></i>
                    Users
                </a>
            </li>
            <li class="mb-2">
                <a href="{{ route('admin.products.index') }}" class="flex items-center p-2 rounded hover:bg-primary-700 @if(request()->routeIs('admin.products.*')) bg-primary-700 @endif">
                    <i class="fas fa-box mr-3"></i>
                    Products
                </a>
            </li>
            <li class="mb-2">
                <a href="{{ route('admin.orders.index') }}" class="flex items-center p-2 rounded hover:bg-primary-700 @if(request()->routeIs('admin.orders.*')) bg-primary-700 @endif">
                    <i class="fas fa-shopping-cart mr-3"></i>
                    Orders
                </a>
            </li>
            <li class="mb-2">
                <a href="{{ route('admin.icons.index') }}" class="flex items-center p-2 rounded hover:bg-primary-700 @if(request()->routeIs('admin.about.*')) bg-primary-700 @endif">
                    <i class="fa-solid fa-images mr-3"></i>
                    Icons
                </a>
                <li class="mb-2">
            <li class="mb-2">
                <a href="{{ route('admin.contact-messages.index') }}" class="flex items-center p-2 rounded hover:bg-primary-700 @if(request()->routeIs('admin.products.*')) bg-primary-700 @endif">
                  <i class="fa-solid fa-envelope mr-3"></i>
                  
                  Contact Messages
              </a>
          </li>
            <li class="mb-2">
                <a href="{{ route('admin.about.index') }}" class="flex items-center p-2 rounded hover:bg-primary-700 @if(request()->routeIs('admin.about.*')) bg-primary-700 @endif">
                    <i class="fas fa-info-circle mr-3"></i>
                    About Us
                </a>
                <li class="mb-2">
        </ul>
    </nav>
</div>