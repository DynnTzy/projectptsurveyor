<?= view('layouts/header', ['title' => 'Tambah Divisi']) ?>

<div class="card-shadow bg-white rounded-lg p-6 max-w-2xl mx-auto">

    <h1 class="text-xl font-semibold mb-4">Tambah Divisi</h1>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="mb-4 p-3 rounded bg-red-50 text-red-700 border border-red-100 text-sm">
            <ul class="list-disc pl-5">
                <?php foreach (session()->getFlashdata('errors') as $err): ?>
                    <li><?= esc($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="/master/divisi/store" method="post" class="space-y-4">
        <?= csrf_field() ?>

        <div>
            <label class="block text-sm text-gray-600 mb-1">Nama Divisi</label>
            <input type="text" name="nama" value="<?= esc(old('nama')) ?>" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="flex justify-end">
            <a href="/master/divisi" class="px-4 py-2 mr-2 rounded border text-sm">Batal</a>
            <button class="px-4 py-2 rounded bg-sky-600 text-white text-sm">Simpan</button>
        </div>
    </form>

</div>

<?= view('layouts/footer') ?>