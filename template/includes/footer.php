<?php
$pg = $_SEO["permalink"];
?>

			<footer class="xis-relative bg-primary pt40 pb40  pt60-mobile pb60-mobile">
				<div class="wrap has-text-right has-text-centered-mobile">

					<div class="assinatura waypoint animation_right">
						<a href="https://quax.com.br" target="_blank">ESTÚDIO <span class="has-text-weight-medium">QUAX</span>
						<br class="is-hidden-tablet">
						<span class="is-hidden-mobile">-</span> CNPJ 133.14.895/0001-80</a> 
					</div>

				</div>
			</footer>


			


			</div> <!-- /CLOSE SCROLL-CONTENT -->
	    </main> <!-- /MAIN -->



		<div class="bt-whatsbox">
			<a href="<?=LINK_WHATSAPP?>" target="_blank"><i class="fa fa-whatsapp color-white"></i></a>
			<!-- <a href="#contato" class="smooth-scroll-link"><i class="fa fa-whatsapp color-white"></i></a> -->
		</div>



		<?php //include TEMPLATE."sections/cookies.php"; ?>



		<?php echo javascript_enqueue('home','return'); ?>



		<!-- INSERT CODE BODY -->
		<?php if( !IS_LIGHTHOUSE ) echo $qConfig->incorporar_body; ?>

	</body>
</html>