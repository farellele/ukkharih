<x-layouts.app title="Tambah Industri">
    <h1 class="mb-4 text-2xl font-semibold text-gray-900 dark:text-white">Tambah Industri</h1>

    <form action="{{ route('industris.store') }}" method="POST" class="mb-6 space-y-4">
        @csrf
        <label for="nama" class="block text-lg font-medium text-gray-900 dark:text-white">Nama Industri</label>
        <input type="text" name="nama" id="nama" required class="border rounded p-3 w-full text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-700 text-lg" />

        <label for="bidang" class="block text-lg font-medium text-gray-900 dark:text-white">Bidang</label>
        <input type="text" name="bidang" id="bidang" required class="border rounded p-3 w-full text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-700 text-lg" />

        <label for="alamat" class="block text-lg font-medium text-gray-900 dark:text-white">Alamat</label>
        <input type="text" name="alamat" id="alamat" class="border rounded p-3 w-full text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-700 text-lg" />

        <label for="kontak" class="block text-lg font-medium text-gray-900 dark:text-white">Kontak</label>
        <input type="text" name="kontak" id="kontak" class="border rounded p-3 w-full text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-700 text-lg" />

        <label for="email" class="block text-lg font-medium text-gray-900 dark:text-white">Email</label>
        <input type="email" name="email" id="email" class="border rounded p-3 w-full text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-700 text-lg" />

        <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded text-lg font-semibold hover:bg-green-700 transition">
            Simpan Industri
        </button>
    </form>
</x-layouts.app>
