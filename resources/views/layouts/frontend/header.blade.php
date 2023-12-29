  <!-- ======= Header ======= -->
  <header id="header" class="header">
      <div class="container-fluid d-flex container-xl">
        <div class="me-auto m-3">
            <a href="{{route('index')}}" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="{{ asset('assets/img/icon.png') }}"  alt="">
            </a>
        </div>
            <div class="m-3">
            @guest
              <button type="button" class="btn btn-warning overflow-" onclick="window.location.href='/login'">
                  Login
              </button>
              @endguest
              @auth
                  <form action="{{ route('logout') }}" method="POST">
                      @csrf
                      <a href="" class="dashboard-nav-item btn btn-warning" onclick="event.preventDefault();
                        this.closest('form').submit();"><i class="fas fa-sign-out-alt"></i> Logout </a>
                  </form>

              @endauth
            </div>
            @auth
            <div class="m-3">
                <a href="{{route('profile.edit')}}" class="dashboard-nav-item btn btn-warning"><i class="fas fa-user"></i>Profil</a>

                </div>
            @endauth

              <div class="form-group m-3">
                  <select class=" form-select" id="languageSelect">
                      <option data-thumbnail="{{ asset('assets/img/uk.png') }}"
                          {{ $app->getLocale()== 'uk' ? 'selected' : '' }}
                          value="UK">UK</option>
                      <option data-thumbnail="{{ asset('assets/img/ru.png') }}"
                          {{ $app->getLocale()== 'ru' ? 'selected' : '' }}
                          value="RU">RU</option>
                      <option data-thumbnail="{{ asset('assets/img/pl.png') }}"
                          {{ $app->getLocale()== 'pl' ? 'selected' : '' }}
                          value="PL">PL</option>
                      <option data-thumbnail="{{ asset('assets/img/de.png') }}"
                          {{ $app->getLocale()== 'de' ? 'selected' : '' }}
                          value="DE">DE</option>
                      <option data-thumbnail="{{ asset('assets/img/tr.png') }}"
                          {{ $app->getLocale()== 'tr' ? 'selected' : '' }}
                          value="TR">TR</option>
                  </select>
                  <div class="lang-select">
                      <button class="btn-select btn btn-warning" value=""></button>
                      <div class="b">
                          <ul id="a"></ul>
                      </div>
                  </div>
              </div>
                        {{-- <i class="mobile-nav-toggle mobile-nav-show fas fa-bars"></i>
                            <i class="mobile-nav-toggle mobile-nav-hide d-none fas fa-x mt-3"></i>
              <nav id="navbar" class="navbar">
                <ul>
                  <li><a href="index.html" class="active">Home</a></li>
                  <li><a href="about.html">About</a></li>
                  <li><a href="services.html">Services</a></li>
                  <li><a href="projects.html">Projects</a></li>
                  <li><a href="blog.html">Blog</a></li>
                  <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                      <li><a href="#">Dropdown 1</a></li>
                      <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                        <ul>
                          <li><a href="#">Deep Dropdown 1</a></li>
                          <li><a href="#">Deep Dropdown 2</a></li>
                          <li><a href="#">Deep Dropdown 3</a></li>
                          <li><a href="#">Deep Dropdown 4</a></li>
                          <li><a href="#">Deep Dropdown 5</a></li>
                        </ul>
                      </li>
                      <li><a href="#">Dropdown 2</a></li>
                      <li><a href="#">Dropdown 3</a></li>
                      <li><a href="#">Dropdown 4</a></li>
                    </ul>
                  </li>
                  <li><a href="contact.html">Contact</a></li>
                </ul>
              </nav><!-- .navbar --> --}}

          </div>
  </header><!-- End Header -->
