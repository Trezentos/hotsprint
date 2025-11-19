<?php
require __DIR__ . '/../config.php';
require GESTOR_MODELS . SELF_PAG;
require PHP . 'classes/Class.paginacao-admin.php';


// add_javascript(["script.order.js"]);

get_header_gestor();
get_barra_header();
?>

<div class="alert alert-success"></div>

<div id="buttons">
	<div class="text-right">
		<?php include GESTOR_INCLUDES . 'items-per-page.php'; ?>
		<?php count_results($count); ?>
		<?php //btn_add(); ?>
	</div>
</div>

<?php
if ($count>0)
{
	# PAGINATION
	$navbar = new Paginator;
	$navbar->items_total = $count;
	$navbar->mid_range = 9;
	$navbar->items_per_page = $items_page;
	$navbar->paginate();

	$query = $db->get_results("SELECT * FROM {$tables[$__TABLE__]} {$WHERE_LIST} ORDER BY criado DESC $navbar->limit");
?>



<div class="table-responsive">
	<table class="table table-striped table-hover" data-table="<?=$__TABLE__?>">
		<thead>
			<tr>
				<th data-sorter="false"></th>
				<th>Nome</th>
				<th>Empresa</th>
				<th>E-mail</th>
				<th>Telefone</th>
				<th>Criado em</th>
				<th class="actions text-center" data-sorter="false">Ações</th>
				<!-- <th class="order text-center" data-sorter="false">Ordenar</th> -->
			</tr>
		</thead>
		<tbody>
		<?php foreach($query as $rs) { ?>
			<tr id="<?php echo $rs->id; ?>" class="ui-state-default">
				<td></td>
				<td class="locked"><?php echo $rs->titulo; ?></td>
				<td class="locked"><?php echo $rs->empresa; ?></td>
				<td class="locked"><?php echo $rs->email; ?></td>
				<td class="locked"><?php echo $rs->telefone; ?></td>
				<td class="locked"><?php echo data($rs->criado, "d/m/Y - H:i"); ?></td>
				<td class="locked text-center">
					<?php btn_edit($rs->id); ?>
					<?php btn_delete($rs->id); ?>
				</td>
				<?php //btn_sort(); ?>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>

<?php
	echo ($query != '' && $navbar->num_pages>1 ) ? $navbar->display_pages() : '';
} else {
?>

	<div class="alert alert-warning show">
		<strong>Nenhum registro existente</strong>
	</div>

<?php 
	} 
get_footer_gestor();