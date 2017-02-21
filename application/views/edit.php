<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Pagina em construção!
 * 
 * View para edição de manga
 */
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Edit</title>	
	<link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css') ?>" />
</head>
<body>
	<div id="container">
		<?= form_open('edit'); ?>
		<?= form_label('ID: '); ?>
		<?= form_dropdown('id', $mangas); ?>
		<?= form_label('Nome: '); ?>
		<?= form_input(array('id' => 'nome', 'name' => 'nome')); ?>
		<?= form_label('Ultimo cap: '); ?>
		<?= form_input(array('id' => 'ultimo', 'name' => 'ultimo')); ?>
		<?= form_label('Página: '); ?>
		<?= form_input(array('id' => 'pag', 'name' => 'pag')); ?>
		<?= form_label('Dia/Horário: '); ?>
		<?= form_input(array('id' => 'dia', 'name' => 'dia')); ?>
		<?= form_label('Keyword: '); ?>
		<?= form_input(array('id' => 'key', 'name' => 'key')); ?>
		<?= form_label('Image link:'); ?>
		<?= form_input(array('id' => 'img', 'name' => 'img')); ?>
		<?= form_submit(array('id' => 'submit', 'value' => 'Submit')); ?>
		<?= form_close(); ?>
	</div>
</body>
</html>
<?php
//$this->load->view(footer);
?>