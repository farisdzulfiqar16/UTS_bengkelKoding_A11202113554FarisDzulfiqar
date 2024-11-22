<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>halaman registrasi</title>
</head>

<body>
    <form method="post" action="/register">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" value="<?= old('username') ?>" required>
            <?= isset($validation) ? $validation->getError('username') : '' ?>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="<?= old('email') ?>" required>
            <?= isset($validation) ? $validation->getError('email') : '' ?>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
            <?= isset($validation) ? $validation->getError('password') : '' ?>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
            <?= isset($validation) ? $validation->getError('confirm_password') : '' ?>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>

    <?php if (isset($validation)): ?>
        <div class="alert alert-danger">
            <?= implode('<br>', $validation) ?>
        </div>
    <?php endif; ?>

</body>

</html>