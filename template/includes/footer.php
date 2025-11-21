<?php
$pg = $_SEO["permalink"];
?>

			<footer class="xis-relative bg-secondary pt40 pb40  pt60-mobile pb60-mobile">
				<div class="wrap has-text-left has-text-centered-mobile">

					<div class="assinatura">
                        <p>
                            <strong>Hotsprint</strong> todos os direitos reservados para <a href="https://quax.com.br" target="_blank">ESTúDIO <strong>QUAX</strong> - CNPj 133.14.895/0001-80</a>
                        </p>
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