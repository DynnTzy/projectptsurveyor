<?= view('layouts/header', ['title' => 'Tambah Pegawai']) ?>

<div class="card-shadow bg-white rounded-2xl p-8 max-w-4xl mx-auto">

    <h1 class="text-2xl font-semibold text-slate-800 mb-6 text-center">
        Form Tambah Pegawai
    </h1>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm">
            <ul class="list-disc pl-5 space-y-1">
                <?php foreach (session()->getFlashdata('errors') as $err): ?>
                    <li><?= esc($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>


    <form action="/employees/store" method="post" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?= csrf_field() ?>

        <!-- NIK -->
        <div>
            <label class="block mb-1 font-medium text-gray-700">NIK :</label>
            <input type="text" name="nik"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-sky-300" required>
        </div>

        <!-- Nama -->
        <div>
            <label class="block mb-1 font-medium text-gray-700">Nama :</label>
            <input type="text" name="name"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-sky-300" required>
        </div>

        <!-- Cabang -->
        <div>
            <label class="block mb-1 font-medium text-gray-700">Cabang :</label>
            <select name="cabang" class="w-full border rounded-lg px-3 py-2">
                <option value="">- Pilih Cabang -</option>
                <?php foreach ($cabang as $c): ?>
                    <option value="<?= esc($c['nama']) ?>" <?= old('cabang') == $c['nama'] ? 'selected' : '' ?>>
                        <?= esc($c['nama']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Divisi -->
        <div>
            <label class="block mb-1 font-medium text-gray-700">Divisi :</label>
            <select name="divisi" class="w-full border rounded-lg px-3 py-2">
                <option value="">- Pilih Divisi -</option>
                <?php foreach ($divisi as $d): ?>
                    <option value="<?= esc($d['nama']) ?>" <?= old('divisi') == $d['nama'] ? 'selected' : '' ?>>
                        <?= esc($d['nama']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Bagian -->
        <div>
            <label class="block mb-1 font-medium text-gray-700">Bagian :</label>
            <select name="bagian" class="w-full border rounded-lg px-3 py-2">
                <option value="">- Pilih Bagian -</option>
                <?php foreach ($bagian as $b): ?>
                    <option value="<?= esc($b['nama']) ?>" <?= old('bagian') == $b['nama'] ? 'selected' : '' ?>>
                        <?= esc($b['nama']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>


        <!-- Email -->
        <div>
            <label class="block mb-1 font-medium text-gray-700">Email :</label>
            <input type="text" name="email"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-sky-300">
        </div>

        <!-- Handphone -->
        <div>
            <label class="block mb-1 font-medium text-gray-700">Handphone :</label>
            <input type="text" name="phone"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-sky-300">
        </div>

        <!-- Tentang Pegawai -->
        <div class="md:col-span-2">
            <label class="block mb-1 font-medium text-gray-700">
                Tentang Pegawai : <span class="text-xs text-gray-400">(opsional)</span>
            </label>
            <textarea name="tentang" rows="4"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-sky-300"
                placeholder="Tulis keterangan tambahan pegawai..."></textarea>
        </div>

        <!-- BUTTON -->
        <div class="md:col-span-2 flex justify-end mt-2">
            <button class="flex items-center gap-2 px-6 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-full shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah
            </button>
        </div>

    </form>

</div>

<?= view('layouts/footer') ?>