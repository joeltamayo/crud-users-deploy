<head>
    <title>Lista de usuarios</title>
</head>

<?= $this->include('header'); ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-11 col-sm-12 col-md-10 col-lg-8 bg-white shadow-lg rounded p-4 mb-5">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
                <h2 class="mb-3">Usuarios</h2>
                <a href="<?= base_url('user/create') ?>" class="btn btn-success mb-3">Crear nuevo usuario</a>
            </div>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <div class="table-responsive">
                <?php if (empty($users)): ?>
                    <p class="text-center">No hay usuarios registrados.</p>
                <?php else: ?>
                    <table class="table table-striped align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Nombre de usuario</th>
                                <th>Correo electrónico</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= $user['id'] ?></td>
                                    <td><?= $user['username'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td>
                                    <a href="<?= base_url('user/details/' . $user['id']) ?>" class="btn btn-success btn-sm mb-2">Detalles</a>
                                        <a href="<?= base_url('user/edit/' . $user['id']) ?>" class="btn btn-warning btn-sm mb-2">Editar</a>
                                        <a href="<?= site_url('user/delete/' . $user['id']) ?>"
                                            class="btn btn-danger btn-sm mb-2"
                                            onclick="return confirm('¿Estás seguro de que deseas eliminar al usuario? Esta acción no se puede deshacer.');">
                                            Eliminar
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->include('footer'); ?>
