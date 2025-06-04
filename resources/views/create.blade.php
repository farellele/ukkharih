<x-layouts.app title="Tambah PKL">
    <h1 class="mb-4 text-2xl font-semibold text-gray-900 dark:text-white">Tambah PKL</h1>

    <!-- Menampilkan pesan error -->
    @if (session('error'))
        <div class="p-4 mb-4 text-red-700 bg-red-100 border border-red-400 rounded-lg">
            <strong>Error:</strong> {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('pkl.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Nama -->
        <label for="siswa_nama" class="block text-lg font-medium text-gray-900 dark:text-white">Nama</label>
        <input type="text" name="siswa_nama" id="siswa_nama" value="{{ auth()->user()->name }}" readonly 
            class="border rounded p-3 w-full text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-700 text-lg" />

        <!-- Industri -->
        <label for="industri_id" class="block text-lg font-medium text-gray-900 dark:text-white">Industri</label>
        <select name="industri_id" id="industri_id" required 
            class="border rounded p-3 w-full text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-700 text-lg">
            <option hidden disabled selected>Pilih Industri</option>
            @foreach ($industris as $industri)
                <option value="{{ $industri->id }}">{{ $industri->nama }}</option>
            @endforeach
        </select>

        <!-- Guru Pembimbing -->
        <label for="guru_id" class="block text-lg font-medium text-gray-900 dark:text-white">Guru Pembimbing</label>
        <select name="guru_id" id="guru_id" required 
            class="border rounded p-3 w-full text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-700 text-lg">
            <option hidden disabled selected>Pilih Guru</option>
            @foreach ($gurus as $guru)
                <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
            @endforeach
        </select>

        <!-- Waktu Mulai -->
        <label for="waktu_mulai" class="block text-lg font-medium text-gray-900 dark:text-white">Waktu Mulai</label>
        <input type="datetime-local" name="waktu_mulai" id="waktu_mulai" required 
            class="border rounded p-3 w-full text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-700 text-lg" />

        <!-- Waktu Selesai -->
        <label for="waktu_selesai" class="block text-lg font-medium text-gray-900 dark:text-white">Waktu Selesai</label>
        <input type="datetime-local" name="waktu_selesai" id="waktu_selesai" required 
            class="border rounded p-3 w-full text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-700 text-lg" />

    <form action="{{ route('pkl.store') }}" method="POST">
        @csrf
        <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded text-lg font-semibold hover:bg-green-700 transition">
            Simpan
        </button>
    </form>
</x-layouts.app>
