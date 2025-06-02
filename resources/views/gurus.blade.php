<x-layouts.app title="PKL Stembayo">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1" class="text-gray-900 dark:text-white">Guru</flux:heading>
        <flux:subheading size="lg" class="mb-6 text-gray-700 dark:text-gray-300">Kelola guru pada tabel ini</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="overflow-auto bg-white dark:bg-gray-900 rounded-md shadow-md p-6">
        <table class="table-auto w-full border-collapse border border-gray-300 dark:border-gray-600">
            <thead>
                <tr class="bg-gray-200 dark:bg-gray-700 text-black dark:text-white">
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">NIP</th>
                    <th class="px-4 py-2 border">Gender</th>
                    <th class="px-4 py-2 border">Kontak</th>
                    <th class="px-4 py-2 border">Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gurus as $guru)
                    <tr class="text-center text-gray-900 dark:text-white">
                        <td class="px-4 py-2 border">{{ $guru->nama }}</td>
                        <td class="px-4 py-2 border">{{ $guru->nip }}</td>
                        <td class="px-4 py-2 border">{{ $guru->gender }}</td>
                        <td class="px-4 py-2 border">{{ $guru->kontak }}</td>
                        <td class="px-4 py-2 border">{{ $guru->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.app>
