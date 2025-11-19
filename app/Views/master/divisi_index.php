<?= view('layouts/header', ['title' => 'Master Divisi']) ?>

<div class="card-shadow bg-white rounded-lg p-6 max-w-4xl mx-auto">

    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-xl font-semibold">Master Divisi</h1>
            <p class="text-sm text-gray-500">Kelola data divisi perusahaan</p>
        </div>
        <a href="/master/divisi/create" class="px-4 py-2 bg-sky-600 text-white rounded-full text-sm shadow">Tambah Divisi</a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="mb-4 p-3 rounded bg-green-50 text-green-800 border border-green-100">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="text-xs text-gray-500 border-b">
                <tr>
                    <th class="p-3 text-left w-16">No</th>
                    <th class="p-3 text-left">Nama Divisi</th>
                    <th class="p-3 text-right w-36">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($divisis)): ?>
                    <tr>
                        <td colspan="3" class="p-6 text-center text-gray-400">Belum ada data divisi</td>
                    </tr>
                    <?php else: $no = 0;
                    foreach ($divisis as $d): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3"><?= ++$no ?></td>
                            <td class="p-3 font-medium"><?= esc($d['nama']) ?></td>
                            <td class="p-3 text-right">
                                <a href="/master/divisi/<?= $d['id'] ?>/edit" class="px-3 py-1 rounded-full bg-yellow-400 text-white text-xs">Edit</a>
                                <a href="/master/divisi/<?= $d['id'] ?>/delete" data-delete class="px-3 py-1 rounded-full border border-red-300 text-red-600 text-xs">Hapus</a>
                            </td>
                        </tr>
                <?php endforeach;
                endif; ?>
            </tbody>
        </table>
    </div>

</div>

<?= view('layouts/footer') ?>