<?php

# ADD JS + CSS EXTRA
if( !IS_LIGHTHOUSE )
{
	add_style([
		'css/west-slide.css',
        'css/swiper-bundle.min.css',
	]);

	add_javascript([
        'swiper-bundle.min.js',
        'jquery.westSlideVert.js',
		'page-home.js', 
		'jquery.maskedinput.js',
	]);
}


get_header();
?>



<section class="section-intro bg-secondary pt0 pb0 is-relative z-index-1">
	<div class="wrap is-relative">

		<div class="columns is-mobile is-multiline">
			<div class="column is-7-tablet is-12-mobile waypoint animation_left xhas-text-centered-mobile">

				<div class="columns is-vcentered is-mobile  mt85 mt0-mobile">
					<div class="column is-narrow waypoint animation_left">
						<img src="<?=IMG?>hotsprint-logo.webp" alt="logo <?=EMPRESA?>" class="logo ml10">
					</div>
				</div>


				<h1 class="txt-big mt105 mb35 mt30-mobile">
					<span class="has-text-weight-bold">HOTSITE RÁPIDO PARA</span><br>
					LANÇAMENTOS IMOBILIÁRIOS.
				</h1>

                <hr>

				<p class="mt35 mt30-mobile">
					<strong>A solução perfeita para construtoras que não podem esperar por um desenvolvimento exclusivo.</strong><br class="is-hidden-mobile">
                    Um hotsite pronto, flexível e pensado para gerar conversão desde o primeiro acesso.
				</p>


				<?php
					renderBtn([
						'href'   => '#contato',
						'text'   => 'QUERO UM HOTSITE PARA O MEU EMPREENDIMENTO',
						'class'  => 'mt55 mb130 mt40-mobile animation_bottom_dd2 smooth-scroll-link',
					]);
				?>

			</div>

			<div class="column is-5-tablet is-12-mobile pb0 pl10-mobile waypoint animation_right_dd1 is-relative is-flex is-align-items-flex-end">



			</div>
		</div>


	</div>

    <picture class="building-image">
        
        <img src="<?=IMG.'artefacto-ck-logotipo.webp'?>" class="logo-artefacto" alt="Logotipo Artefacto - Ck Construtora">
        
        <source srcset="<?=IMG?>quax-top.webp" media="(max-width: 578px)">
        <source srcset="<?=IMG?>quax-top.webp" media="(min-width: 579px)">
        <img src="<?=IMG?>quax-top.webp" alt="" class="img is-block ">
    </picture>

    <img src="<?=IMG.'sombra-direita.webp'?>" class="sombra-direita" alt="">
    <img src="<?=IMG.'sombra-esquerda.webp'?>" class="sombra-esquerda" alt="">

</section>

<section class="section-block-2">
	<div class="wrap">
        <div class="container-block-2">
            <div class="left">
                <img src="<?=IMG.'sectio-block-2-img.jpg'?>" class="background-img" alt="">
            </div>
            <div class="right pl65 pt10">

                <figure class="hotsprint-circular-logo">
                    <img src="<?=IMG?>hotsprint-circular-logo-simbol.png" alt="" class="img is-block ">
                    <img src="<?=IMG?>hotsprint-circular-logo-helice.png" alt="" class="img is-block ">
                </figure>

                <h2>
                    <strong>O impulso digital que</strong> <br>
                    SEU lançamento precisa.
                </h2>

                <hr>

                <p>
                    O <strong>HOTSPRINT</strong> é uma ferramenta de assinatura desenvolvida pela <strong>QUAX</strong>, que <br>
                    permite à sua construtora lançar rapidamente um <strong>hotsite de apresentação de</strong> <br>
                    <strong>empreendimento</strong>, usando uma estrutura visual limpa, moderna e <br>
                    totalmente otimizada para conversão. <br>
                </p>

                <div class="text-content">
                    <div class="check-items">
                        <div>
                            <img src="<?=IMG.'checkbox-img.jpg'?>" class="" alt="">
                            <p>Lançamentos na planta.</p>
                        </div>
                        <div>
                            <img src="<?=IMG.'checkbox-img.jpg'?>" class="" alt="">
                            <p>Empreendimentos em fase de pré-venda.</p>
                        </div>
                        <div>
                            <img src="<?=IMG.'checkbox-img.jpg'?>" class="" alt="">
                            <p>Projetos que precisam de presença digital imediata.</p>
                        </div>
                    </div>

                    <?php
                        renderBtn([
                            'href'   => '#contato',
                            'text'   => 'QUERO ATENDIMENTO NO WHATSAPP',
                            'class'  => 'mt45 mb110 mt40-mobile animation_bottom_dd2 smooth-scroll-link',
                        ]);
                    ?>

                </div>


            </div>
        </div>

	</div>
</section>

<?php
    $cards = [
        [
            'img'   => IMG.'nuvem.webp',
            'title' => 'Primeiro <br> dia',
            'text'  => 'Sua construtora envia <br> os conteúdos e imagens.'
        ],
        [
            'img'   => IMG.'pc-nuvem.webp',
            'title' => 'Segundo <br> dia',
            'text'  => 'Aplicamos tudo dentro <br>da ferramenta Hotsprint.'
        ],
        [
            'img'   => IMG.'nuvem-pessoa.webp',
            'title' => 'Terceiro <br> dia',
            'text'  => 'Você revisa e valida.'
        ],
        [
            'img'   => IMG.'foguete.webp',
            'title' => 'Quarto <br> dia',
            'text'  => 'O hotsite é publicado e <br> pronto para gerar conversão.'
        ],
    ];
?>
<section class="section-como-funciona is-relative ">
    <div class="wrap">
        <h2 class="mb0">
            <strong>COMO</strong><br>
            FUNCIONA.
        </h2>
        <hr>
        <p>Seu HOTSITE publicado em 4 passos simples.</p>

        <div class="cards-container mt70">
            <?php foreach ($cards as $card): ?>
                <div class="single-card">
                    <img src="<?= $card['img'] ?>" class="icon-card" alt="">
                    <strong class="mt25"><?= $card['title'] ?></strong>
                    <hr>
                    <p><?= $card['text'] ?></p>
                    
                    <img src="<?=IMG.'lente-card.webp'?>" class="overlay" alt="">
                </div>
            <?php endforeach; ?>
        </div>


        <?php
            renderBtn([
                'href'   => '#contato',
                'text'   => 'QUERO UM HOTSITE PARA O MEU EMPREENDIMENTO',
                'class'  => 'mt90 mb0 animation_bottom_dd2 smooth-scroll-link',
            ]);
        ?>
    </div>

</section>

<section class="section-carousel is-relative ">
    <div class="wrap">
        <h2 class="mb0">
            <strong>RESULTADOS REAIS COM</strong><br>
            O USO DO HOTSPRINT
        </h2>
        <hr>
        <p>Conheça alguns empreendimentos que assinaram a solução do <strong>HOTSPRINT</strong> para entrar com hotsite de alto desempenho.</p>


        <?php
            $qImoveis = [
                [ 'img' => 'https://picsum.photos/426/570?random=1', 'alt' => 'Imagem teste 1' ],
                [ 'img' => 'https://picsum.photos/426/570?random=2', 'alt' => 'Imagem teste 2' ],
                [ 'img' => 'https://picsum.photos/426/570?random=3', 'alt' => 'Imagem teste 3' ],
                [ 'img' => 'https://picsum.photos/426/570?random=4', 'alt' => 'Imagem teste 4' ],
                [ 'img' => 'https://picsum.photos/426/570?random=5', 'alt' => 'Imagem teste 5' ],
                [ 'img' => 'https://picsum.photos/426/570?random=1', 'alt' => 'Imagem teste 1' ],
                [ 'img' => 'https://picsum.photos/426/570?random=2', 'alt' => 'Imagem teste 2' ],
                [ 'img' => 'https://picsum.photos/426/570?random=3', 'alt' => 'Imagem teste 3' ],
                [ 'img' => 'https://picsum.photos/426/570?random=4', 'alt' => 'Imagem teste 4' ],
                [ 'img' => 'https://picsum.photos/426/570?random=5', 'alt' => 'Imagem teste 5' ],
            ];
        ?>

        <div class="swiper slide-imoveis swiper-imoveis mt50 mb90 mb0-tablet mb10-mobile">

            <div class="swiper-wrapper">
                <?php foreach ($qImoveis as $imovel): ?>
                    <div class="swiper-slide">
                        <img
                                src="<?= $imovel['img']; ?>"
                                alt="<?= $imovel['alt']; ?>"
                                width="426"
                                height="570"
                        >
                    </div>
                <?php endforeach; ?>
            </div>


            <div class="swiper-button-prev outer-prev">prev</div>
            <div class="swiper-button-next outer-next">next</div>
            <div class="swiper-scrollbar"></div>


        </div>


        <?php
        renderBtn([
            'href'   => '#contato',
            'text'   => 'QUERO UM HOTSITE PARA O MEU EMPREENDIMENTO',
            'class'  => 'mt90 mb0 animation_bottom_dd2 smooth-scroll-link',
        ]);
        ?>
    </div>

</section>




<section class="section-description">
    <div class="wrap">
        <div class="container-description">
            <div class="left">
                <h2 class="mb0">
                    <strong class="color-secondary">TUDO O QUE UM HOTSITE</strong><br>
                    DE LANÇAMENTO PRECISA.
                </h2>
                <hr>
                <p>
                    O <strong class="color-secondary">HOTSPRINT</strong> oferece uma estrutura visual padronizada e otimizada para
                    <br>
                    apresentar seu empreendimento com clareza, velocidade e alta conversão.
                </p>

                <p class="color-secondary mt35">
                    <strong>MÓDULOS INCLUÍDOS</strong>
                </p>

                <?php
                    $modulos = [
                        "Conceito / apresentação", "Sobre a região",
                        "Características do empreendimento", "Plantas e tipologias",
                        "Localização integrada (Google Maps)", "Vídeo do projeto",
                        "Formulário de interesse e Whatsapp", "Arquitetos e urbanistas",
                        "Galeria interna (apartamentos)", "Tour virtual 360º",
                        "Galeria externa (empreendimento)", "Estágio da obra"

                    ];
                ?>

                <div class="check-items mt35">
                    <?php foreach ($modulos as $modulo): ?>
                        <div>
                            <img src="<?= IMG.'checkbox-black-img.webp' ?>" alt="">
                            <p><?= $modulo ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>

                <p class="mt50">Você envia os materiais e informações e nós habilitamos o hotsite.</p>

                <?php
                    renderBtn([
                        'href'   => '#contato',
                        'text'   => 'SOLICITAR ASSINATURA',
                        'class'  => 'mt60 mb0 animation_bottom_dd2 smooth-scroll-link',
                    ]);
                ?>
            </div>
            <div class="right pl65 pt10">


            </div>
        </div>
    </div>

    <img src="<?=IMG.'hotsprint-sites-image.webp'?>" class="main-img" alt="">
</section>

<section class="section-home-contato is-relative" id="contato">
	<div class="wrap">


		<div class="columns is-mobile is-multiline mt0-mobile">

			<div class="column is-6-widescreen is-6-tablet is-12-mobile is-relative">
				<h2 class="waypoint animation_left is-uppercase">
                    Pronto para lançar <br>
                    <strong>seu empreendimento</strong> <br>
                    com mais rapidez <br>
                    e resultado? <br>
				</h2>

                <?php
                    renderBtn([
                        'href'   => '#contato',
                        'text'   => 'QUERO ATENDIMENTO NO WHATSAPP',
                        'class'  => 'mt60 mb0 animation_bottom_dd2 smooth-scroll-link',
                    ]);
                ?>

                <img src="<?=IMG.'hotsprint-logo-ligher.webp'?>" class="mt95 mb25" alt="">

                <p class="info-container">
                    <strong><a href="tel:4733496639">47 3349.6639</a></strong> <br>
                    Av. Sete de setembro, 1439 - sala 107 <br>
                    fazenda - itajaí - SC ( ver Mapa )
                </p>
			</div>

			<div class="column is-6-widescreen is-5-tablet is-12-mobile is-relative">

				<div class="box-contato mb80 mb180-mobile waypoint animation_left">
                    <h3 class="pl45 mb50">
                        <strong>PREENCHA</strong> <br>
                        O FORMULÁRIO
                    </h3>

					<form id="form-contato" action="" method="post">

						<div class="columns is-mobile is-multiline">
							<div class="column is-12">
								<input type="text" name="nome" class="input" placeholder="NOME:" required />
							</div>
							<div class="column is-12">
								<input type="text" name="empresa" class="input" placeholder="EMPRESA:" required />
							</div>
							<div class="column is-12">
								<input type="email" name="email" class="input" placeholder="E-MAIL:" required />
							</div>
							<div class="column is-12">
								<input type="text" name="telefone" class="input telefone" placeholder="WHATSAPP:" required />
							</div>

							<div class="column is-12 has-text-right">
								<!-- <small class="is-block">
									Ao enviar meus dados confirmo ciência sobre a <a href="politica-de-privacidade" class="color-primary">política de privacidade.</a>
								</small> -->
								<button class="btn button is-dark mt20 mt0-mobile mb0" type="submit" name="submit"><span>ENVIAR</span></button>
							</div>
						</div>

					</form>
				</div>

			</div>


		</div>


	</div>
</section>






<?php get_footer(); ?>