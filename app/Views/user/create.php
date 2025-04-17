<head>
    <title>Crear Usuario</title>
</head>

<?= $this->include('header'); ?>
<div class="container d-flex justify-content-center align-items-center mt-5 mb-5">

    <div class="col-11 col-sm-12 col-md-8 col-lg-6 bg-white shadow-lg rounded p-4">
        <h2 class="mt-2 text-center">Crear nuevo usuario</h2>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger text-center"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('user/create') ?>" method="POST">
            <?= csrf_field() ?>

            <div class="form-group mb-4">
                <label for="username">Nombre de usuario</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <div class="form-group mb-4">
                <label for="email">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group mb-4">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Crear usuario</button>
        </form>
    </div>
</div>

<?= $this->include('footer'); ?>