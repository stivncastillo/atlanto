<?php 
	$ci = &get_instance();
	$ci->load->model('config_model');
	$config = $this->config_model->get(array('id' => 1));
?>
	</section>
	<hr />

	<footer id="pie">
		<?php echo $config->texto_pie_pagina; ?>
	</footer>

	<script src="<?php echo base_url(); ?>assets/js/jquery-2.0.0.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

	<script src="<?php echo base_url(); ?>assets/js/jqbootstrapvalidation.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.form.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-switch.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/datatable-bootstrap.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-tab-ajax.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/wysihtml5-0.3.0.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-wysihtml5.js"></script>

	<script src="<?php echo base_url(); ?>assets/js/main.js"></script>

</body>
</html>