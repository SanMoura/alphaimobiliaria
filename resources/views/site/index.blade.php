@extends('layouts.appSite')

@section('content')


		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<h1><a href="index.html">ALPHA IMOBILIÁRIA</a></h1>
						<nav class="links">
							<ul>
								<li><a href="#">INÍCIO</a></li>
								<li><a href="#">CONTATO</a></li>
								<li><a href="#">SOBRE</a></li>
							</ul>
						</nav>
						<nav class="main">
							<ul>
								<!-- <li class="search">
									<a class="fa-search" href="#search">Search</a>
									<form id="search" method="get" action="#">
										<input type="text" name="query" placeholder="Search" />
									</form>
								</li> -->
								<li class="menu">
									<a class="fa-bars" href="#menu">Menu</a>
								</li>
							</ul>
						</nav>
					</header>

				<!-- Menu -->
					<section id="menu">

						<!-- Search -->
							<!-- <section>
								<form class="search" method="get" action="#">
									<input type="text" name="query" placeholder="Search" />
								</form>
							</section> -->

						<!-- Links -->
							<section>
								<ul class="links">
									<li>
										<a href="#">
											<h3>Área do Profissional</h3>
											<p>Acesso ao sistema para registro dos clientes</p>
										</a>
									</li>
									<!-- <li>
										<a href="#">
											<h3>Dolor sit amet</h3>
											<p>Sed vitae justo condimentum</p>
										</a>
									</li>
									<li>
										<a href="#">
											<h3>Feugiat veroeros</h3>
											<p>Phasellus sed ultricies mi congue</p>
										</a>
									</li>
									<li>
										<a href="#">
											<h3>Etiam sed consequat</h3>
											<p>Porta lectus amet ultricies</p>
										</a>
									</li> -->
								</ul>
							</section>

						<!-- Actions -->
							<section>
								<ul class="actions stacked">
									<li><a href="http://imobiliariaalpha.com/login" target="_blank" class="button large fit">LOGIN NO SISTEMA</a></li>
								</ul>
							</section>

					</section>

				<!-- Main -->
					<div id="main">

                        <!-- Post -->
                        @forelse ($postagens as $postagem)
                        
                            
                        
                        <article class="post">
                            <header>
                                <div class="title">
                                    <h2><a href="#">{{ $postagem->titulo }}</a></h2>
                                    <p>{{ $postagem->sub_titulo }}</p>
                                </div>
                                <div class="meta">
                                    <time class="published" datetime="2015-11-01">{{ date('d/m/Y', strtotime($postagem->data))}}</time>
                                    <a href="#" class="author">
                                        <span class="name">{{ $postagem->usuarios->name }}</span>
                                        <img src="{{ asset('files/fotos') }}/{{ auth()->user()->foto ?? 'coringa.png' }}" alt="" /></a>
                                </div>
                            </header>
                                <a href="single.html" class="image featured"><img src="{{asset('files') . '/site/uploads/'.$postagem->imagem}}" alt="" /></a>
                            <p>
                                {{ $postagem->descricao }}
                            </p>
                            <footer>
                                
                            </footer>
                        </article>
                            
                        @empty

                        <article class="post">
                            <header>
                                <div class="title">
                                    <h2><a href="single.html">Ops!</a></h2>
                                    <p>Estamos preparando conteúdo para você!</p>
                                </div>
                                <div class="meta">
                                    <time class="published" datetime="2015-11-01">19 de Agosto de 2020</time>
                                    <a href="#" class="author"><span class="name">WANDERSON CARLOS</span><img src="{{asset('site')}}/images/vandson.jpeg" alt="" /></a>
                                </div>
                            </header>
                            
                        </article>
                            
                        @endforelse
					</div>

					<section id="sidebar">

							<section id="intro">
								<a href="#" class="logo"><img src="{{asset('site')}}/images/logo.png" alt="" /></a>
								
							</section>

							<section>
								<div class="mini-posts">

										<article class="mini-post">
											<header>
												<h3><a href="single.html">Wanderson Carlos</a></h3>
												<time class="published" datetime="2015-10-20">Fundador</time>
                                            <a href="#" class="author"><img src="{{asset('site')}}/images/vandson.jpeg" alt="" /></a>
											</header>
											
										</article>

										<article class="mini-post">
											<header>
												<h3><a href="single.html">Andson Souza</a></h3>
												<time class="published" datetime="2015-10-19">Fundador</time>
												<a href="#" class="author"><img src="{{asset('site')}}/images/andson.jpeg" alt="" /></a>
											</header>
											
										</article>

									
								</div>
							</section>

							<section>
								<ul class="posts">
									<li>
										<article>
											<header>
												<h3><a href="single.html">NOTICIA 1</a></h3>
												<time class="published" datetime="2015-10-20">19 de agosto de 2020</time>
											</header>
											<a href="single.html" class="image"><img src="{{asset('site')}}/images/pic08.jpg" alt="" /></a>
										</article>
									</li>
									<li>
										<article>
											<header>
												<h3><a href="single.html">NOTICIA 2</a></h3>
												<time class="published" datetime="2015-10-20">19 de agosto de 2020</time>
											</header>
											<a href="single.html" class="image"><img src="{{asset('site')}}/images/pic09.jpg" alt="" /></a>
										</article>
									</li>
									<li>
										<article>
											<header>
												<h3><a href="single.html">NOTICIA 3</a></h3>
												<time class="published" datetime="2015-10-20">19 de agosto de 2020</time>
											</header>
											<a href="single.html" class="image"><img src="{{asset('site')}}/images/pic10.jpg" alt="" /></a>
										</article>
									</li>
									<li>
										<article>
											<header>
												<h3><a href="single.html">NOTICIA 4</a></h3>
												<time class="published" datetime="2015-10-20">19 de agosto de 2020</time>
											</header>
											<a href="single.html" class="image"><img src="{{asset('site')}}/images/pic11.jpg" alt="" /></a>
										</article>
									</li>
									<li>
										<article>
											<header>
												<h3><a href="single.html">NOTICIA 5</a></h3>
												<time class="published" datetime="2015-10-20">19 de agosto de 2020</time>
											</header>
											<a href="single.html" class="image"><img src="{{asset('site')}}/images/pic12.jpg" alt="" /></a>
										</article>
									</li>
								</ul>
							</section>

						<!-- About -->
							<section class="blurb">
								<h2>Sobre</h2>
								<p>A ALPHA IMOBILIÁRIA, foi criada com o intuito de fornecer sonhos, a cada venda, os sorrisos dos nossos clientes é que fazem esse trabalho valer tanto a pena...</p>
								<ul class="actions">
									<li><a href="#" class="button">Leia Mais</a></li>
								</ul>
							</section>

						<!-- Footer -->
							<section id="footer">
								<ul class="icons">
									<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
									<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
									<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
									<li><a href="#" class="icon solid fa-rss"><span class="label">RSS</span></a></li>
									<li><a href="#" class="icon solid fa-envelope"><span class="label">Email</span></a></li>
								</ul>
								<p class="copyright">&copy; Marlus Santiago: <a href="http://facebook.com/marlussantiago">CONTATO</a></p>
							</section>

					</section>

            </div>
       
	
            {{-- @include('layouts.footers.auth') --}}

    @endsection

    @push('js')
@endpush
