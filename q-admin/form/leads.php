<?php 
require __DIR__ . '/../config.php';
require GESTOR_MODELS . SELF_PAG;


# HEADERS
$_header['titulo'] = ($id?'Visualizar':'Novo').' Lead - WhatsApp';



get_header_gestor();
get_barra_header();
?>

<form name="form" id="form" action="" method="post" enctype="multipart/form-data" role="form">
	<div id="buttons">
		<div class="pull-left">
			<?php
			//btn_save();
			if ($q) btn_delete_form($id);
			?>
		</div>
		<div class="pull-right">
			<?php
			//btn_add();
			btn_back();
			?>
		</div>
	</div>


	<ul id="tab-nav" class="nav nav-tabs">
		<?php get_tab_item('1', 'Geral'); ?>
	</ul>


	<div class="tab-content">
		<div id="tab1" class="tab-pane <?=($_GET['tab']==''?'active':'');?> animation_bottom animated">

			<fieldset>

				<h4>
                    Criado em <?php echo data($q->criado, "d/m/Y - H:i") ?></textarea>
                </h4>


				<div class="row mt40">
					<div class="form-group col-md-4">
						<?php get_input_text('titulo', 'Nome', $q->titulo, 'required', '', '', true); ?>
					</div>

					<div class="form-group col-md-4">
						<?php get_input_text('empresa', 'Empresa', $q->empresa, 'required', '', '', true); ?>
					</div>

					<div class="form-group col-md-3">
						<?php get_input_text('email', 'E-mail', $q->email, 'required', '', '', true); ?>
					</div>

					<div class="form-group col-md-2">
                        <?php get_input_text('telefone', 'Telefone', $q->telefone, 'required', '', '', true); ?>
					</div>

					<div class="form-group col-md-12">
                        <?php get_input_textarea('mensagem', 'Mensagem', $q->mensagem); ?>
					</div>
				</div>

				<hr>

				

				<input type="hidden" name="id" 	   value="<?php echo ($id ? $id : false); ?>" />
				<input type="hidden" name="action" value="<?php echo ($id ? 'alterar' : 'adicionar'); ?>" />
			</fieldset>
		</div>
	</div>
</form>

<?php get_footer_gestor(); ?>