<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-3 text-gray-800"></h1>
	</div>

	<div class="row">
		<div class="col-lg-6">
		</div>
	</div>

	<!-- Content Row -->
	<div class="row">
		<div class="col">
			<div class="card mb-3 o-hidden border-0 shadow-lg" style="max-width: 800px;">
				<div class="row no-gutters">

					<div class="col-md-4">
						<img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img">
					</div>

					<div class="col-md-8">
						<div class="card-body">
							<h1 class="h3 mb-3 text-gray-800"><?= $title; ?></h1>
							<h5 class="card-title"><?= $user['name']; ?></h5>
							<div class="row">
								<div class="col-md-4">
									<p class="card-text">Email</p>
								</div>
								:
								<div class="col">
									<p class="card-text"><?= $user['email']; ?></p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<p class="card-text">Jabatan</p>
								</div>
								:
								<div class="col">
									<?php if ($user['role_id'] == 1) : ?>
										<p class="card-text">Admin</p>
									<?php else : ?>
										<p class="card-text">Member</p>
									<?php endif; ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<p class="card-text">Status Active</p>
								</div>
								:
								<div class="col">
									<p class="card-text"> <?php if ($user['is_active'] == 1) : ?>
											Active
										<?php else : ?>
											Non-Acive
										<?php endif; ?></p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<p class="card-text">Member Since</p>
								</div>
								:
								<div class="col">
									<p class="card-text"><?= date('d F Y', $user['date_created']); ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
