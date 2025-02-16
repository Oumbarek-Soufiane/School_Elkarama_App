@extends('layout.footer')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <title>AIM</title>
</head>

<body>
    <!-- Navigation Bar -->
    <div class="Landing_Up">
        <div class="container-fluid">
            @include('layout.navbar');
            <div class="text" style="padding-bottom: 20px;">
                <p>Manage Your<br>
                    Establishement Easily<br>
                    With AIM</p>
                <p class="small">AIM is a school Management Solution That Offers<br>
                    A Personnalized Portal To Each Type Of User</p>
                <a href="{{ route('register') }}">
                <button class="button2" type="submit">Register Now !</button>
                </a>
                <div>
                    <svg class="fleche" width="148" height="75" viewBox="0 0 148 75" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M137.19 2.52131C137.194 2.54185 137.197 2.56254 137.199 2.58413C137.239 2.9192 137.081 3.23985 136.927 3.53747C133.078 10.9996 128.367 19.5962 123.337 26.2891C108.12 46.5383 83.5234 59.8623 58.4169 61.6408C49.6511 62.2614 40.7487 61.3645 32.2717 58.9193C28.1498 57.7306 23.9424 55.9204 20.0425 53.8637C16.232 51.8535 12.064 49.1919 8.14722 46.9394C8.0541 46.8862 7.94159 46.9841 7.95083 47.0921C8.06131 48.3533 7.68478 54.0527 7.61465 54.4798C7.30039 56.399 5.67445 56.5403 5.50194 54.3909C5.29908 51.8623 5.37154 49.7664 5.41525 47.265C5.42951 46.4253 5.27923 44.6426 5.75364 43.958C6.31549 43.1475 7.38996 43.0735 8.3379 42.8277C10.4727 42.2724 12.8617 41.514 15.0688 41.2468C17.1033 41.0008 19.4408 42.5185 16.1874 43.3327C14.0587 43.8652 11.679 44.4541 9.50565 44.8682C9.42631 44.8829 9.4087 44.9886 9.4793 45.0285C11.0436 45.9141 13.7193 47.6694 15.0186 48.5794C35.4991 62.9261 66.9389 61.8143 89.1409 51.0841C93.4873 48.9838 97.6745 46.5461 101.65 43.7952C116.149 33.7617 127.389 17.3716 134.24 3.77944C134.575 3.11553 134.813 2.33953 135.443 1.95656C136.054 1.58447 137.052 1.82603 137.19 2.52131Z"
                            fill="#F2C94C" />
                    </svg>
                </div>
            </div>
        </div>
    </div>






    <!-- Body Bar -->
    <div id="carouselExampleCaptions" class="carousel slide w-100 reveals ">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner w-100">
            <div class="carousel-item active">
                <img src="{{ asset('img/mouse3.jpg') }}"  height="500px" class="d-block w-100 " alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/screen1.jpg') }}"  height="500px" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/screen2.jpg') }}"  height="500px" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>




    <div style="text-align: center;" id="Annoncements">
            <h1>Annoncements</h1>
    </div>


    <br>

    <!-- Swiper -->
    <div class="swiper mySwiper ">
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-wrapper">

            <div class="swiper-slide reveals">
                <img class="mb-3" src="{{ asset('img/screen1.jpg') }}" width="300px" alt="">
                <p class="date_epingler">Nov 15,2023</P>
                <div class="info_epingler">
                    <p class="text-epingler">Les Emplois Du temps<br> Provisioire Sont Disponible</p>
                    <button class="button1">See More</button>
                </div>
            </div>
            <div class="swiper-slide reveals">
                <img class="mb-3" src="{{ asset('img/screen1.jpg') }}" width="300px" alt="">
                <p class="date_epingler">Nov 15,2023</P>
                <div class="info_epingler">
                    <p class="text-epingler">Les Emplois Du temps<br> Provisioire Sont Disponible</p>
                    <button class="button1">See More</button>
                </div>
            </div>

            <div class="swiper-slide reveals">
                <img class="mb-3" src="{{ asset('img/screen1.jpg') }}" width="300px" alt="">
                <p class="date_epingler">Nov 15,2023</P>
                <div class="info_epingler">
                    <p class="text-epingler">Les Emplois Du temps<br> Provisioire Sont Disponible</p>
                    <button class="button1">See More</button>
                </div>
            </div>

            <div class="swiper-slide reveals">
                <img class="mb-3" src="{{ asset('img/screen1.jpg') }}" width="300px" alt="">
                <p class="date_epingler">Nov 15,2023</P>
                <div class="info_epingler">
                    <p class="text-epingler">Les Emplois Du temps<br> Provisioire Sont Disponible</p>
                    <button class="button1">See More</button>
                </div>
            </div>

            <div class="swiper-slide reveals">
                <img class="mb-3" src="{{ asset('img/screen1.jpg') }}" width="300px" alt="">
                <p class="date_epingler">Nov 15,2023</P>
                <div class="info_epingler">
                    <p class="text-epingler">Les Emplois Du temps<br> Provisioire Sont Disponible</p>
                    <button class="button1">See More</button>
                </div>
            </div>

            <div class="swiper-slide reveals">
                <img class="mb-3" src="{{ asset('img/screen1.jpg') }}" width="300px" alt="">
                <p class="date_epingler">Nov 15,2023</P>
                <div class="info_epingler">
                    <p class="text-epingler">Les Emplois Du temps<br> Provisioire Sont Disponible</p>
                    <button class="button1">See More</button>
                </div>
            </div>

            <div class="swiper-slide reveals">
                <img class="mb-3" src="{{ asset('img/screen1.jpg') }}" width="300px" alt="">
                <p class="date_epingler">Nov 15,2023</P>
                <div class="info_epingler">
                    <p class="text-epingler">Les Emplois Du temps<br> Provisioire Sont Disponible</p>
                    <button class="button1">See More</button>
                </div>
            </div>

            <div class="swiper-slide reveals">
                <img class="mb-3" src="{{ asset('img/screen1.jpg') }}" width="300px" alt="">
                <p class="date_epingler">Nov 15,2023</P>
                <div class="info_epingler">
                    <p class="text-epingler">Les Emplois Du temps<br> Provisioire Sont Disponible</p>
                    <button class="button1">See More</button>
                </div>
            </div>
        </div>
        <div class="swiper-pagination" ></div>
    </div>
    <center>
        <hr width="600px" />
    </center>
<div id="about_us"></div>
    <div class="about_us reveals" id="about_us">
        <h1 class="text-white" >About Us:</h1><br>
        <p> Our application, AIM (Academic Institution Management),
            is a comprehensive solution<br> designed to help academic institutions effectively manage their day-to-day
            operations.<br> By integrating various modules such as absence management, student and professor,<br> and
            score consultation, we provide a one-stop solution for institutional management.
        </p>

        <p>Through AIM, you can enhance communication among students, professors, and parents,<br> fostering a positive
            and supportivelearning environment. By streamlining<br> administration processes and minimizing manual
            tasks, we enableacademic institutions<br> to save time and resources.
        </p>

        <p>AIM offers a personalized approach to academic institution management, catering to the specific<br> needs of
            each institution. By providing user-friendly technology, we aim to make institutional<br> management as
            accessible and efficient as possible.

        </p>
    </div>

    @yield('footer')

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>

<script src="{{ asset('js/annoncements_swiper.js') }}"></script>
<script src="{{ asset('js/displayOnScroll.js') }}"></script>


</body>

</html>
