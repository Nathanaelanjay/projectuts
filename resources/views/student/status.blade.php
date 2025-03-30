@extends('components.layout')

@section('title', 'Daftar Pengajuan Surat')

@section('content')
<section class="bg-white py-8 antialiased md:py-16 pl-64">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="mx-auto max-w-5xl">
            <div class="gap-4 sm:flex sm:items-center sm:justify-between">
                <h1 class="text-2xl font-semibold text-gray-900">Daftar Pengajuan Surat</h1>
            </div>

            <div class="mt-6 flow-root sm:mt-8">
                @if($detailsurat->isEmpty())
                    <p class="text-gray-500 text-center py-6">Belum ada pengajuan surat.</p>
                @else
                    <div class="divide-y divide-gray-200">
                        @foreach($detailsurat as $item)
                        @php
                            $statusColors = [
                                'Confirmed' => ['bg' => 'bg-green-100', 'text' => 'text-green-800'],
                                'In transit' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800'],
                                'Pending' => ['bg' => 'bg-gray-200', 'text' => 'text-gray-800'],
                            ];
                            $status = $statusColors[$item->status] ?? ['bg' => 'bg-gray-200', 'text' => 'text-gray-800'];
                        @endphp

                        <div class="flex flex-wrap items-center gap-y-4 py-6">
                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500">ID Surat:</dt>
                                <dd class="mt-1.5 text-base font-semibold text-gray-900">
                                    <a href="{{ route('detailsurat.show', $item->id) }}" class="hover:underline">#{{ $item->id }}</a>
                                </dd>
                            </dl>

                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500">Tgl Pengajuan:</dt>
                                <dd class="mt-1.5 text-base font-semibold text-gray-900">{{ $item->tanggal_pengajuan }}</dd>
                            </dl>

                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500">Kategori:</dt>
                                <dd class="mt-1.5 text-base font-semibold text-gray-900">{{ $item->kategori }}</dd>
                            </dl>

                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500">Status:</dt>
                                <dd class="mt-1.5 inline-flex items-center rounded px-2.5 py-0.5 text-xs font-medium {{ $status['bg'] }} {{ $status['text'] }}">
                                    {{ $item->status }}
                                </dd>
                            </dl>

                            <div class="w-full grid sm:grid-cols-2 lg:flex lg:w-64 lg:items-center lg:justify-end gap-4">
                                <a href="{{ route('detailsurat.show', $item->id) }}" class="w-full inline-flex justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100">
                                    View details
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
