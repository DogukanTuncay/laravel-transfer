@extends('layouts.frontend.app')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/glightbox.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

@endsection

@section('js')

<script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/aos.js') }}"></script>
<script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/js/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

@endsection
@section('content')



<!-- ======= Hero Section ======= -->
<section id="hero" class="hero">
    <div class="info d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6" id="welcomeForm">
                    <h4 class="text-center  text-uppercase text-warning">@lang('welcome.slider_text')</h4>

                    <form id="signUpForm" action="{{ route('aracSecimi') }}">
                        @csrf
                        <!-- start step indicators -->
                        <div class="form-header d-flex mb-4">
                            <span class="stepIndicator">Güzergah Bilgisi</span>
                            <span class="stepIndicator">Kişi Bilgisi</span>
                            <span class="stepIndicator">Tarih ve Para Birimi</span>
                        </div>
                        <!-- end step indicators -->
                        <!-- step one -->
                        <div class="step">
                            <div class="mb-3">
                                <label class="mb-2" for="nereden">Nereden ?</label>
                                <select required class="form-select select2Transfer" name="nereden_id"
                                    id="neredenSelect">
                                    @foreach($konums as $konum)
                                        <option value="{{ $konum->id }}">{{ $konum->konum_adi }}</option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 mt-2">
                                <label class="mb-2" for="nereden_id">Nereye ?</label>
                                <select required class="form-select select2Transfer" name="nereye_id" id="nereyeSelect">
                                    @foreach($konums as $konum)
                                        <option value="{{ $konum->id }}">{{ $konum->konum_adi }}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- step two -->
                        <div class="step">
                            <div class="mb-3">
                                <label for="yetiskin">Yetişkin Sayısı</label>
                                <input required type="number" value="0" name="yetiskin">
                            </div>
                            <div class="mb-3">
                                <label for="cocuk">Çocuk Sayısı</label>
                                <input required type="number" value="0" name="cocuk">
                            </div>
                        </div>

                        <!-- step three -->
                        <div class="step">
                            <div class="mb-3">
                                <div>
                                    <label class="mb-2" for="date">Tarih</label>
                                    <input type="text" class="date text-center" value="Select a Date" readonly
                                        id=datepicker name="date">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="mb-2" for="paraBirimi">Para Birimi</label>

                                <select class="form-select" name="parabirimi" id="">
                                    <option value="GBP">£ GBP</option>
                                    <option value="EUR">€ EUR</option>
                                    <option value="USD">$ USD</option>
                                    <option selected value="TRY">₺ TRY</option>
                                    <option value="RUB">₽ RUB</option>
                                </select>
                            </div>
                        </div>

                        <!-- start previous / next buttons -->
                        <div class="form-footer d-flex">
                            <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                            <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                        </div>
                        @auth
                            <div class="btn mt-4  btn-outline-success d-flex p-2" data-bs-toggle="modal"
                                data-bs-target="#yorumModal">
                                İşletmemize Yorum Bırakmak İçin Tıklayınız
                            </div>

                        @endauth

                        <x-input-error :messages="$errors->all()" class="mt-2" />

                        <!-- end previous / next buttons -->
                    </form>
                    {{-- <h4 class="text-center text-uppercase text-warning">FORMU DOLDURUN SİZE ULAŞALIM</h4> --}}

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
        @foreach($slides as $key => $slide)
            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}"
                style="background-image: url('{{ asset($slide->image_url) }}'); object-fit:contain;">
                <!-- Yeni yazılımcı ,İstersen buraya başka içerikler de ekleyebilirsin -->
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

<main id="main">
    <section id="testimonials" class="testimonials section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Araçlarımız</h2>
                <p>Size Hizmet Vermekte Olan Araçlarımız</p>
            </div>

            <div class="slides-2 swiper">
                <div class="swiper-wrapper">
                    @foreach($araclar as $arac)
                        <div class="swiper-slide">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    {{-- <img src="{{asset('assets/img/testimonials/testimonials-1.jpg') }}"
                                    class="testimonial-img" alt=""> --}}
                                    <h3>{{ $arac->arac_tur_adi }}(1-{{ $arac->koltuk_sayisi }} Kişilik)</h3>
                                    <div class="stars">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                            class="fas fa-star"></i><i class="fas fa-star"></i><i
                                            class="fas fa-star"></i>
                                    </div>
                                    <div class="row">
                                        <div class="col-9">
                                            <img src="{{ asset($arac->arac_resim) }}" alt="Araç Resmi"
                                                class="img-fluid  card-img-top ">
                                        </div>
                                        <div class="col-3 text-center">
                                            <h3 class="">Araç Özellikleri</h3>
                                            <div class="row"></div>
                                            @foreach($arac->ozellikler as $ozellik)
                                                <div>
                                                    <span
                                                        class="badge badge-pill bg-success">{{ $ozellik->ozellik }}</span>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section><!-- End Testimonials Section -->
    <section id="prices" class="prices section-bg">
        <div class="section-header">
            <h2>Ücret Tablomuz</h2>
            <p>Bu alan sizlerle paylaşmak istediğimiz Ücret Tablomuz için oluşturulmuştur.</p>
        </div>
        <div class="container" data-aos="fade">
            <div class="row gx-5">
                @foreach($araclar as $arac)
                    <div class="col-lg-6 mb-3">

                        <div class="card">
                            <img src="{{ $arac->arac_resim }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-center">{{ $arac->arac_tur_adi }}</h5>
                                <ul class="list-group list-group-flush">
                                    @if(count($arac->transfer) > 0)
                                        @foreach($arac->transfer as $transfer)
                                            <li class="list-group-item">{{ $transfer->nereden->konum_adi }} <i
                                                    class="fa-solid fa-arrow-right"></i>
                                                {{ $transfer->nereye->konum_adi }}
                                                <span class="float-end"><i
                                                        class="fa-solid fa-euro-sign"></i>{{ $transfer->fiyat }}</span>
                                            </li>

                                        @endforeach
                                    @else
                                        <div class="text-danger">HENÜZ GİRİLMİŞ TRANSFER YOK.</div>
                                    @endif

                                </ul>

                            </div>

                        </div>

                    </div>

                @endforeach
            </div>
        </div>
    </section>
    <section class="yorumlar" id="yorumlar">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h2>Müşteri Yorumlarımız</h2>
                <p>Bu alanda kayıtlı müşterilerimizin yorumlarını görebilirsiniz. <br> Siz de kayıt olarak yorum
                    bırakabilirsiniz</p>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="card-body p-4">
                            <div class="card shadow-0">

                                @foreach($yorums as $yorum)

                                    <div class="d-flex flex-row p-3">

                                        <img src="{{ asset('assets/img/avatar.png') }}" width="40"
                                            height="40" class="rounded-circle mr-3">

                                        <div class="w-100">

                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex flex-row align-items-center">
                                                    <span class="mr-2 h5">{{ $yorum->user->name }}</span>

                                                </div>
                                                <div>

                                                    @for ($i = 0; $i  < $yorum->rating; $i++)
                                                    <i class="fas fa-star text-warning"></i>
                                                    @endfor
                                                    </div>

                                                <small>{{ $yorum->created_at->diffForHumans() }}</small>
                                            </div>

                                            <p class="text-justify float-start comment-text mb-0">{{ $yorum->yorum }}</p>

                                        </div>

                                    </div>


                                @endforeach
                                <div class="card-footer">
                                    Yorumlarınız Bizler İçin Değerlidir.
                                </div>
                            </div>

                        </div>
                        {{ $yorums->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="projects" class="projects">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Portföyümüz</h2>
                <p>Bu alan sizlerle paylaşmak istediğimiz porföy için oluşturulmuştur.</p>
            </div>

            <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry"
                data-portfolio-sort="original-order">
                <ul class="portfolio-flters" data-aos="fade-up" data-aos-delay="100">
                    <li data-filter="*" class="filter-active">All</li>
                    @foreach($categories as $category)
                        <li data-filter=".filter-{{ $category->name }}">{{ $category->name }}</li>

                    @endforeach
                </ul><!-- End Projects Filters -->

                <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">
                    @foreach($portfolios as $portfolio)
                        <div class="col-lg-4 col-md-6 portfolio-item filter-{{ $portfolio->category->name }}">
                            <div class="portfolio-content h-100">
                                <img src="{{ asset($portfolio->image_url) }}" class="img-fluid" alt="">
                                <div class="portfolio-info">
                                    <h4>{{ $portfolio->category->name }} Resmi</h4>
                                    <p>{{ $portfolio->description }}</p>
                                    <a target="_blank" href="{{ asset($portfolio->image_url) }}" title="More Details"
                                        class="details-link"><i class="fas fa-link"></i></a>
                                    <a href="{{ asset($portfolio->image_url) }}"
                                        title="{{ $portfolio->description }}"
                                        data-gallery="portfolio-gallery-construction" class="glightbox preview-link">
                                        <i class="fa-solid fa-magnifying-glass-plus"></i></a>

                                </div>
                            </div>
                        </div><!-- End Projects Item -->
                    @endforeach

                </div><!-- End Projects Container -->

            </div>

        </div>
    </section><!-- End Our Projects Section -->

    <!-- ======= Constructions Section ======= -->
    {{-- <section id="constructions" class="constructions">
        <div class="container" data-aos="fade-up">

          <div class="section-header">
            <h2>Constructions</h2>
            <p>Nulla dolorum nulla nesciunt rerum facere sed ut inventore quam porro nihil id ratione ea sunt quis dolorem dolore earum</p>
          </div>

          <div class="row gy-4">

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
              <div class="card-item">
                <div class="row">
                  <div class="col-xl-5">
                     <div class="card-bg" style="background-image:{{ asset('assets/img/constructions-1.jpg') }};">
    </div>
    </div>
    <div class="col-xl-7 d-flex align-items-center">
        <div class="card-body">
            <h4 class="card-title">Eligendi omnis sunt veritatis.</h4>
            <p>Fuga in dolorum et iste et culpa. Commodi possimus nesciunt modi voluptatem placeat deleniti adipisci.
                Cum delectus doloribus non veritatis. Officia temporibus illo magnam. Dolor eos et.</p>
        </div>
    </div>
    </div>
    </div>
    </div><!-- End Card Item -->

    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
        <div class="card-item">
            <div class="row">
                <div class="col-xl-5">
                    <div class="card-bg"
                        style="background-image:{{ asset('assets/img/constructions-2.jpg') }};">
                    </div>
                </div>
                <div class="col-xl-7 d-flex align-items-center">
                    <div class="card-body">
                        <h4 class="card-title">Possimus ut sed velit assumenda</h4>
                        <p>Sunt deserunt maiores voluptatem autem est rerum perferendis rerum blanditiis. Est laboriosam
                            qui iste numquam laboriosam voluptatem architecto. Est laudantium sunt at quas aut hic. Eum
                            dignissimos.</p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Card Item -->

    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
        <div class="card-item">
            <div class="row">
                <div class="col-xl-5">
                    <div class="card-bg"
                        style="background-image:{{ asset('assets/img/constructions-3.jpg') }};">
                    </div>
                </div>
                <div class="col-xl-7 d-flex align-items-center">
                    <div class="card-body">
                        <h4 class="card-title">Error beatae dolor inventore aut</h4>
                        <p>Dicta porro nobis. Velit cum in. Nesciunt dignissimos enim molestiae facilis numquam quae
                            quaerat ipsam omnis. Neque debitis ipsum at architecto officia laboriosam odit. Ut sunt
                            temporibus nulla culpa.</p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Card Item -->

    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
        <div class="card-item">
            <div class="row">
                <div class="col-xl-5">
                    <div class="card-bg"
                        style="background-image:{{ asset('assets/img/constructions-4.jpg') }};">
                    </div>
                </div>
                <div class="col-xl-7 d-flex align-items-center">
                    <div class="card-body">
                        <h4 class="card-title">Expedita voluptas ut ut nesciunt</h4>
                        <p>Aut est quidem doloremque voluptatem magnam quis excepturi vero quia. Eum eos doloremque
                            architecto illo at beatae dolore. Fugiat suscipit et sint ratione dolores. Aut aliquid ea
                            dolores libero nobis.</p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Card Item -->

    </div>

    </div>
    </section><!-- End Constructions Section --> --}}

    <!-- ======= Services Section ======= -->
    {{-- <section id="services" class="services section-bg">
        <div class="container" data-aos="fade-up">

          <div class="section-header">
            <h2>Services</h2>
            <p>Voluptatem quibusdam ut ullam perferendis repellat non ut consequuntur est eveniet deleniti fignissimos eos quam</p>
          </div>

          <div class="row gy-4">

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
              <div class="service-item  position-relative">
                <div class="icon">
                    <i class="fa-solid fa-mountain-city"></i>
                </div>
                <h3>Nesciunt Mete</h3>
                <p>Provident nihil minus qui consequatur non omnis maiores. Eos accusantium minus dolores iure perferendis tempore et consequatur.</p>
                <a href="service-details.html" class="readmore stretched-link">Learn more <i class="bx bx-arrow-right"></i></a>
              </div>
            </div><!-- End Service Item -->

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
              <div class="service-item position-relative">
                <div class="icon">
                  <i class="fas fa-arrow-up-from-ground-water"></i>
                </div>
                <h3>Eosle Commodi</h3>
                <p>Ut autem aut autem non a. Sint sint sit facilis nam iusto sint. Libero corrupti neque eum hic non ut nesciunt dolorem.</p>
                <a href="service-details.html" class="readmore stretched-link">Learn more <i class="bx bx-arrow-right"></i></a>
              </div>
            </div><!-- End Service Item -->

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
              <div class="service-item position-relative">
                <div class="icon">
                  <i class="fas fa-compass-drafting"></i>
                </div>
                <h3>Ledo Markt</h3>
                <p>Ut excepturi voluptatem nisi sed. Quidem fuga consequatur. Minus ea aut. Vel qui id voluptas adipisci eos earum corrupti.</p>
                <a href="service-details.html" class="readmore stretched-link">Learn more <i class="bx bx-arrow-right"></i></a>
              </div>
            </div><!-- End Service Item -->

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
              <div class="service-item position-relative">
                <div class="icon">
                  <i class="fas fa-trowel-bricks"></i>
                </div>
                <h3>Asperiores Commodit</h3>
                <p>Non et temporibus minus omnis sed dolor esse consequatur. Cupiditate sed error ea fuga sit provident adipisci neque.</p>
                <a href="service-details.html" class="readmore stretched-link">Learn more <i class="bx bx-arrow-right"></i></a>
              </div>
            </div><!-- End Service Item -->

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
              <div class="service-item position-relative">
                <div class="icon">
                  <i class="fas fa-helmet-safety"></i>
                </div>
                <h3>Velit Doloremque</h3>
                <p>Cumque et suscipit saepe. Est maiores autem enim facilis ut aut ipsam corporis aut. Sed animi at autem alias eius labore.</p>
                <a href="service-details.html" class="readmore stretched-link">Learn more <i class="bx bx-arrow-right"></i></a>
              </div>
            </div><!-- End Service Item -->

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
              <div class="service-item position-relative">
                <div class="icon">
                  <i class="fas fa-arrow-up-from-ground-water"></i>
                </div>
                <h3>Dolori Architecto</h3>
                <p>Hic molestias ea quibusdam eos. Fugiat enim doloremque aut neque non et debitis iure. Corrupti recusandae ducimus enim.</p>
                <a href="service-details.html" class="readmore stretched-link">Learn more <i class="bx bx-arrow-right"></i></a>
              </div>
            </div><!-- End Service Item -->

          </div>

        </div>
      </section><!-- End Services Section --> --}}

    <!-- ======= Alt Services Section ======= -->
    {{-- <section id="alt-services" class="alt-services">
        <div class="container" data-aos="fade-up">

          <div class="row justify-content-around gy-4">
             <div class="col-lg-6 img-bg" style="background-image:{{ asset('assets/img/alt-services.jpg') }};"
    data-aos="zoom-in" data-aos-delay="100"></div>

    <div class="col-lg-5 d-flex flex-column justify-content-center">
        <h3>Enim quis est voluptatibus aliquid consequatur fugiat</h3>
        <p>Esse voluptas cumque vel exercitationem. Reiciendis est hic accusamus. Non ipsam et sed minima temporibus
            laudantium. Soluta voluptate sed facere corporis dolores excepturi</p>

        <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="100">
            <i class="bx bx-easel flex-shrink-0"></i>
            <div>
                <h4><a href="" class="stretched-link">Lorem Ipsum</a></h4>
                <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate
                    non provident</p>
            </div>
        </div><!-- End Icon Box -->

        <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="200">
            <i class="bx bx-patch-check flex-shrink-0"></i>
            <div>
                <h4><a href="" class="stretched-link">Nemo Enim</a></h4>
                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                    deleniti atque</p>
            </div>
        </div><!-- End Icon Box -->

        <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="300">
            <i class="bx bx-brightness-high flex-shrink-0"></i>
            <div>
                <h4><a href="" class="stretched-link">Dine Pad</a></h4>
                <p>Explicabo est voluptatum asperiores consequatur magnam. Et veritatis odit. Sunt aut deserunt minus
                    aut eligendi omnis</p>
            </div>
        </div><!-- End Icon Box -->

        <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="400">
            <i class="bx bx-brightness-high flex-shrink-0"></i>
            <div>
                <h4><a href="" class="stretched-link">Tride clov</a></h4>
                <p>Est voluptatem labore deleniti quis a delectus et. Saepe dolorem libero sit non aspernatur odit amet.
                    Et eligendi</p>
            </div>
        </div><!-- End Icon Box -->

    </div>
    </div>

    </div>
    </section><!-- End Alt Services Section --> --}}

    <!-- ======= Features Section ======= -->
    {{-- <section id="features" class="features section-bg">
        <div class="container" data-aos="fade-up">

          <ul class="nav nav-tabs row  g-2 d-flex">

            <li class="nav-item col-3">
              <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#tab-1">
                <h4>Modisit</h4>
              </a>
            </li><!-- End tab nav item -->

            <li class="nav-item col-3">
              <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-2">
                <h4>Praesenti</h4>
              </a><!-- End tab nav item -->

            <li class="nav-item col-3">
              <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-3">
                <h4>Explica</h4>
              </a>
            </li><!-- End tab nav item -->

            <li class="nav-item col-3">
              <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-4">
                <h4>Nostrum</h4>
              </a>
            </li><!-- End tab nav item -->

          </ul>

          <div class="tab-content">

            <div class="tab-pane active show" id="tab-1">
              <div class="row">
                <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
                  <h3>Voluptatem dignissimos provident</h3>
                  <p class="fst-italic">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                    magna aliqua.
                  </p>
                  <ul>
                    <li><i class="bx bx-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                    <li><i class="bx bx-check2-all"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                    <li><i class="bx bx-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
                  </ul>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 text-center" data-aos="fade-up" data-aos-delay="200">
                  <img src="{{ asset('assets/img/features-1.jpg') }}" alt="" class="img-fluid">
    </div>
    </div>
    </div><!-- End tab content item -->

    <div class="tab-pane" id="tab-2">
        <div class="row">
            <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                <h3>Neque exercitationem debitis</h3>
                <p class="fst-italic">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore
                    magna aliqua.
                </p>
                <ul>
                    <li><i class="bx bx-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                    <li><i class="bx bx-check2-all"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                    <li><i class="bx bx-check2-all"></i> Provident mollitia neque rerum asperiores dolores quos qui a.
                        Ipsum neque dolor voluptate nisi sed.</li>
                    <li><i class="bx bx-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis
                        aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat
                        nulla pariatur.</li>
                </ul>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="{{ asset('assets/img/features-2.jpg') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div><!-- End tab content item -->

    <div class="tab-pane" id="tab-3">
        <div class="row">
            <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                <h3>Voluptatibus commodi accusamu</h3>
                <ul>
                    <li><i class="bx bx-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                    <li><i class="bx bx-check2-all"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                    <li><i class="bx bx-check2-all"></i> Provident mollitia neque rerum asperiores dolores quos qui a.
                        Ipsum neque dolor voluptate nisi sed.</li>
                </ul>
                <p class="fst-italic">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore
                    magna aliqua.
                </p>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="{{ asset('assets/img/features-3.jpg') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div><!-- End tab content item -->

    <div class="tab-pane" id="tab-4">
        <div class="row">
            <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                <h3>Omnis fugiat ea explicabo sunt</h3>
                <p class="fst-italic">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore
                    magna aliqua.
                </p>
                <ul>
                    <li><i class="bx bx-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                    <li><i class="bx bx-check2-all"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                    <li><i class="bx bx-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis
                        aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat
                        nulla pariatur.</li>
                </ul>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="{{ asset('assets/img/features-4.jpg') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div><!-- End tab content item -->
    </div>
    </div>
    </section><!-- End Features Section --> --}}

    <!-- ======= Our Projects Section ======= -->


    <!-- ======= Testimonials Section ======= -->


    <!-- ======= Recent Blog Posts Section ======= -->
    {{-- <section id="recent-blog-posts" class="recent-blog-posts">
        <div class="container" data-aos="fade-up"">



            <div class=" section-header">
          <h2>Recent Blog Posts</h2>
          <p>In commodi voluptatem excepturi quaerat nihil error autem voluptate ut et officia consequuntu</p>
        </div>

        <div class="row gy-5">

          <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="post-item position-relative h-100">

              <div class="post-img position-relative overflow-hidden">
                <img src="{{ asset('assets/img/blog/blog-1.jpg') }}" class="img-fluid" alt="">
    <span class="post-date">December 12</span>
    </div>

    <div class="post-content d-flex flex-column">

        <h3 class="post-title">Eum ad dolor et. Autem aut fugiat debitis</h3>

        <div class="meta d-flex align-items-center">
            <div class="d-flex align-items-center">
                <i class="bx bx-person"></i> <span class="ps-2">Julia Parker</span>
            </div>
            <span class="px-3 text-black-50">/</span>
            <div class="d-flex align-items-center">
                <i class="bx bx-folder2"></i> <span class="ps-2">Politics</span>
            </div>
        </div>

        <hr>

        <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i
                class="bx bx-arrow-right"></i></a>

    </div>

    </div>
    </div><!-- End post item -->

    <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
        <div class="post-item position-relative h-100">

            <div class="post-img position-relative overflow-hidden">
                <img src="{{ asset('assets/img/blog/blog-2.jpg') }}" class="img-fluid" alt="">
                <span class="post-date">July 17</span>
            </div>

            <div class="post-content d-flex flex-column">

                <h3 class="post-title">Et repellendus molestiae qui est sed omnis</h3>

                <div class="meta d-flex align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="bx bx-person"></i> <span class="ps-2">Mario Douglas</span>
                    </div>
                    <span class="px-3 text-black-50">/</span>
                    <div class="d-flex align-items-center">
                        <i class="bx bx-folder2"></i> <span class="ps-2">Sports</span>
                    </div>
                </div>

                <hr>

                <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i
                        class="bx bx-arrow-right"></i></a>

            </div>

        </div>
    </div><!-- End post item -->

    <div class="col-xl-4 col-md-6">
        <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="300">

            <div class="post-img position-relative overflow-hidden">
                <img src="{{ asset('assets/img/blog/blog-3.jpg') }}" class="img-fluid" alt="">
                <span class="post-date">September 05</span>
            </div>

            <div class="post-content d-flex flex-column">

                <h3 class="post-title">Quia assumenda est et veritati tirana ploder</h3>

                <div class="meta d-flex align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="bx bx-person"></i> <span class="ps-2">Lisa Hunter</span>
                    </div>
                    <span class="px-3 text-black-50">/</span>
                    <div class="d-flex align-items-center">
                        <i class="bx bx-folder2"></i> <span class="ps-2">Economics</span>
                    </div>
                </div>

                <hr>

                <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i
                        class="bx bx-arrow-right"></i></a>

            </div>

        </div>
    </div><!-- End post item -->

    </div>

    </div>
    </section> --}}
    <!-- End Recent Blog Posts Section -->

</main><!-- End #main -->


<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></a>

<div id="preloader"></div>
@auth

<div class="modal fade" id="yorumModal" tabindex="-1" aria-labelledby="yorumModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('yorum.store') }}">
                @csrf

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="yorumModalLabel">Yorum Ekle</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="yorum" class="form-label">Yorumunuzu Girin:</label><br>

                    <div class="rating">
                        <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
                        <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
                        <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                        <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                        <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                    </div>

                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                    <textarea name="yorum" id="yorum" class="form-control" cols="30" rows="10"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yorum Ekle</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endauth
@endsection
