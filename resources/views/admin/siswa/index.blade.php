@section('title', $title)
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Daftar Siswa') }}
            </h2>
            <a href="{{ route('siswa.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition duration-200">
                + Tambah Siswa
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    @if (session('success'))
                        <div class="mb-6 px-4 py-3 rounded-md bg-green-50 dark:bg-green-800/30 border border-green-200 dark:border-green-700">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 dark:text-green-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-green-800 dark:text-green-200">{{ session('success') }}</span>
                                </div>
                                <button type="button" class="text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-200" onclick="this.parentElement.parentElement.remove()">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endif

                    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
                        <form method="GET" action="{{ route('siswa.index') }}" class="relative w-full sm:w-96 flex">
                            <div class="relative flex-1">
                                <input 
                                    type="search" 
                                    name="search" 
                                    placeholder="Cari siswa..." 
                                    value="{{ request('search') }}"
                                    class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                >
                                <div class="absolute left-3 top-2.5 text-gray-400 dark:text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>
                            <button 
                                type="submit"
                                class="ml-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-200 flex items-center"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                <span class="ml-1 hidden sm:inline">Cari</span>
                            </button>
                        </form>
                        
                        <div class="flex space-x-2">
                            <form method="GET" action="{{ route('siswa.index') }}" class="flex space-x-2">
                                <input type="hidden" name="search" value="{{ request('search') }}">
                                <select 
                                    name="sort" 
                                    onchange="this.form.submit()"
                                    class="px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                >
                                    <option value="">Urutkan</option>
                                    <option value="nama_asc" {{ request('sort') == 'nama_asc' ? 'selected' : '' }}>A-Z</option>
                                    <option value="nama_desc" {{ request('sort') == 'nama_desc' ? 'selected' : '' }}>Z-A</option>
                                    <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                                    <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                                </select>
                            </form>
                        </div>
                    </div>

                    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        NIS
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Nama Siswa
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Jenis Kelamin
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Kelas
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($siswa as $s)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $s->nis }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {{ $s->nama_siswa }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {{ $s->jk }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {{ $s->kelas->nama_kelas }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-right space-x-3">
                                        <button 
                                            onclick="openSiswaModal(
                                                '{{ $s->nis }}', 
                                                '{{ $s->nama }}', 
                                                '{{ $s->jenis_kelamin }}', 
                                                '{{ $s->kelas->nama_kelas }}', 
                                                '{{ $s->tempat_lahir }}', 
                                                '{{ $s->tanggal_lahir }}')"
                                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Detail
                                        </button>
                                        <a href="{{ route('siswa.edit', $s->id) }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </a>
                                        <form id="deleteForm{{ $s->id }}" action="{{ route('siswa.destroy', $s->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="showDeleteModal({{ $s->id }})"
                                                class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                        <div class="flex flex-col items-center justify-center py-8">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 dark:text-gray-500 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <p class="text-gray-600 dark:text-gray-400">Tidak ada data siswa yang tersedia.</p>
                                            <a href="{{ route('siswa.create') }}" class="mt-3 text-indigo-600 dark:text-indigo-400 hover:underline">Tambahkan siswa baru</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div id="siswaModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
                            <div class="bg-white rounded-2xl shadow-lg w-[400px] p-6">
                                <h2 class="text-xl font-bold mb-4">Detail Siswa</h2>
                                <p><span class="font-semibold">NIS:</span> <span id="modalNis"></span></p>
                                <p><span class="font-semibold">Nama:</span> <span id="modalNama"></span></p>
                                <p><span class="font-semibold">Jenis Kelamin:</span> <span id="modalKelamin"></span></p>
                                <p><span class="font-semibold">Kelas:</span> <span id="modalKelas"></span></p>
                                <p><span class="font-semibold">Tempat Lahir:</span> <span id="modalTempat"></span></p>
                                <p><span class="font-semibold">Tanggal Lahir:</span> <span id="modalTanggal"></span></p>

                                <div class="mt-6 text-right">
                                    <button onclick="closeSiswaModal()" class="bg-red-500 hover:bg-red-600 text-white py-1 px-4 rounded">
                                        Tutup
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div id="deleteModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
                            <div class="bg-white rounded-2xl shadow-lg w-[400px] p-6">
                                <h2 class="text-xl font-bold mb-4 text-red-600">Konfirmasi Hapus</h2>
                                <p class="text-gray-700">Yakin ingin menghapus data ini? Tindakan ini tidak bisa dibatalkan.</p>

                                <div class="mt-6 flex justify-end space-x-3">
                                    <button onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded">
                                        Batal
                                    </button>
                                    <button onclick="submitDeleteForm()" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($siswa->hasPages())
                    <div class="mt-6">
                        {{ $siswa->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function openSiswaModal(nis, nama, jk, kelas, tempat, tanggal) {
            document.getElementById('modalNis').innerText = nis;
            document.getElementById('modalNama').innerText = nama;
            document.getElementById('modalKelamin').innerText = jk;
            document.getElementById('modalKelas').innerText = kelas;
            document.getElementById('modalTempat').innerText = tempat;
            document.getElementById('modalTanggal').innerText = tanggal;
            document.getElementById('siswaModal').classList.remove('hidden');
        }

        function closeSiswaModal() {
            document.getElementById('siswaModal').classList.add('hidden');
        }

        let formToDelete = null;

        function showDeleteModal(formId) {
            formToDelete = document.getElementById('deleteForm' + formId);
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            formToDelete = null;
            document.getElementById('deleteModal').classList.add('hidden');
        }

        function submitDeleteForm() {
            if (formToDelete) {
                formToDelete.submit();
            }
        }
    </script>

</x-app-layout>