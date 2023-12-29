
<header>
            <div class="menu-toggle "><i class="text-white fas fa-bars"></i></div>
            <a href="{{route('index')}}" class="brand-logo"><img src="{{asset('assets/img/icon.png') }}" width="140px" alt=""></a>
        </header>
        <nav class="dashboard-nav-list">
            <a href="{{route('dashboard')}}" class="dashboard-nav-item">
                <i class="fas fa-home"></i>
                Ana Sayfa
            </a>
            <a href="{{route('slider')}}" class="dashboard-nav-item"><i class="fas fa-image"></i>Slider</a>

            <a href="{{route('aracTuru')}}" class="dashboard-nav-item"><i class="fas fa-car"></i>Araç Türleri</a>
            <a href="{{route('konum')}}" class="dashboard-nav-item"><i class="fas fa-map-pin"></i>Konum</a>
            <a href="{{route('transfer')}}" class="dashboard-nav-item"><i class="fas fa-arrow-right-arrow-left"></i>Transfer Ekle</a>
            <a href="{{route('portfoy')}}" class="dashboard-nav-item"><i class="fas fa-image"></i> Resim Ekle</a>
            <a href="{{route('users')}}" class="dashboard-nav-item"><i class="fas fa-user"></i>Kayıtlı Kullanıcılar</a>
            <a href="{{route('yorum')}}" class="dashboard-nav-item"><i class="fas fa-comment"></i>Kullanıcı Yorumları</a>
            {{-- <div class='dashboard-nav-dropdown'><a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i
                        class="fas fa-money-check-alt"></i> Payments </a>
                <div class='dashboard-nav-dropdown-menu'><a href="#" class="dashboard-nav-dropdown-item">All</a><a
                        href="#" class="dashboard-nav-dropdown-item">Recent</a><a href="#"
                        class="dashboard-nav-dropdown-item"> Projections</a>
                </div>
            </div> --}}

            <div class="nav-item-divider"></div>
            <form action="{{route('logout')}}" method="POST">
                @csrf
            <a href="" class="dashboard-nav-item" onclick="event.preventDefault();
            this.closest('form').submit();"><i class="fas fa-sign-out-alt"></i> Çıkış Yap </a>
            </form>
        </nav>
