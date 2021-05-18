<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"></h1>
	</div>

	<!-- Search -->
	<form class="d-none d-sm-inline-block form-inline navbar-search" action="" method="post">
		<div class="input-group">
			<input type="text" class="form-control" placeholder="Search by No. DPT" name="cari">
			<div class="input-group-append">
				<button class="btn btn-danger" type="submit" id="button-addon2"><i class="fas fa-search fa-sm"></i></button>
			</div>
		</div>
	</form>


	<div class="row mt-3">
	</div>
	<div class="row">
		<div class="col">
			<div class="card o-hidden border-0 shadow-lg">
				<div class="card-body">
					<h1 class="h3 mb-0 text-gray-800 mb-3"><?= $title; ?></h1>
					<a href="<?= base_url('data/datang'); ?>" class="btn btn-danger mb-3 shadow-sm float-right">Pengunjung</a>

					<?php if (empty($data)) : ?>
						<div class="alert alert-danger mt-3" role="alert">
							Data Not Found!
						</div>
				</div>
			<?php else : ?>

				<table class="table table-hover table-sm">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">No DPT</th>
							<th scope="col">Nama</th>
							<th scope="col">NIK</th>
							<th scope="col">Jenis Kelamin</th>
							<th scope="col">Kehadiran</th>
							<th scope="col">Action</th>
						<?php endif; ?>
						</tr>
					</thead>
					<tbody>

						<?php $i = 1; ?>
						<?php foreach ($data as $u) : ?>
							<tr>
								<?php if ($u['kehadiran'] == 1) : ?>
									<th scope="row"><?= $i++; ?></th>
									<td><?= $u['dpt']; ?></td>
									<td><?= $u['nama']; ?></td>
									<td><?= $u['nik']; ?></td>
									<td><?= $u['jenis']; ?></td>
									<td><?php if ($u['kehadiran'] == 1) : ?>
											Belum datang
										<?php else : ?>
											Sudah datang
										<?php endif; ?>
									</td>
									<td>
										<a href="<?= base_url('data/edit/') . $u['id']; ?>" class="badge badge-success">edit</a>
									</td>
								<?php endif; ?>
							</tr>
						<?php endforeach; ?>

					</tbody>
				</table>
				<?php echo $this->pagination->create_links(); ?>

			</div>
		</div>
	</div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Delete Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-danger" id="exampleModalLabel">Warning</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">Click <strong>Delete</strong> below if you are sure.</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				<a class="btn btn-primary" href="<?= base_url('admin/A_oandelete/') . $u['id']; ?>">Delete</a>
			</div>
		</div>
	</div>
</div>