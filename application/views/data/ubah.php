<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
	</div>

	<div class="row">
		<div class="col-lg-7 mx-auto ">
			<div class="card">
				<h5 class="card-header"> Form <?= $title; ?></h5>
				<div class="card-body">
					<form action="" <?= base_url('data/edit'); ?>" method="POST" class="data">
						<input type="hidden" name="id" value="<?= $data['id']; ?>">
						<div class="form-group">
							<label for="dpt">No.DPT</label>
							<input type="text" class="form-control" id="dpt" name="dpt" value="<?= $data['dpt']; ?>" readonly>
						</div>
						<div class="form-group">
							<label for="nama">Nama</label>
							<input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama']; ?>" readonly>
						</div>
						<div class="form-group">
							<label for="nik">NIK</label>
							<input type="text" class="form-control" id="nik" name="nik" value="<?= $data['nik']; ?>" readonly>
						</div>
						<div class="form-group">
							<label for="jenis">Jenis Kelamin</label>
							<input type="text" class="form-control" id="jenis" name="jenis" value="<?= $data['jenis']; ?>" readonly>
						</div>
						<div class="form-group">
							<label for="hadir">Kehadiran</label>
							<select name="hadir" id="hadir" class="form-control">
								<option value="">Pilih Kehadiran</option>
								<?php if ($data['kehadiran'] == 1) : ?>
									<?php $tampung = "Belum hadir" ?>
								<?php else : ?>
									<?php $tampung = "Sudah hadir" ?>
								<?php endif; ?>

								<?php foreach ($status as $s) : ?>
									<?php if ($s == $tampung) : ?>
										<option value="<?= $s; ?>" selected><?= $s; ?></option>
									<?php else : ?>
										<option value="<?= $s; ?>"><?= $s; ?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
							<?= form_error('hadir', '<small class="text-danger pl-3">', '</small>'); ?>

						</div>
						<button type="submit" class="btn btn-danger float-right">
							Save Change
						</button>
						<a href="<?= base_url('data'); ?>" class="btn btn-secondary">Back</i></a>

					</form>

				</div>
			</div>

		</div>
	</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
