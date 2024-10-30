@extends('backend.layout.main')
@section('content')
<main class="main-content flex-1 p-6 overflow-y-auto transition-all duration-300">
<div class="container mx-auto p-6">
    <!-- Heading Section -->
    <div class="bg-green-500 text-white p-6 rounded-lg shadow-lg mb-8 text-center lg:text-left">
        <h1 class="text-3xl font-bold">Lacak Pesanan - ID {{$donate->id}}</h1>
        <p class="mt-2">
            Lihat status terkini pengiriman pesanan Anda.
        </p>
    </div>

    <!-- Info Pesanan -->
    <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
        <h2 class="text-2xl font-semibold text-green-600 mb-4">Informasi Pesanan</h2>
        <?php 
                        $jmlhDonasi = $donate->donation_type == "uang" 
                            ? "RP. " . number_format($donate->amount, 0, ',', '.') 
                            : number_format($donate->item_qty, 0, ',', '.') . " Paket ". $donate->item_name;

                            $tglPesanan = new DateTime($donate->created_at);
                            $formattedDate = $tglPesanan->format('d F Y');
                    ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p><strong>Nomor Pesanan:</strong> {{$donate->id}}</p>
                <p><strong>Jenis Donasi:</strong> {{$donate->donation_type}}</p>
                <p><strong>Jumlah:</strong> {{$jmlhDonasi}}</p>
            </div>
            <div>
                <p><strong>Penerima:</strong> Yayasan Peduli</p>
                <p><strong>Tanggal Pesanan:</strong> {{ $formattedDate }}</p>
                <p><strong>Status Pesanan:</strong> <span class="text-green-600 font-bold">Dalam Pengiriman</span></p>
            </div>
        </div>
    </div>

    <!-- Status Tracking -->
    <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
        <h2 class="text-2xl font-semibold text-green-600 mb-4">Lacak Status Pengiriman</h2>
        <div class="relative">
            <div class="border-l-2 border-green-500 absolute h-full top-0 left-4"></div>
            <ul class="space-y-8">
                <!-- Status 1 -->
                @foreach ($track as $key => $item)
                @if ($jmlhHistory == $key+1)
                    <li class="flex items-center">
                    <div class="bg-gray-300 text-white rounded-full w-8 h-8 flex items-center justify-center">
                        <span class="font-bold">{{$key+1}}</span>
                    </div>
                    <div class="ml-6">
                        <p class="text-lg font-semibold">Pesanan Tiba</p>
                        <p class="text-sm text-gray-600">{{$item->date}} - {{$item->location ?? '-'}}</p>
                    </div>
                </li>
                @else
                <li class="flex items-center">
                    <div class="bg-green-500 text-white rounded-full w-8 h-8 flex items-center justify-center">
                        <span class="font-bold">{{$key + 1}}</span>
                    </div>
                    <div class="ml-6">
                        <p class="text-lg font-semibold">{{$item->desc}}</p>
                        <p class="text-sm text-gray-600">{{$item->date}} - {{$item->location ?? '-'}}</p>
                    </div>
                </li>
                @endif
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Kembali ke Daftar -->
    <div class="text-right">
        <a href="/managedonate"><button class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition duration-300">
            Kembali ke Daftar Pesanan
        </button></a>
    </div>
</div>
</main>
@endsection
