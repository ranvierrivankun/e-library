<!--===============================================================================================-->	
<script src="<?= base_url('/assets/template_login/'); ?>vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="<?= base_url('/assets/template_login/'); ?>vendor/bootstrap/js/popper.js"></script>
<script src="<?= base_url('/assets/template_login/'); ?>vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="<?= base_url('/assets/template_login/'); ?>vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="<?= base_url('/assets/template_login/'); ?>vendor/tilt/tilt.jquery.min.js"></script>
<script >
	$('.js-tilt').tilt({
		scale: 1.1
	})
</script>
<!--===============================================================================================-->
<script src="<?= base_url('/assets/template_login/'); ?>js/main.js"></script>

</body>
</html>

<!-- REMOVE ALERT -->
<script>
	window.setTimeout(function() {
		$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
		});
	}, 2000);
</script>