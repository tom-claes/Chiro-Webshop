<div x-cloak x-data="sidebar()" class="relative flex items-start ">
  
    <div x-cloak wire:ignore class="fixed top-0 bottom-0 left-0 z-30 block w-56 h-full min-h-screen overflow-y-auto text-gray-400 transition-all duration-300 ease-in-out bg-gray-900 shadow-lg overflow-x-hidden">
  
      <div class="flex flex-col items-stretch justify-between h-full">
        <div class="flex flex-col flex-shrink-0 w-full">
          <div class="flex items-center justify-center px-8 py-3 text-center">
            <a href="#" class="text-lg leading-normal text-gray-200 focus:outline-none focus:ring">Admin Paneel</a>
          </div>
  
          <nav>
            <div class="flex-grow md:block md:overflow-y-auto overflow-x-hidden">
  
              <a class="flex items-center px-4 py-3 hover:bg-gray-800 focus:bg-gray-800 hover:text-gray-400 focus:outline-none focus:ring {{ request()->is('admin/bestellingen*') ? 'bg-gray-800' : '' }}" href="{{ route('admin.orders') }}">
                <img src="{{asset('IMG\admin-icons\orders.svg')}}" alt="">
                <span class="mx-4">Bestellingen</span>
              </a>

              <a class="flex items-center px-4 py-3 hover:bg-gray-800 focus:bg-gray-800 hover:text-gray-400 focus:outline-none focus:ring" {{ request()->is('admin/stocks*') ? 'bg-gray-800' : '' }}" href="{{ route('admin.stocks') }}">
                <img src="{{asset('IMG\admin-icons\stock.svg')}}" alt="">
                <span class="mx-4">Stock</span>
              </a>
  
              <a class="flex items-center px-4 py-3 hover:bg-gray-800 focus:bg-gray-800 hover:text-gray-400 focus:outline-none focus:ring" {{ request()->is('admin/catalogus*') ? 'bg-gray-800' : '' }}" href="{{ route('admin.catalogus') }}">
                <img src="{{asset('IMG\admin-icons\catalogue.svg')}}" alt="">
                <span class="mx-4">Catalogus</span>
              </a>

              <a class="flex items-center px-4 py-3 hover:bg-gray-800 focus:bg-gray-800 hover:text-gray-400 focus:outline-none focus:ring" {{ request()->is('size*') ? 'bg-gray-800' : '' }}" href="{{ route('admin.size') }}">
                <img src="{{asset('IMG\admin-icons\sizes.svg')}}" alt="">
                <span class="mx-4">Maten</span>
              </a>

              <a class="flex items-center px-4 py-3 hover:bg-gray-800 focus:bg-gray-800 hover:text-gray-400 focus:outline-none focus:ring" {{ request()->is('admin/faq*') ? 'bg-gray-800' : '' }}" href="{{ route('admin.faq') }}">
                <img src="{{asset('IMG\admin-icons\faq.svg')}}" alt="">
                <span class="mx-4">FAQ's</span>
              </a>

              <a class="flex items-center px-4 py-3 hover:bg-gray-800 focus:bg-gray-800 hover:text-gray-400 focus:outline-none focus:ring" {{ request()->is('admin/news*') ? 'bg-gray-800' : '' }}" href="{{ route('admin.news') }}">
                <img src="{{asset('IMG\admin-icons\news.svg')}}" alt="">
                <span class="mx-4">Niews</span>
              </a>

              <a class="flex items-center px-4 py-3 hover:bg-gray-800 focus:bg-gray-800 hover:text-gray-400 focus:outline-none focus:ring" {{ request()->is('admin/contact*') ? 'bg-gray-800' : '' }}" href="{{ route('admin.contact') }}">
                <img src="{{asset('IMG\admin-icons\contact.svg')}}" alt="">
                <span class="mx-4">Contact</span>    
              </a>

              <a class="flex items-center px-4 py-3 hover:bg-gray-800 focus:bg-gray-800 hover:text-gray-400 focus:outline-none focus:ring" {{ request()->is('admin/users*') ? 'bg-gray-800' : '' }}" href="{{ route('admin.users') }}">
                <img src="{{asset('IMG\admin-icons\users.svg')}}" alt="">
                <span class="mx-4">Gebruikers</span>    
              </a>
  
            </div>
  
          </nav>
  
        </div>


        <div>
            <div>
              <a class="mx-4" href="{{route('home')}}">Homepagina Webshop</a>
            </div>
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
        
                <button title="Logout" class="block px-4 py-3" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <svg class="text-gray-400 fill-current w-7 h-7" fill-rule="evenodd" clip-rule="evenodd" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" aria-label="door-leave" viewBox="0 0 32 32" title="door-leave">
                        <g>
                            <path d="M27.708,15.293c0.39,0.39 0.39,1.024 0,1.414l-4,4c-0.391,0.391 -1.024,0.391 -1.415,0c-0.39,-0.39 -0.39,-1.024 0,-1.414l2.293,-2.293l-11.586,0c-0.552,0 -1,-0.448 -1,-1c0,-0.552 0.448,-1 1,-1l11.586,0l-2.293,-2.293c-0.39,-0.39 -0.39,-1.024 0,-1.414c0.391,-0.391 1.024,-0.391 1.415,0l4,4Z"></path>
                            <path d="M11.999,8c0.001,0 0.001,0 0.002,0c1.699,-0.001 2.859,0.045 3.77,0.25c0.005,0.001 0.01,0.002 0.015,0.003c0.789,0.173 1.103,0.409 1.291,0.638c0,0 0,0.001 0,0.001c0.231,0.282 0.498,0.834 0.679,2.043c0,0.001 0,0.002 0.001,0.003c0.007,0.048 0.014,0.097 0.021,0.147c0.072,0.516 0.501,0.915 1.022,0.915c0.584,0 1.049,-0.501 0.973,-1.08c-0.566,-4.332 -2.405,-4.92 -7.773,-4.92c-7,0 -8,1 -8,10c0,9 1,10 8,10c5.368,0 7.207,-0.588 7.773,-4.92c0.076,-0.579 -0.389,-1.08 -0.973,-1.08c-0.521,0 -0.95,0.399 -1.022,0.915c-0.007,0.05 -0.014,0.099 -0.021,0.147c-0.001,0.001 -0.001,0.002 -0.001,0.003c-0.181,1.209 -0.448,1.762 -0.679,2.044l0,0c-0.188,0.229 -0.502,0.465 -1.291,0.638c-0.005,0.001 -0.01,0.002 -0.015,0.003c-0.911,0.204 -2.071,0.25 -3.77,0.25c-0.001,0 -0.001,0 -0.002,0c-1.699,0 -2.859,-0.046 -3.77,-0.25c-0.005,-0.001 -0.01,-0.002 -0.015,-0.003c-0.789,-0.173 -1.103,-0.409 -1.291,-0.638l0,0c-0.231,-0.282 -0.498,-0.835 -0.679,-2.043c0,-0.001 0,-0.003 -0.001,-0.005c-0.189,-1.247 -0.243,-2.848 -0.243,-5.061c0,0 0,0 0,0c0,-2.213 0.054,-3.814 0.243,-5.061c0.001,-0.002 0.001,-0.004 0.001,-0.005c0.181,-1.208 0.448,-1.76 0.679,-2.042c0,0 0,-0.001 0,-0.001c0.188,-0.229 0.502,-0.465 1.291,-0.638c0.005,-0.001 0.01,-0.002 0.015,-0.003c0.911,-0.205 2.071,-0.251 3.77,-0.25Z"></path>
                        </g>
                    </svg>
                </button>
            </form>
        </div>
        
      </div>
  
    </div>
  </div>
  