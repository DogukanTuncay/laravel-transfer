@extends('layouts.frontend.app')
@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/aos.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/glightbox.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
@endsection

@section('js')
<script src="{{asset('assets/js/swiper-bundle.min.js')}}"></script>
<script src="{{asset('assets/js/aos.js')}}"></script>
<script src="{{asset('assets/js/swiper-bundle.min.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script src="{{asset('assets/js/glightbox.min.js')}}"></script>
<script src="{{asset('assets/js/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('assets/js/purecounter_vanilla.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>

<script>
const checkboxes = document.querySelectorAll('.aracCheck');
const submitBtn = document.getElementById('submitBtn');

checkboxes.forEach(function (checkbox) {

    checkbox.addEventListener('change', function () {

        const checkedBoxes = document.querySelectorAll('.aracCheck:checked');
        const dataId = this.getAttribute('data-id');
        const fiyat = this.getAttribute('data-fiyat');
        document.querySelector('#arac_tur_id').value = dataId;
        document.querySelector('#fiyat').value = fiyat;
        if (checkedBoxes.length > 0) {
            // Eğer en az bir checkbox seçiliyse
            submitBtn.disabled = false;
            checkboxes.forEach(function (otherCheckbox) {
                if (otherCheckbox !== checkbox) {
                    otherCheckbox.checked = false;
                }
            });
        } else {
            // Eğer hiçbir checkbox seçili değilse
            submitBtn.disabled = true;
        }

    });

});

</script>
 <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
 <script>
   const input = document.querySelector("#phone");
   if(input){
    var phone =  window.intlTelInput(input, {
     utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
     initialCountry: "auto",
     geoIpLookup: function(callback) {
     fetch("https://ipapi.co/json")
       .then(function(res) { return res.json(); })
       .then(function(data) { callback(data.country_code); })
       .catch(function() { callback("us"); });
         }
     })
   }
   $("#registerForm").submit(function() {

   var full_number = phone.getNumber(intlTelInputUtils.numberFormat.E164);
    $("input[name='phone[main]'").val(full_number);
    });
 </script>

@endsection
@section('content')

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero">
        <div class="info d-flex align-items-center">
          <div class="container">



          </div>
        </div>

        <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
          @foreach ($slides as $key => $slide)
              <div class="carousel-item {{ $key === 0 ? 'active' : '' }}" style="background-image: url('{{ asset($slide->image_url) }}'); object-fit:contain;">
                  <!-- İsterseniz buraya başka içerikler de ekleyebilirsiniz -->
              </div>
          @endforeach


          <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon fas fa-chevron-left" aria-hidden="true"></span>
          </a>

          <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon fas fa-chevron-right" aria-hidden="true"></span>
          </a>

        </div>

      </section><!-- End Hero Section -->
      <section class=" section-bg" >
        <div class="container py-2" id="transferArea">
            @foreach ($transfers as $transfer)
            @if ($transfer->aracTur != null)

            <article class="postcard light blue">
                <div class="postcard__img_link pe-auto">
                    <img class="postcard__img" src="{{asset($transfer->aracTur->arac_resim)}}" alt="Image Title" />
                </div>

                <div class="postcard__text t-dark">

                    <h1 class="postcard__title blue"><div>{{$transfer->aracTur->arac_tur_adi}} (1-{{$transfer->aracTur->koltuk_sayisi}}) Kişilik</div></h1>
                    <div class="postcard__subtitle small">
                        <time datetime="{{$request->date}}">
                            <i class="fas fa-calendar-alt mr-2"></i> {{$request->date}}
                        </time>
                    </div>
                    <div class="postcard__bar"></div>
                    <div class="postcard__preview-txt">
                        <i class="fa-solid fa-map-pin"></i> {{$transfer->nereden->konum_adi}} <i class="fas fa-arrow-right"></i> {{$transfer->nereye->konum_adi}} <i class="fa-solid fa-flag-checkered"></i>
                    </div>
                    <form action="" class=""></form>

                    <ul class="postcard__tagbox">
                        Araç Özellikleri:
                        @foreach ($transfer->aracTur->ozellikler as $ozellik)
                        <li class="tag__item"><i class="fas fa-star"></i>{{$ozellik->ozellik}}</li>
                        @endforeach
                    </ul>
                    <div class="postcard__preview-txt p-5 mt-4 mb-4">
                        @if (isset($transfer->eskiFiyat))
                        <span class=" h5"> Fiyat : <del>{{$transfer->eskiFiyat}} {{$request->parabirimi}}</del></span> <br><span class="h3">  {{$transfer->fiyat}}{{$request->parabirimi}}</span>
                        <div class="text-primary"> Üyeliğinize Özel Kupon İle İndirim uygulanmıştır.</div>
                        @else
                        <span class="h3"> Fiyat : {{$transfer->fiyat}} {{$request->parabirimi}}</span>
                        @guest
                        <div class="text-primary"> Üye Olarak Özel Kuponlardan Faydalanabilirsiniz.</div>
                        @endguest
                        @auth
                        <div class="text-primary"> Henüz Mevcut Kuponunuz Yok. Kupon Eklendiğinde otomatik indirim uygulanır.</div>
                        @endauth

                        @endif
                    </div>
                    <div class="form-check form-switch form-switch-xl mt-3">
                        <input class="form-check-input aracCheck" data-fiyat="{{$transfer->fiyat}}" data-id="{{$transfer->aracTur->id}}" style="transform: scale(1.4);" type="checkbox" id="flexSwitchCheckDefault{{$transfer->aracTur->id}}">
                        <label class="form-check-label" for="flexSwitchCheckDefault{{$transfer->aracTur->id}}">Seç</label>
                      </div>

                </div>
            </article>
            @endif
            @endforeach

            @if(count($transfers) == 0)
            <div class=" h2 bg-warning text-center p-4">İSTEĞİNİZE UYGUN ARAÇ BULUNAMADI</div>
            @endif
            <form  action="{{ route('rezervasyon.store') }}" id="registerForm" method="post">
                @csrf
                <input type="hidden" name="nereden_id" value="{{ request('nereden_id') }}">
                <input type="hidden" name="nereye_id" value="{{ request('nereye_id') }}">
                <input type="hidden" name="yetiskin" value="{{ request('yetiskin') }}">
                <input type="hidden" name="cocuk" value="{{ request('cocuk') }}">
                <input type="hidden" name="date" value="{{ request('date') }}">
                <input type="hidden" name="parabirimi" value="{{ request('parabirimi') }}">
                <input type="hidden" id="fiyat" name="fiyat" value="0">
                <input type="hidden" id="kupon" name="kuponId">
                <input type="hidden" id="arac_tur_id" name="arac_turu_id">
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="firstName" class="form-label">İsim</label>
                        <input type="text" required class="form-control" id="firstName" name="isim" placeholder="İsminizi girin" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="lastName" class="form-label">Soyisim</label>
                        <input type="text" required class="form-control" id="lastName" name="soyisim" placeholder="Soyisminizi girin" required>
                    </div>
                    <div class="mb-3 mt-4">
                        <label for="hour" class="form-label">Sizi Saat Kaçta Alalım ?</label><br>
                        <x-input-time-select name="hour" ></x-input-time-select>
                        <x-input-error :messages="$errors->all()" class="mt-2" />

                      </div>
                    <div class="mb-3 mt-4">
                        <label for="phone" class="form-label">Telefon Numarası</label><br>
                        <input type="tel" required name="phone[main]" id="phone" class="form-control">
                        <x-input-error :messages="$errors->all()" class="mt-2" />

                      </div>
                </div>


                <!-- Diğer form alanları -->

                <button type="submit" disabled id=submitBtn class="btn btn-success">Rezervasyon Oluştur</button>
            </form>
        </div>
    </section>

@endsection
