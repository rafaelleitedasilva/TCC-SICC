<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>TecnoWave</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Chamado, Compra, Manutenção" name="keywords">
    <meta content="Sistema Interno de Chamado de Compras" name="description">
    <meta content="Rafael Leite da Silva" name="author">

    <!-- Favicon -->
    <link href="{{ asset('img/img-website/favicon/1-c.png') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">   

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/css-website/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/css-website/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-blue-light px-0">
        <div class="row g-0 d-none d-lg-flex">
            <div class="col-lg-6 ps-5 text-start">
            </div>
            <div class="col-lg-6 text-end">
                <div class="h-100 bg-white d-inline-flex align-items-center text-dark py-2 px-4">
                    <span class="me-2 fw-semi-bold"><i class="fa fa-phone-alt me-2"></i>Contate-nos:</span>
                    <a href="tel:+5511999999999" style="color:#8FA8D9;">+55 11 99972-8065</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5">
        <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center">
            <h1 class="m-0">Tecnowave</h1>
        </a>
        <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ route('home') }}" class="nav-item nav-link active">Home</a>
                <a href="{{ route('contato') }}" class="nav-item nav-link">Contato</a>
            </div>
            <a href="{{ route('login') }}" class="btn btn-primary text-dark mb-1" style="font-family: Georgia;font-size:21px;">Login</a>
        </div>
        
    </nav>
    <!-- Navbar End -->


    <!-- Carousel Start -->
    <div class="container-fluid px-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" style="height: 815px; object-fit:cover;" src="{{ asset('img/img-website/carrossel.jpeg') }}" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 text-center">
                                    <p class="fs-4 text-white">07/junho</p>
                                    <h1 class="display-1 text-white animated slideInRight">SICC 2.0 </h1>
                                    <p class="fs-4 text-white">Descubra o que a nova versão trouxe de melhorias</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" style="height: 815px; object-fit:cover;" src="{{ asset('img/img-website/carrossel2.jpeg') }}" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 text-center">
                                    <p class="fs-4 text-white">14/junho</p>
                                    <h1 class="display-1 text-white animated slideInRight">Últimas Atualizações</h1>
                                    <p class="fs-4 text-white">Segurança, relatórios e mais!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <div class="row g-2">
                        <div class="col-6 fadeIn" data-wow-delay="0.7s">
                            <div class="bg-primary rounded h-100 d-flex justify-content-center flex-wrap align-items-center">
                                <h1 class="display-1 mb-0" style="color: #171b41;">24h</h1>
                                <small class="fs-5 fw-bold">de Suporte</small>
                            </div>
                        </div>
                        <div class="col-6 wow fadeIn" data-wow-delay="0.1s">
                            <img class="img-fluid rounded" src="{{ asset('img/img-website/service-1.jpg') }}">
                        </div>
                        <div class="col-6 wow fadeIn" data-wow-delay="0.3s">
                            <img class="img-fluid rounded" src="{{ asset('img/img-website/service-2.jpg') }}">
                        </div>
                        <div class="col-6 wow fadeIn" data-wow-delay="0.5s">
                            <img class="img-fluid rounded" src="{{ asset('img/img-website/service-3.jpg') }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <p class="section-title bg-white text-start pe-3" style="color:#8FA8D9;">Sobre</p>
                    <h1 class="mb-4">Faça parte da revolução</h1>
                    <p class="mb-4">O SICC (Sistema Interno de Chamado e Compras) vem para resolver um problema recorrente na indústria, mas de uma maneira totalmente inovadora, o nosso sitema vem acompanhado de um BI adaptado para uma melhor análise das requisições e um sistema de notificação e QR Code que agilizarão a abertura e atendimento dos chamados.</p>
                    <p class="mb-4">Investir em um sistema interno de chamado e compras pode levar a grandes melhorias em seu negócio. Com nossa solução, você terá uma visão completa e atualizada de todo o processo, permitindo que você tome decisões mais informadas e, consequentemente, melhore a eficiência da sua empresa.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Features Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="section-title bg-white text-start text-primary pe-3">Por que nosso sistema?</p>
                    <h1 class="mb-4">Algumas razões para nos escolher!</h1>
                    <p class="mb-4">Nosso sistema conta com uma integração entre os setores de compra e manutenção, além desse fator temos outras funcionalidades que enriquecem ainda mais o uso do nosso site, como:</p>
                    <p><i class="fa fa-check text-primary me-3"></i>Relatórios e Gráficos BI</p>
                    <p><i class="fa fa-check text-primary me-3"></i>Notificações por Email</p>
                    <p><i class="fa fa-check text-primary me-3"></i>Interface Simplificada</p>
                    <a class="btn btn-primary py-3 px-5 mt-3" href="">Saiba Mais</a>
                </div>
                <div class="col-lg-6">
                    <div class="rounded overflow-hidden">
                        <div class="row g-0">

                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                                <div class="text-center bg-blue-light py-5 px-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="color:white;" width="25" height="25" fill="currentColor" class="bi bi-bar-chart mb-1" viewBox="0 0 16 16">
                                        <path d="M4 11H2v3h2v-3zm5-4H7v7h2V7zm5-5v12h-2V2h2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3z"/>
                                    </svg>
                                    <span class="fs-5 fw-semi-bold text-white">4</span>
                                    <h1 class="display-6 text-white" data-toggle="counter-up">Gráficos</h1>
                                </div>
                            </div>

                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.3s">
                                <div class="text-center bg-dark-own py-5 px-4 h-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="color:black;" width="25" height="25" fill="currentColor" class="bi bi-people mb-1" viewBox="0 0 16 16">
                                        <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"/>
                                      </svg>
                                    <span class="fs-5 fw-semi-bold text-dark">Usuários</span>
                                    <h1 class="display-6" data-toggle="counter-up">Ilimitados</h1>
                                </div>
                            </div>

                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.5s">
                                <div class="text-center bg-dark-own py-5 px-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="color:black;" width="25" height="25" fill="currentColor" class="bi bi-bell-fill mb-1" viewBox="0 0 16 16">
                                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
                                    </svg>
                                    <span class="fs-5 fw-semi-bold text-dark">Notificações</span>
                                    <h1 class="display-6" data-toggle="counter-up">24/7</h1>
                                </div>
                            </div>

                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.7s">
                                <div class="text-center bg-blue-light py-5 px-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="color:white;" width="25" height="25" fill="currentColor" class="bi bi-qr-code MB-1" viewBox="0 0 16 16">
                                        <path d="M2 2h2v2H2V2Z"/>
                                        <path d="M6 0v6H0V0h6ZM5 1H1v4h4V1ZM4 12H2v2h2v-2Z"/>
                                        <path d="M6 10v6H0v-6h6Zm-5 1v4h4v-4H1Zm11-9h2v2h-2V2Z"/>
                                        <path d="M10 0v6h6V0h-6Zm5 1v4h-4V1h4ZM8 1V0h1v2H8v2H7V1h1Zm0 5V4h1v2H8ZM6 8V7h1V6h1v2h1V7h5v1h-4v1H7V8H6Zm0 0v1H2V8H1v1H0V7h3v1h3Zm10 1h-1V7h1v2Zm-1 0h-1v2h2v-1h-1V9Zm-4 0h2v1h-1v1h-1V9Zm2 3v-1h-1v1h-1v1H9v1h3v-2h1Zm0 0h3v1h-2v1h-1v-2Zm-4-1v1h1v-2H7v1h2Z"/>
                                        <path d="M7 12h1v3h4v1H7v-4Zm9 2v2h-3v-1h2v-1h1Z"/>
                                      </svg>
                                    <span class="fs-5 fw-semi-bold text-white">Objetos com</span>
                                    <h1 class="display-6 text-white" data-toggle="counter-up">QR Code</h1>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->


    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="section-title bg-white text-center text-dark px-3">Família Tecnowave</p>
                <h1 class="mb-5">Nossa Equipe</h1>
            </div>
            <div class="d-flex flex-wrap justify-content-center">
                <div class=" wow fadeInUp m-1 w-25" style="min-width:250px;heigth:250px;" data-wow-delay="0.1s">
                    <div class="team-item rounded p-4">
                        <h5>Beatriz Holanda da Silva</h5>
                        <p style="color:#8FA8D9;">Líder</p>
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="w-25 wow fadeInUp m-1" style="min-width:250px;heigth:250px;" data-wow-delay="0.3s">
                    <div class="team-item rounded p-4">
                        <h5>Emanuel Victor da Rocha</h5>
                        <p style="color:#8FA8D9;">Documentação</p>
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="w-25 wow fadeInUp m-1" style="min-width:250px;heigth:250px;" data-wow-delay="0.5s">
                    <div class="team-item rounded p-4">
                        <h5>Rafael Leite da Silva</h5>
                        <p style="color:#8FA8D9;">Programador</p>
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-square btn-primary rounded-circle mx-1" target="_blank" href="https://br.linkedin.com/in/rafael-leite-da-silva-10654a222?trk=people-guest_people_search-card"><i class="fab fa-linkedin"></i></a>
                            <a class="btn btn-square btn-primary rounded-circle mx-1" target="_blank" href="https://github.com/rafaelleitedasilva"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>
                <div class="w-25 wow fadeInUp m-1" style="min-width:250px;heigth:250px;" data-wow-delay="0.5s">
                    <div class="team-item rounded p-4">
                        <h5>Sara Jesus de Sousa</h5>
                        <p style="color:#8FA8D9;">Documentação</p>
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->




    <!-- Footer Start -->
    <hr>

    <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="d-flex align-items-center justify-content-center flex-wrap footer-own">
                
                    <div class="col-lg-3 col-md-6 mr-5">
                        <img src="{{ asset('img/img-website/favicon/1.jpeg') }}" style="width:300px;" alt="">
                    </div>
                    <div class="col-lg-3 col-md-6 ml-5">
                        <h5 class="text-dark mb-4">Newsletter</h5>
                        <p>Receba as notícias sobre as atualizações do nosso software!</p>
                        <div class="position-relative w-100">
                            <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Seu email">
                            <button type="button" class="btn btn-primary py-2 position-absolute text-dark top-0 end-0 mt-2 me-2">Enviar</button>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <hr>

    <!-- Copyright Start -->
    <div class="container-fluid text-dark text-body copyright py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="fw-semi-bold" href="#" style="color:#8FA8D9;">Tecnowave</a>, Todos os direitos reservados.
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top text-dark"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('lib/parallax/parallax.min.js') }}"></script>
</body>

</html>
