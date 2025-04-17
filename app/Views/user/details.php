<head>
    <title>Detalles</title>
</head>

<?= $this->include('header'); ?>

<div class="container d-flex justify-content-center align-items-center mt-5">
    <div class="col-11 col-sm-12 col-md-8 col-lg-6 bg-white shadow-lg rounded p-4">
        <h2 class="text-center mb-4">Informacion de: <?= esc($user['username']) ?></h2>
        <div class="card border-0">
            <div class="card-body">
                <h5 class="card-title"><?= esc($user['username']) ?></h5>
                <p class="card-text">Correo: <?= esc($user['email']) ?></p>
                <p class="card-text">Password: <?= esc($user['password']) ?></p>
                <div class="d-flex justify-content-center">
                    <a href="<?= site_url('user/edit/' . $user['id']) ?>" class="btn btn-primary m-1">Editar informacion</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('footer'); ?>