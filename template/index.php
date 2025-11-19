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



<section class="section-intro bg-secondary pt30 pb0 is-relative z-index-1">
	<div class="wrap is-relative">

		<div class="columns is-mobile is-multiline">
			<div class="column is-7-tablet is-12-mobile waypoint animation_left xhas-text-centered-mobile">

				<div class="columns is-vcentered is-mobile mt50 mt0-mobile">
					<div class="column is-narrow waypoint animation_left">
						<img src="<?=IMG?>quax.webp" alt="logo <?=EMPRESA?>" class="logo">
					</div>
					<div class="column is-narrow waypoint animation_left">
						<p class="logo-txt"><span class="has-text-weight-light">ESTÚDIO</span> <span class="has-text-weight-medium">QUAX</span></p>
					</div>
				</div>


				<h1 class="txt-big mt50 mt30-mobile">
					<span class="has-text-weight-bold">WEBSITES</span><br>
					PERSONALIZADOS<br class="is-hidden-mobile">
					PARA <span class="has-text-weight-bold">CONSTRUTORAS</span>
				</h1>

				<p class="mt50 mt30-mobile">
					<strong>SERIEDADE</strong> E <strong>INOVAÇÃO</strong> QUE TRANSFORMAM<br class="is-hidden-mobile">
					PRESENÇA DIGITAL EM <strong>VALOR DE MERCADO.</strong>
				</p>


				<?php
					renderBtn([
						'href'   => '#contato',
						'text'   => 'QUERO UM SITE PARA MINHA CONSTRUTORA',
						'class'  => 'mt90 mb40 mt40-mobile animation_bottom_dd2 smooth-scroll-link',
					]);
				?>

			</div>

			<div class="column is-5-tablet is-12-mobile pb0 pl50 pl10-mobile waypoint animation_right_dd1 is-relative is-flex is-align-items-flex-end">
				<picture>
					<source srcset="<?=IMG?>quax-top.webp" media="(max-width: 578px)">
					<source srcset="<?=IMG?>quax-top.webp" media="(min-width: 579px)">
					<img src="<?=IMG?>quax-top.webp" alt="" class="img is-block js-parallax-h" data-offset="100"  data-direction="right">
				</picture>

				<picture>
					<source srcset="<?=IMG?>web-sites-quax.webp" media="(max-width: 578px)">
					<source srcset="<?=IMG?>web-sites-quax.webp" media="(min-width: 579px)">
					<img src="<?=IMG?>web-sites-quax.webp" alt="web sites quax" class="img2 waypoint animation_right_dd2 js-parallax-h" data-offset="200">
				</picture>

			</div>
		</div>


	</div>
</section>













<section class="section-block-2 bg-ll-gray">
	<div class="wrap">

 		<div class="columns is-mobile is-multiline mt100">
 			<div class="column is-narrow is-12-mobile is-relative">
				<h2 class="mb0 waypoint animation_left_dd1">
					VEJA AS CONSTRUTORAS QUE<br>
					JÁ <span class="has-text-weight-bold color-primary">CONFIARAM</span> NA <span class="has-text-weight-bold color-primary">QUAX.</span>
				</h2>
				<div class="line bg-primary waypoint animation_scale_x_d1"></div>
 			</div>
		</div>



		<div class="columns is-vcentered is-mobile is-multiline mt120 mt90-mobile logos has-text-centered-mobile">
			<div class="column is-2-tablet is-6-mobile"> <?=getImg('logos/01.webp', 'vokkan', 'waypoint animation_bottom'); ?> </div>
			<div class="column is-2-tablet is-6-mobile"> <?=getImg('logos/02.png',  'lotisa', 'waypoint animation_bottom'); ?> </div>
			<div class="column is-2-tablet is-6-mobile"> <?=getImg('logos/03.webp', 'clarus construtora', 'waypoint animation_bottom'); ?> </div>
			<div class="column is-2-tablet is-6-mobile"> <?=getImg('logos/04.png',  'racitec empreendimentos', 'waypoint animation_bottom'); ?> </div>
			<div class="column is-2-tablet is-6-mobile"> <?=getImg('logos/05.webp', 'raimundi construtora', 'waypoint animation_bottom'); ?> </div>
			<div class="column is-2-tablet is-6-mobile"> <?=getImg('logos/06.webp', 'alumbra empreendimentos', 'waypoint animation_bottom'); ?> </div>
			<div class="column is-2-tablet is-6-mobile"> <?=getImg('logos/07.webp', 'grupo n1 empreendimentos', 'waypoint animation_bottom'); ?> </div>
			<div class="column is-2-tablet is-6-mobile"> <?=getImg('logos/08.svg',  'gessele empreendimentos', 'waypoint animation_bottom'); ?> </div>
			<div class="column is-2-tablet is-6-mobile"> <?=getImg('logos/09.webp', 'inbrasul empreendimentos', 'waypoint animation_bottom'); ?> </div>
			<div class="column is-2-tablet is-6-mobile"> <?=getImg('logos/10.webp', 'sbj construtora', 'waypoint animation_bottom'); ?> </div>
			<div class="column is-2-tablet is-6-mobile"> <?=getImg('logos/11.webp', 'cn empreendimentos', 'cn ml20 ml0-mobile waypoint animation_bottom'); ?> </div>
			<div class="column is-2-tablet is-6-mobile"> <?=getImg('logos/12.webp', 'dall empreendimentos', 'dall ml10 ml0-mobile waypoint animation_bottom'); ?> </div>
		</div>


		<p class="mt60 mt40-mobile waypoint animation_bottom">
			<span class="has-text-weight-bold">CONSTRUTORAS LÍDERES</span> JÁ TRANSFORMARAM SUA PRESENÇA DIGITAL<br class="is-hidden-mobile">
			EM RESULTADOS REAIS.<br class="is-hidden-tablet">
			<span class="has-text-weight-bold color-primary">A PRÓXIMA CONSTRUTORA PODE SER A SUA.</span>
		</p>



		<?php
			renderBtn([
				'href'   => '#contato',
				'text'   => 'FALE AGORA COM NOSSO CONSULTOR',
				'class'  => 'mt70 mt50-mobile animation_bottom smooth-scroll-link',
			]);
		?>


	</div>
</section>














<section class="section-diferenciais is-relative">

	<div class="line tp bg-primary waypoint animation_scale_y"></div>
	<div class="line bt bg-primary waypoint animation_scale_y"></div>

	<div class="scroll-downs waypoint animation_scale is-hidden-mobile">
		<div class="mousey">
			<div class="scroller bg-primary"></div>
		</div>
	</div>

	<div class="wrap pb160 pb30-mobile">

		<div class="columns is-multiline is-mobile mt110 mt10-mobile">

			<div class="column is-6-tablet is-12-mobile pr120 pr10-mobile has-text-right has-text-left-mobile mt40">

				<h2 class="waypoint animation_left">
					POR QUE UM <span class="has-text-weight-bold color-primary">SITE DA QUAX</span><br>
					FAZ A DIFERENÇA PARA<br>
					<span class="has-text-weight-bold color-primary">SUA CONSTRUTORA</span>?
				</h2>


				<?php
					renderBtn([
						'href'   => LINK_WHATSAPP,
						'text'   => 'QUERO ATENDIMENTO NO WHATSAPP',
						'class'  => 'mt70 animation_bottom smooth-scroll-link is-hidden-mobile',
						'target' => '_blank'
					]);
				?>

			</div>


			<div class="column is-6-tablet is-12-mobile pl5 pl10-mobile mt5">


				<div class="<?=(!$MOBILE ? 'slide' : ''); ?> itens is-uppercase waypoint animation_bottom">

					<div class="item">
						<p class="t1 color-primary"> CÓDIGO 100% PERSONALIZADO </p>
						<p class="t2 fs-12">Sem uso de plataformas prontas ou limitadas.</p>
					</div>

					<div class="item">
						<p class="t1 color-primary"> LAYOUTS AUTORAIS </p>
						<p class="t2 fs-12">Valorizando os empreendimentos e refletindo sua identidade.</p>
					</div>

					<div class="item">
						<p class="t1 color-primary"> EXPERIÊNCIA DIGITAL PROJETADA PARA GERAR LEADS </p>
						<p class="t2 fs-12">E facilitar o contato com o cliente.</p>
					</div>

					<div class="item">
						<p class="t1 color-primary"> SUPORTE ESPECIALIZADO E PRÓXIMO </p>
						<p class="t2 fs-12">Acompanhando sua construtora durante todo o processo.</p>
					</div>

					<div class="item">
						<p class="t1 color-primary"> Integração com WhatsApp e formulários inteligentes </p>
						<p class="t2 fs-12">otimizando seu atendimento.</p>
					</div>

					<div class="item">
						<p class="t1 color-primary"> SEO projetado para melhor ranqueamento no Google </p>
						<p class="t2 fs-12">e atração de clientes qualificados.</p>
					</div>

					<div class="item"></div>
					<div class="item"></div>
				</div>

				
			</div>



			<?php
				renderBtn([
					'href'   => LINK_WHATSAPP,
					'text'   => 'QUERO ATENDIMENTO NO WHATSAPP',
					'class'  => 'mt20 animation_bottom smooth-scroll-link is-hidden-tablet',
					'target' => '_blank'
				]);
			?>

		</div>


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