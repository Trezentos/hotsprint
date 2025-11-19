<?php

# ADD JS + CSS EXTRA
if( !IS_LIGHTHOUSE )
{
	add_style([
		'css/west-slide.css'
	]);

	add_javascript([
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
                'class'  => 'mt90 animation_bottom_dd2 smooth-scroll-link',
            ]);
        ?>

    </div>

</section>














<section class="section-final color-gray-light">
	<div class="wrap has-text-centered mt250 mt170-mobile">

		
		<div class="columns is-centered is-vcentered is-mobile is-multiline">
			<div class="column is-5-tablet fs-22 has-text-right waypoint animation_right is-hidden-mobile"> A CADA AMANHECER </div>

			<div class="column is-narrow-tablet is-12-mobile is-relative pl30 pr30">
				<img src="<?=IMG?>quax.webp" alt="logo <?=EMPRESA?>" class="logo is-relative waypoint animation_scale">

				<img src="<?=IMG?>galo.webp" alt="galo" class="galo waypoint animation_bottom_dd2">
			</div>

			<div class="column is-5-tablet is-12-mobile fs-22 has-text-left has-text-centered-mobile waypoint animation_left">

				<div class="is-hidden-tablet waypoint animation_right"> A CADA AMANHECER </div>

				UMA NOVA OPORTUNIDADE
			</div>
		</div>


		<p class="is-uppercase mt70 mt60-mobile waypoint animation_bottom">
			Na <span class="color-primary">QUAX</span>,<br class="is-hidden-mobile">
			cada projeto é desenvolvido de forma única.<br>
			<span class="color-primary">Não usamos modelos prontos</span>.<br>
			<br>

			O resultado é um site que transmite a <span class="color-primary">essência da sua construtora</span>, <br class="is-hidden-mobile">
			reforça seu posicionamento no mercado e potencializa suas vendas.<br>
			<br>

			nosso objetivo é transformar seu site em uma <br>
			<span class="color-primary">porta de entrada para novos negócios</span>.
		</p>


			
		<?php
			renderBtn([
				'href'   => '#contato',
				'text'   => 'QUERO UM SITE PARA A MINHA CONSTRUTORA',
				'class'  => 'mt100 mt70-mobile is-hover-white animation_bottom smooth-scroll-link',
			]);
		?>

	</div>
</section>










<section class="section-home-contato bg-secondary is-relative" id="contato">
	<div class="wrap">


		<div class="columns is-mobile is-multiline mt70 mt0-mobile">

			<div class="column is-6-tablet is-12-mobile is-relative">
				<h2 class="waypoint animation_left">
					<span class="has-text-weight-bold">RECEBA UMA</span><br>
					PROPOSTA PERSONALIZADA<br> 
					PARA SUA <span class="has-text-weight-bold">CONSTRUTORA</span>
				</h2>

				<p class="mt50 mt30-mobile waypoint animation_left_d1">PREENCHA O FORMULÁRIO E DESCUBRA COMO SEU 
				PRÓXIMO SITE PODE IMPULSIONAR SUAS VENDAS.</p>

				<?=getImg('web-sites-quax-footer.webp', 'web sites quax', 'img2 waypoint animation_left_dd1 is-hidden-mobile'); ?>
			</div>



			<div class="column is-1 is-hiddem-mobile"></div>



			<div class="column is-5-tablet is-12-mobile is-relative">

				<div class="box-contato mb80 mb180-mobile waypoint animation_left">
					<form id="form-contato" action="" method="post">

						<div class="columns is-mobile is-multiline">
							<div class="column is-12">
								<input type="text" name="nome" class="input" placeholder="NOME" required />
							</div>
							<div class="column is-12">
								<input type="text" name="empresa" class="input" placeholder="EMPRESA" required />
							</div>
							<div class="column is-12">
								<input type="email" name="email" class="input" placeholder="E-MAIL" required />
							</div>
							<div class="column is-12">
								<input type="text" name="telefone" class="input telefone" placeholder="WHATSAPP" required />
							</div>

							<div class="column is-12">
								<textarea name="mensagem" rows="3" placeholder="MENSAGEM"></textarea>
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


				<?=getImg('web-sites-quax-footer.webp', 'web sites quax', 'img2 waypoint animation_left_dd1 is-hidden-tablet'); ?>

			</div>


		</div>


	</div>
</section>






<?php get_footer(); ?>