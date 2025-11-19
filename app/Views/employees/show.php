<?= view('layouts/header', ['title' => 'Detail Pegawai']) ?>

<?php
function avatarCircle($name)
{
    $initial = strtoupper(substr($name, 0, 1));
    $colors = ['#60A5FA', '#F472B6', '#F59E0B', '#34D399', '#A78BFA', '#FB7185'];
    $c = $colors[crc32($name) % count($colors)];
    return "<div class='flex items-center justify-center w-20 h-20 rounded-full text-white font-semibold text-3xl shadow-md' style='background:{$c}'>$initial</div>";
}
?>

<div class="card-shadow bg-white rounded-2xl p-10 max-w-4xl mx-auto">

    <!-- Header -->
    <div class="flex items-center gap-6">
        <?= avatarCircle($employee['name']) ?>

        <div>
            <h2 class="text-2xl font-semibold text-slate-800"><?= esc($employee['name']) ?></h2>
            <div class="text-gray-500">
                <?= esc($employee['divisi']) ?> · <?= esc($employee['bagian']) ?>
            </div>
        </div>
    </div>

    <!-- Grid Informasi -->
    <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-8">

        <div>
            <div class="text-sm text-gray-500">NIK</div>
            <div class="font-semibold text-slate-700 text-lg"><?= esc($employee['nik']) ?></div>
        </div>

        <div>
            <div class="text-sm text-gray-500">Cabang</div>
            <div class="font-semibold text-slate-700 text-lg"><?= esc($employee['cabang']) ?></div>
        </div>

        <div>
            <div class="text-sm text-gray-500">Email</div>
            <div class="font-semibold text-slate-700 text-lg"><?= esc($employee['email']) ?></div>
        </div>

        <div>
            <div class="text-sm text-gray-500">Handphone</div>
            <div class="font-semibold text-slate-700 text-lg"><?= esc($employee['phone']) ?></div>
        </div>

    </div>

    <!-- Tentang Pegawai -->
    <div class="mt-10">
        <div class="text-sm text-gray-500 mb-1">Tentang Pegawai</div>
        <div class="p-4 border rounded-lg bg-gray-50 text-slate-700 text-sm leading-relaxed">
            <?= nl2br(esc($employee['tentang'])) ?>
        </div>
    </div>

    <!-- Button Kembali -->
    <div class="mt-8">
        <a href="/employees" class="text-sky-600 hover:underline text-sm">← Kembali</a>
    </div>

</div>

<?= view('layouts/footer') ?>