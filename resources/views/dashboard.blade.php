<x-layouts.app :title="('PKL Stembayo')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <!-- Total Siswa -->
            <div class="relative aspect-video flex justify-center items-center p-6 rounded-xl border border-neutral-200 dark:border-neutral-700 bg-gray-100 white:bg-gray-800">
                <img src="https://static.vecteezy.com/system/resources/previews/009/374/090/original/3d-user-account-icon-png.png" alt="Siswa" class="w-30 h-30">
                <div class="ml-6 text-center">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-black">Total Siswa</h2>
                    <p class="text-3xl font-bold text-black dark:text-black">{{ $totalSiswa }}</p>
                </div>
            </div>

            <!-- Total Guru -->
            <div class="relative aspect-video flex justify-center items-center p-6 rounded-xl border border-neutral-200 dark:border-neutral-700 bg-gray-100 white:bg-gray-800">
                <img src="https://icon-library.com/images/teacher-icon-png/teacher-icon-png-3.jpg" alt="Guru" class="w-30 h-30">
                <div class="ml-6 text-center">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-black">Total Guru</h2>
                    <p class="text-3xl font-bold text-black dark:text-black">{{ $totalGuru }}</p>
                </div>
            </div>

            <!-- Total Industri -->
            <div class="relative aspect-video flex justify-center items-center p-6 rounded-xl border border-neutral-200 dark:border-neutral-700 bg-gray-100 white:bg-gray-800">
                <img src="https://www.freeiconspng.com/uploads/industry-icon-png-0.png" alt="Industri" class="w-30 h-30">
                <div class="ml-6 text-center">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-black">Total Industri</h2>
                    <p class="text-3xl font-bold text-black dark:text-black">{{ $totalIndustri }}</p>
                </div>
            </div>
        </div>
<div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-gray-100 dark:bg-gray-800">
    <div class="w-full h-full">
        <iframe 
            class="w-full h-full rounded-xl"
            src="https://www.youtube.com/embed/NJc03JPuETk" 
            title="Video PKL Stembayo"
            frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
            allowfullscreen>
        </iframe>
    </div>
</div>


    </div>
</x-layouts.app>