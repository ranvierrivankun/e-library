<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="<?= base_url('/assets/template_login/'); ?>images/img-01.png" alt="IMG">
				</div>

				<?= form_open('', ['class' => 'user']); ?>

				<span class="login100-form-title">
					LOGIN E-LIBRARY DIPONEGORO 1
				</span>

				<?= $this->session->flashdata('pesan'); ?>

				<div class="wrap-input100 validate-input">
					<input class="input100" type="text" name="nis" placeholder="Masukan NIS">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-envelope" aria-hidden="true"></i>
					</span>
				</div>
				<?= form_error('nis', '<small class="valid text-danger pl-1">', '</small>'); ?>

				<div class="wrap-input100 validate-input" data-validate = "Password is required">
					<input class="input100" type="password" name="password" placeholder="Password">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-lock" aria-hidden="true"></i>
					</span>
				</div>
				<?= form_error('password', '<small class="valid text-danger pl-1">', '</small>'); ?>

				<button class="login100-form-btn" type="submit">Login</button>

				<div class="text-center p-t-136">
					<a class="txt2" href="#" onclick="daftar_akun()">
						Daftar Akun E-Library Diponegoro 1
						<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
					</a>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	function daftar_akun(){
		Swal.fire({
			icon: 'info',
			confirmButtonColor: '#696cff',
			title: `Daftar Akun E-Library`,
			text: 'Silahkan Datang Ke Perpustakan Diponegoro 1 untuk Mendaftarkan Akun.',
		})
	}
</script>
