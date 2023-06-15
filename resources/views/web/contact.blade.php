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

    {{-- TinyMCE --}}
    <script src="https://cdn.tiny.cloud/1/fi89j4qa7mvvws7816abfaxree4280z6nr8si3ade9h2h7r3/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
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
                <a href="{{ route('home') }}" class="nav-item nav-link">Home</a>
                <a href="{{ route('contact') }}" class="nav-item nav-link active">Contato</a>
            </div>
            <a href="{{ route('login') }}" class="btn btn-primary text-dark mb-1" style="font-family: Georgia;font-size:21px;">Login</a>
        </div>
        
    </nav>
    <!-- Navbar End -->


    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="section-title bg-white text-center px-3" style="color:#8FA8D9;">Contato</p>
                <h1 class="mb-5">Se tiver alguma dúvida...</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h3 class="mb-4">Envie-nos um email!</h3>
                    <p class="mb-4">É importante que você não se esqueça de colocar o email ou um telefone para que possamos retornar:
                    <form method="POST" action="{{ route('contact') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" name="Nome" placeholder="Seu Nome" required>
                                    <label for="name">Nome Completo</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Seu Email" required>
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subject" name="assunto" placeholder="Assunto" required>
                                    <label for="subject">Assunto</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea id="mensagem" name="mensagem"></textarea>
                                    <label for="mensagem">Mensagem</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary py-3 px-5" type="submit">Enviar Mensagem</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <h3 class="mb-4">Detalhes do Contato</h3>
                    <div class="d-flex border-bottom pb-3 mb-3">
                        <div class="flex-shrink-0 btn-square bg-primary rounded-circle">
                            <i class="fa fa-phone-alt text-body"></i>
                        </div>
                        <div class="ms-3">
                            <h6>Número Principal</h6>
                            <span>+55 11 99972-8065</span>
                        </div>
                    </div>
                    <div class="d-flex border-bottom-0 pb-3 mb-3">
                        <div class="flex-shrink-0 btn-square bg-primary rounded-circle">
                            <i class="fa fa-envelope text-body"></i>
                        </div>
                        <div class="ms-3">
                            <h6>Email</h6>
                            <span>central.sicc@gmail.com</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


 
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

    <script>
        tinymce.init({
            selector: 'textarea#mensagem',
            plugins: 'lists media searchreplace table visualblocks checklist mediaembed casechange advtable tableofcontents autocorrect typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link table mergetags | align lineheight | checklist numlist bullist indent outdent | removeformat',
            tinycomments_mode: 'embedded',
            language: 'pt_BR',
            statusbar: false,
        });
    </script>
</body>

</html>