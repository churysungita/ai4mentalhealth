      
     <style>
    .profile-image {
        width: 50px;
        height: 50px;
        overflow: hidden;
        border: 5px solid #00abff;
        border-radius: 50%;
        transition: border 0.3s ease-in-out;
    }

    .profile-image:hover {
        border-color: #003bff; /* Change this to your primary color */
    }

    .profile-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
 <nav class="navbar">
          <a href="#" class="sidebar-toggler">
              <i data-feather="menu"></i>
          </a>
          <div class="navbar-content">
             
              <ul class="navbar-nav">
              
               
                  <li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <div class="profile-image">
        <img class="wd-50 ht-50 rounded-circle" src="{{ asset('assets/images/favicon-32x32.png') }}" alt="profile">
    </div>
</a>


                      <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                          <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                              <div class="mb-3">
                                  {{-- <img class="wd-80 ht-80 rounded-circle" src="https://via.placeholder.com/80x80" alt=""> --}}
                              </div>
                              <div class="text-center">
                                  @auth('admins')
                                  <p class="tx-16 fw-bolder">{{ auth('admins')->user()->first_name }} {{ auth('admins')->user()->last_name }}</p>
                                  <p class="tx-12 text-muted">{{ auth('admins')->user()->email }}</p>
                                  @endauth
                              </div>

                          </div>
                          <ul class="list-unstyled p-1">
                              {{-- <li class="dropdown-item py-2">
                                        <a href="pages/general/profile.html" class="text-body ms-0">
                                            <i class="me-2 icon-md" data-feather="user"></i>
                                            <span>Profile</span>
                                        </a>
                                    </li> --}}
                              {{-- <li class="dropdown-item py-2">
                                        <a href="javascript:;" class="text-body ms-0">
                                            <i class="me-2 icon-md" data-feather="edit"></i>
                                            <span>Edit Profile</span>
                                        </a>
                                    </li>
                                    <li class="dropdown-item py-2">
                                        <a href="javascript:;" class="text-body ms-0">
                                            <i class="me-2 icon-md" data-feather="repeat"></i>
                                            <span>Switch User</span>
                                        </a>
                                    </li> --}}
                              <li class="dropdown-item py-2">
                                  <a href="{{ route('admin.logout') }}" class="text-body ms-0" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                      <i class="me-2 icon-md" data-feather="log-out"></i>
                                      <span>Log Out</span>
                                  </a>

                                  <!-- Hidden form to perform the logout via POST -->
                                  <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                      @csrf
                                      <!-- Add CSRF token for security -->
                                  </form>
                              </li>


                          </ul>
                      </div>
                  </li>
              </ul>
          </div>
      </nav>
