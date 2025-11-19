<?= view('layouts/header', ['title' => 'Data Pegawai']) ?>

<?php
function avatarCircle($name)
{
    $initial = strtoupper(substr(trim($name), 0, 1) ?: 'U');
    $colors = ['#60A5FA', '#F472B6', '#F59E0B', '#34D399', '#A78BFA', '#FB7185'];
    $c = $colors[crc32($name) % count($colors)];
    return "<div class='flex items-center justify-center w-10 h-10 rounded-full text-white font-semibold shadow' style='background:{$c}'>{$initial}</div>";
}
?>

<div class="card-shadow bg-white rounded-lg p-6">

    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-2xl font-semibold text-slate-800">Data Pegawai</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola data pegawai perusahaan</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="/employees/export/csv" class="px-4 py-2 rounded-full bg-gray-800 text-white text-sm shadow">Generate Excel</a>
            <a href="/employees/create" class="px-4 py-2 rounded-full bg-sky-600 text-white text-sm shadow">Tambah Pegawai</a>
        </div>
    </div>

    <div class="flex items-center justify-between mb-3">
        <div class="text-sm text-gray-500">
            Show
            <select class="border rounded px-2 py-1 ml-2">
                <option>10</option>
                <option>25</option>
                <option>50</option>
            </select>
            entries
        </div>

        <form method="get" action="/employees" class="flex items-center gap-2">
            <input type="text" name="q" placeholder="Search..." class="border rounded px-3 py-2" value="<?= esc($q ?? '') ?>">
            <button class="bg-sky-600 text-white px-3 py-2 rounded">Search</button>
        </form>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="mb-4 p-3 rounded bg-green-50 text-green-800 border border-green-100">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="text-xs uppercase text-gray-500 border-b">
                <tr>
                    <th class="p-3 text-left w-12">No</th>
                    <th class="p-3 text-left">Foto</th>
                    <th class="p-3 text-left">NIK</th>
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Cabang</th>
                    <th class="p-3 text-left">Divisi</th>
                    <th class="p-3 text-left">Bagian</th>
                    <th class="p-3 text-left">Kontak</th>
                    <th class="p-3 text-left w-40">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php if (empty($employees)): ?>
                    <tr>
                        <td colspan="9" class="p-8 text-center text-gray-400">Belum ada data pegawai</td>
                    </tr>
                <?php else: ?>
                    <?php
                    // ensure $start exists (sent from controller)
                    $start = isset($start) ? (int)$start : 0;
                    $no = $start;
                    ?>
                    <?php foreach ($employees as $e): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3"><?= ++$no ?></td>

                            <td class="p-3">
                                <?= avatarCircle($e['name']) ?>
                            </td>

                            <td class="p-3"><?= esc($e['nik']) ?></td>

                            <td class="p-3 font-medium"><?= esc($e['name']) ?></td>

                            <td class="p-3 text-gray-600"><?= esc($e['cabang']) ?></td>

                            <td class="p-3 text-gray-600"><?= esc($e['divisi']) ?></td>

                            <td class="p-3 text-gray-600"><?= esc($e['bagian']) ?></td>

                            <td class="p-3 text-gray-600">
                                <div class="text-sm"><?= esc($e['email']) ?></div>
                                <div class="text-xs text-gray-400"><?= esc($e['phone']) ?></div>
                            </td>

                            <td class="p-3">
                                <div class="flex gap-2 justify-end">
                                    <a href="/employees/<?= $e['id'] ?>" class="px-3 py-1 rounded-full bg-indigo-600 text-white text-xs">Detail</a>
                                    <a href="/employees/<?= $e['id'] ?>/edit" class="px-3 py-1 rounded-full bg-yellow-400 text-white text-xs">Edit</a>
                                    <a href="/employees/<?= $e['id'] ?>/delete" data-delete class="px-3 py-1 rounded-full border border-red-300 text-red-600 text-xs">Hapus</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination + info -->
    <div class="mt-4 flex flex-col md:flex-row items-start md:items-center justify-between gap-3">
        <div class="text-sm text-gray-600">
            <?php
            // show from-to info when employees not empty
            if (! empty($employees)) {
                $from = $start + 1;
                $to = $start + count($employees);
                echo "Menampilkan <span class='font-medium text-slate-700'>{$from}</span> sampai <span class='font-medium text-slate-700'>{$to}</span>";
                if (isset($pager) && method_exists($pager, 'getDetails')) {
                    // try to show total if available
                    $details = $pager->getDetails();
                    if (isset($details['total'])) {
                        echo " dari <span class='font-medium text-slate-700'>{$details['total']}</span> data";
                    }
                }
            }
            ?>
        </div>

        <div>
            <!-- wrapper to style default links output -->
            <nav class="inline-flex items-center rounded-md shadow-sm" aria-label="Pagination">
                <?= $pager->links('default', 'tailwind_full') ?>

            </nav>
        </div>
    </div>

</div>

<?= view('layouts/footer') ?>