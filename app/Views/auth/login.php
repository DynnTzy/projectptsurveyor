<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded shadow w-full max-w-md">
        <h1 class="text-2xl mb-4">Sign in</h1>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-100 text-red-700 p-2 mb-3 rounded"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="/login" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="block mb-1">Username</label>
                <input type="text" name="username" value="<?= old('username') ?>" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-3">
                <label class="block mb-1">Password</label>
                <input type="password" name="password" class="w-full border p-2 rounded" required>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Login</button>
            </div>
        </form>
    </div>
</body>

</html>