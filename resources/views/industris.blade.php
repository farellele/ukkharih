<x-layouts.app title="PKL Stembayo">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1" class="text-gray-900 dark:text-white">Industri</flux:heading>
        <flux:subheading size="lg" class="mb-6 text-gray-700 dark:text-gray-300">Kelola industri dalam tabel ini</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <!-- Tambah Industri -->
    <div class="mb-4 flex justify-end gap-4">
        <a href="{{ route('industris.create_industri') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
            Tambah Industri
        </a>
    </div>

    <!-- Container untuk tabel industri -->
    <div class="overflow-auto bg-white dark:bg-gray-900 rounded-md shadow-md p-6">
        <table class="table-auto w-full border-collapse border border-gray-300 dark:border-gray-600">
            <thead>
                <tr class="bg-gray-200 dark:bg-gray-700 text-black dark:text-white">
                    <th class="px-4 py-2 border">Nama Industri</th>
                    <th class="px-4 py-2 border">Bidang</th>
                    <th class="px-4 py-2 border">Alamat</th>
                    <th class="px-4 py-2 border">Kontak</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">Tanggal Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($industris as $industri)
                    <tr class="text-center text-gray-900 dark:text-white">
                        <td class="px-4 py-2 border">{{ $industri->nama }}</td>
                        <td class="px-4 py-2 border">{{ $industri->bidang }}</td>
                        <td class="px-4 py-2 border">{{ $industri->alamat }}</td>
                        <td class="px-4 py-2 border">{{ $industri->kontak }}</td>
                        <td class="px-4 py-2 border">{{ $industri->email }}</td>
                        <td class="px-4 py-2 border">{{ $industri->created_at->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.app>
