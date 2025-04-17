<head>
    <title>Editar Usuario</title>
</head>

<?= $this->include('header'); ?>

<div class="container d-flex justify-content-center align-items-center mt-5 mb-5">
    <div class="col-11 col-sm-12 col-md-8 col-lg-6 bg-white shadow-lg rounded p-4">
        <h2 class="text-center mb-4">Editar usuario</h2>

        <!-- Mensajes flash -->
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('user/edit/' . $user['id']) ?>" method="POST">
            <?= csrf_field(); ?>

            <div class="form-group mb-4">
                <label for="username">Nombre de usuario</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= esc($user['username']) ?>" required>
            </div>

            <div class="form-group mb-4">
                <label for="email">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= esc($user['email']) ?>" required>
            </div>

            <div class="form-group mb-4">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" value="<?= esc($user['password']) ?>">
            </div>

            <button type="submit" class="btn btn-primary">Actualizar usuario</button>
        </form>
    </div>
</div>

<?= $this->include('footer'); ?>