<div class="animated fadeIn">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title"><?= $title ?></strong>
                    <span class="float-right">
                        <a href="<?= base_url() ?>/Dashboard" class="btn btn-warning btn-sm"><i class="fa fa-chevron-circle-left"></i></a>
                    </span>
                </div>
                <div class="card-body">

                    <!-- Pesan Flash Data -->
                    <?php if ($this->session->flashdata('error')) : ?>
                        <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
                    <?php endif; ?>

                    <form method="post" action="<?= base_url() ?>user/Dashboard/getuser" id="ubah" enctype="multipart/form-data" class="form-horizontal">
                        <div class="row form-group">
                            <div class="col col-md-3 offset-2">
                                <label for="oldpass" class="form-control-label">Password Lama</label>
                            </div>
                            <div class="col-12 col-md-4">
                                <input type="password" id="oldpass" name="oldpass" placeholder="Password Lama" class="form-control" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3 offset-2">
                                <label for="newpass" class="form-control-label">Password Baru</label>
                            </div>
                            <div class="col-12 col-md-4">
                                <input type="password" id="newpass" name="newpass" placeholder="Password Baru" class="form-control" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3 offset-2">
                                <label for="repass" class="form-control-label">Re-Password Baru</label>
                            </div>
                            <div class="col-12 col-md-4">
                                <input type="password" id="repass" name="repass" placeholder="Re-Password Baru" class="form-control" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3 offset-2"></div>
                            <div class="col-12 col-md-4">
                                <button class="btn btn-info" id="btnSimpan" type="submit">Simpan</button>
                                <button class="btn btn-danger" type="reset">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><!-- .animated -->
<script>
    $(document).ready(function () {
    $('#ubah').validate({
        rules: {
            oldpass: { required: true },
            newpass: { required: true },
            repass: { required: true, equalTo: '#newpass' }
        },
        messages: {
            oldpass: { required: "Inputan tidak boleh kosong!" },
            newpass: { required: "Inputan tidak boleh kosong!" },
            repass: { required: "Inputan tidak boleh kosong!", equalTo: "Pastikan inputan sama!" }
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
            error.addClass("text-danger");
        }
    });
});
</script>
