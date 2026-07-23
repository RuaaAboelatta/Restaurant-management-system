<nav class="navbar navbar-expand-sm  fixed-top bg-light justify-content-between align-items-center shadow px-5 py-3">
    
  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <i class="fa-solid fa-house  d-inline "></i>
      <a class="nav-link  d-inline " href="/">Home</a>
    </li>
    <li class="nav-item">
      <i class="fa-solid fa-utensils d-inline ms-5"></i>
      <a class="nav-link d-inline" href="/menu">Menu</a>
    </li>
    <li class="nav-item">
      <i class="fa-solid fa-calendar d-inline ms-5"></i>
      <a class="nav-link d-inline" href="/reservation">Reservation</a>
    </li>
    <li class="nav-item">
      <i class="fa-solid fa-cart-arrow-down ms-5"></i>
      <a class="nav-link  d-inline " href="/cart">Cart</a>
    </li>
  </ul>
  @guest
  <div>
    <a href="/login" class='orange-btn py-2 px-4'>Login</a>
    <a href="/register" class='orange-btn py-2 px-4'>Register</a>
  </div>
  @endguest
  @auth
  <div class="d-flex justify-content-between align-items-center">
      @if(Auth::user()->role === 'admin')
      <ul class="navbar-nav">
        <li class="nav-item">
      <i class="fa-solid fa-table-columns"></i>
      <a href="{{ route('admin.dashboard') }}" class="text-dark">Dashboard</a>
      </li>
      <li class="nav-item mx-3">
      <i class="fa-solid fa-clock"></i>
      <a href="{{ route('admin.bookings') }}" class="text-dark ">Bookings</a>
      </li>
      <li class="nav-item mx-3">
      <i class="fa-solid fa-dollar-sign"></i>
      <a href="{{ route('admin.orders') }}" class="text-dark ">Orders</a>
      </li>
      </ul>
      
    @endif
  <span class="px-2 border-start mx-2">
    Hi there, {{Auth::user()->name}}
  </span>
    

  <form action="/logout" method="POST">
    @csrf
    <button class="orange-btn p-2">Logout</button>
  </form>
  </div>
  
  @endauth
  
</nav>