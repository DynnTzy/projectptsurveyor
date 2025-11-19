<?= view('layouts/header', ['title' => 'Edit Pegawai']) ?>

<div class="card-shadow bg-white rounded-2xl p-8 max-w-4xl mx-auto">

    <h1 class="text-2xl font-semibold text-slate-800 mb-6 text-center">
        Edit Pegawai
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


    <form action="/employees/<?= $employee['id'] ?>/update" method="post"
        class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?= csrf_field() ?>

        <!-- NIK -->
        <div>
            <label class="block mb-1 font-medium text-gray-700">NIK :</label>
            <input type="text" name="nik" value="<?= esc($employee['nik']) ?>"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-sky-300">
        </div>

        <!-- Nama -->
        <div>
            <label class="block mb-1 font-medium text-gray-700">Nama :</label>
            <input type="text" name="name" value="<?= esc($employee['name']) ?>"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-sky-300" required>
        </div>

        <!-- Cabang -->
        <div>
            <label class="block mb-1 font-medium text-gray-700">Cabang :</label>
            <select name="cabang" class="w-full border rounded-lg px-3 py-2">
                <option value="">- Pilih Cabang -</option>
                <?php foreach ($cabang as $c): ?>
                    <option value="<?= esc($c['nama']) ?>" <?= $employee['cabang'] == $c['nama'] ? 'selected' : '' ?>>
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
                    <option value="<?= esc($d['nama']) ?>" <?= $employee['divisi'] == $d['nama'] ? 'selected' : '' ?>>
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
                    <option value="<?= esc($b['nama']) ?>" <?= $employee['bagian'] == $b['nama'] ? 'selected' : '' ?>>
                        <?= esc($b['nama']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>


        <!-- Email -->
        <div>
            <label class="block mb-1 font-medium text-gray-700">Email :</label>
            <input type="text" name="email" value="<?= esc($employee['email']) ?>"
                class="w-full border rounded-lg px-3 py-2">
        </div>

        <!-- Handphone -->
        <div>
            <label class="block mb-1 font-medium text-gray-700">Handphone :</label>
            <input type="text" name="phone" value="<?= esc($employee['phone']) ?>"
                class="w-full border rounded-lg px-3 py-2">
        </div>

        <!-- Tentang Pegawai -->
        <div class="md:col-span-2">
            <label class="block mb-1 font-medium text-gray-700">Tentang Pegawai :</label>
            <textarea name="tentang" rows="4"
                class="w-full border rounded-lg px-3 py-2"><?= esc($employee['tentang']) ?></textarea>
        </div>

        <!-- Submit -->
        <div class="md:col-span-2 flex justify-end">
            <button class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-full shadow">
                Update
            </button>
        </div>

    </form>

</div>

<?= view('layouts/footer') ?>