@extends('components.layout')

@section('title')
    Surat Keterangan Mahasiswa Aktif
@endsection

@section('content')
    <section class="bg-white flex flex-col md:flex-row h-[100vh] ml-64">
        <!-- Form Section -->
        <div class="basis-1/2 p-10 flex items-center justify-center bg-red-500">
            <div class="w-full h-fit rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Isi Data Mahasiswa
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="{{ route('detailsurat.storeSurat1') }}" method="POST">
                        @csrf
                        <!-- Semester -->
                        <div>
                            <label for="semester" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Semester</label>
                            <input type="number" name="semester" id="semester" placeholder="Enter your semester"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="{{ old('semester') }}" required>
                            @error('semester')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Alamat Lengkap -->
                        <div>
                            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat Lengkap</label>
                            <textarea name="address" id="address" placeholder="Enter your address"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>{{ old('address') }}</textarea>
                            @error('address')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Keperluan Pengajuan -->
                        <div>
                            <label for="purpose" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keperluan Pengajuan</label>
                            <input type="text" name="purpose" id="purpose" placeholder="Enter your purpose"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="{{ old('purpose') }}" required>
                            @error('purpose')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Template Surat -->
        <section class="bg-white flex flex-col items-center justify-center min-h-screen py-10">
        <div class="bg-white shadow-lg rounded-lg p-10 w-full max-w-2xl ">
            <div class="text-center mb-6">
                <img src="{{ asset('images/maranatha_logo.png') }}" alt="" class="mx-auto h-20">
                <h2 class="text-lg font-bold mt-2">UNIVERSITAS KRISTEN MARANATHA</h2>
                <p class="text-sm">Fakultas Teknologi Informasi</p>
                <p class="text-sm">Program Sarjana Teknik Informatika</p>
            </div>
            <h1 class="text-xl font-bold text-center">SURAT KETERANGAN</h1>
            <p class="text-center mb-6">No. 139/KAPROG/S1IF/IV/2024</p>

            <p class="mb-4">Yang bertanda tangan di bawah ini:</p>
            <p><strong>Nama:</strong> Julianti Kasih, S.E., M.Kom.</p>
            <p><strong>NIK:</strong> 720286</p>
            <p><strong>Jabatan:</strong> Ketua Program Sarjana Teknik Informatika</p>

            <p class="mt-4">Dengan ini menerangkan bahwa yang namanya tertera di bawah ini:</p>
            <p><strong>Nama:</strong> {{ session('nama') ?? '-' }}</p>
            <p><strong>NRP:</strong> {{ session('nrp') ?? '-' }}</p>
            <p><strong>Semester:</strong> {{ session('semester') ?? '-' }}</p>
            <p><strong>Alamat:</strong> {{ session('address') ?? '-' }}</p>
            <p><strong>Keperluan:</strong> {{ session('purpose') ?? '-' }}</p>

            <p class="mt-4">Adalah <strong>benar mahasiswa aktif</strong> di Program Sarjana Teknik Informatika Fakultas Teknologi Informasi pada Semester Genap 2023/2024, dan surat ini dibuat atas permohonan mahasiswa yang bersangkutan untuk keperluan <strong>{{ session('purpose') ?? '-' }}</strong>.</p>

            <p class="mt-4">Demikian agar yang berkepentingan menjadi maklum dan surat ini dapat digunakan sebagaimana mestinya.</p>

            <p class="mt-6 text-right">Bandung, {{ date('d F Y') }}</p>
            <p class="text-right mt-2">Hormat Kami,</p>
            <div class="text-right mt-10">
                <p class="font-bold">Julianti Kasih, S.E., M.Kom.</p>
                <p>Ketua Program Sarjana Teknik Informatika</p>
            </div>
        </div>
    </section>
@endsection
