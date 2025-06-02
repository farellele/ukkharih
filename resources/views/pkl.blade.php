<x-layouts.app title="PKL Stembayo">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1" class="text-gray-900 dark:text-white">PKL</flux:heading>
        <flux:subheading size="lg" class="mb-6 text-gray-700 dark:text-gray-300">
            Kelola data PKL dalam tabel ini
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="mb-4 flex justify-end gap-4">
        <a href="{{ route('pkl.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
            Tambah PKL
        </a>
    </div>

    <div class="overflow-auto bg-white dark:bg-gray-900 rounded-md shadow-md p-6">
        @if ($pkls->isEmpty())
            <p class="text-center text-gray-500 dark:text-gray-300">Belum ada data PKL.</p>
        @else
            <table class="table-auto w-full border-collapse border border-gray-300 dark:border-gray-600">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700 text-black dark:text-white">
                        <th class="px-4 py-2 border">Siswa</th>
                        <th class="px-4 py-2 border">Industri</th>
                        <th class="px-4 py-2 border">Guru Pembimbing</th>
                        <th class="px-4 py-2 border">Waktu Mulai</th>
                        <th class="px-4 py-2 border">Waktu Selesai</th>
                        <th class="px-4 py-2 border">Tanggal Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pkls as $pkl)
                        <tr class="text-center text-gray-900 dark:text-white">
                            <td class="px-4 py-2 border">{{ optional($pkl->siswa)->nama ?? '-' }}</td>
                            <td class="px-4 py-2 border">{{ optional($pkl->industri)->nama ?? '-' }}</td>
                            <td class="px-4 py-2 border">{{ optional($pkl->guru)->nama ?? '-' }}</td>
                            <td class="px-4 py-2 border">{{ $pkl->waktu_mulai ? \Carbon\Carbon::parse($pkl->waktu_mulai)->format('d-m-Y H:i') : '-' }}</td>
                            <td class="px-4 py-2 border">{{ $pkl->waktu_selesai ? \Carbon\Carbon::parse($pkl->waktu_selesai)->format('d-m-Y H:i') : '-' }}</td>
                            <td class="px-4 py-2 border">{{ $pkl->created_at ? \Carbon\Carbon::parse($pkl->created_at)->format('d-m-Y') : '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-layouts.app>
