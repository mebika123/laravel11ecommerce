<div class="col-lg-6">
    <div class="user-list-section my-5">
      <ul class="user-list">
        <li class="user-item my-2">
          <a href="#" class="f-14">Dashboard</a>
        </li>
        <li class="user-item my-2">
          <a href="{{ route('user.orders') }}" class="f-14">Orders</a>
        </li>
        <li class="user-item my-2">
          <a href="address.html" class="f-14">Address</a>
        </li>
        <li class="user-item my-2">
          <a href="account-detail.html" class="f-14">Account Details</a>
        </li>
        <li class="user-item my-2">
          <a href="wishlist.html" class="f-14">WishList</a>
        </li>
        <li class="user-item my-2">
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
            <a class="f-14" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              Logout
            </a>
        </form>
        </li>

      </ul>
    </div>
  </div>