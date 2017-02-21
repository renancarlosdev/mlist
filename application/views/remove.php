<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Pagina em construção!
 * 
 * View para remoção de manga
 */

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Remove</title>	
	<link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css') ?>" />
</head>
<body>
	<div id="container">
		<?= form_open('remove'); ?>
		<?= form_label('ID: '); ?>
		<?= form_dropdown('id', $mangas); ?>
		<?= form_submit(array('id' => 'submit', 'value' => 'Submit')); ?>
		<?= form_close(); ?>
	</div>
</body>
</html>
<?php
//$this->load->view(footer);
?>