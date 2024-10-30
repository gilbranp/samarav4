@extends('frontend.layout.main')
@section('content')




<!-- Halaman Donasi -->
<section id="donate" class="py-16 bg-green-600 text-white">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-center mb-8">Donasi Sekarang</h2>
        <p class="text-lg md:text-xl text-center mb-12">Mari bersama membantu mereka yang membutuhkan. Setiap kontribusi sangat berarti untuk mewujudkan dunia tanpa kelaparan.</p>

        <div class="bg-white text-gray-800 p-8 rounded-lg shadow-2xl max-w-lg mx-auto">
            <form id="donationForm" action="{{ route('donate.store') }}" method="POST">
                @csrf
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                        <p class="font-bold">Berhasil!</p>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
                <div class="mb-6">
                    <label for="name" class="block text-lg font-semibold mb-2">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>

                <div class="mb-6">
                    <label for="phone" class="block text-lg font-semibold mb-2">Nomor Telepon</label>
                    <input type="number" id="phone" name="phone" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>

                <div class="mb-6">
                    <label for="donation_type" class="block text-lg font-semibold mb-2">Jenis Donasi</label>
                    <select id="donation_type" name="donation_type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="">Pilih jenis donasi</option>
                        <option value="uang">Uang</option>
                        <option value="barang">Barang</option>
                    </select>
                </div>

                <div id="amount_input" class="mb-6 hidden">
                    <label for="amount" class="block text-lg font-semibold mb-2">Jumlah Donasi (IDR)</label>
                    <input type="number" id="amount" name="amount" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>

                <div id="item_input" class="hidden">
                    <div class="mb-6">
                        <label for="item_name" class="block text-lg font-semibold mb-2">Nama Barang</label>
                        <input type="text" id="item_name" name="item_name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div class="mb-6">
                        <label for="item_qty" class="block text-lg font-semibold mb-2">Jumlah Barang</label>
                        <input type="number" id="item_qty" name="item_qty" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>

                    <div class="mb-6">
                        <label for="expired_date" class="block text-lg font-semibold mb-2">Perkiraan Kadaluarsa</label>
                        <input type="date" id="expired_date" name="expired_date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                </div>

                <div class="mb-6">
                    <label for="courier_id" class="block text-lg font-semibold mb-2">Kurir</label>
                    <select id="courier_id" name="courier_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="">Pilih jenis kurir</option>
                        <option value="jne">JNE Express</option>
                        <option value="pos">Pos Indonesia</option>
                        <option value="jnt">J&T Express</option>
                        <option value="jnt_cargo">J&T Cargo</option>
                        <option value="sicepat">SiCepat</option>
                        <option value="tiki">TIKI</option>
                        <option value="anteraja">AnterAja</option>
                        <option value="wahana">Wahana</option>
                        <option value="ninja">Nija Express</option>
                        <option value="lion">Lion Parcel</option>
                        <option value="pcp">PCP Express</option>
                        <option value="jet">JET Express</option>
                        <option value="spx">Shopee Express</option>
                        <option value="sap">SAP Express</option>
                        <option value="kurir_tokopedia">Kurir Rekomendasi</option>
                        <option value="lex">Lazada Express</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="awb" class="block text-lg font-semibold mb-2">Nomor Resi</label>
                    <input id="awb" name="awb" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"></input>
                </div>

                <div class="mb-6">
                    <label for="message" class="block text-lg font-semibold mb-2">Pesan (Opsional)</label>
                    <textarea id="message" name="message" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                </div>

                <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 rounded-lg hover:bg-green-700 transition duration-300">Donasi Sekarang</button>
            </form>
        </div>
    </div>
</section>

<!-- Notifikasi menggunakan modal -->
<div id="loginModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <p class="text-lg text-gray-800 mb-4">Anda harus login terlebih dahulu untuk melakukan donasi.</p>
        <div class="flex justify-end">
            <button id="loginBtn" class="bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700">Login</button>
            <button id="closeModal" class="ml-4 bg-gray-600 text-white py-2 px-4 rounded hover:bg-gray-700">Tutup</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let isAuthenticated = @json(Auth::check());
    const form = document.getElementById('donationForm');
    const modal = document.getElementById('loginModal');
    const loginBtn = document.getElementById('loginBtn');
    const closeModal = document.getElementById('closeModal');
    
    const donationTypeSelect = document.getElementById('donation_type');
    const amountInput = document.getElementById('amount_input');
    const itemInput = document.getElementById('item_input');
    const amountField = document.getElementById('amount');
    const itemNameField = document.getElementById('item_name');
    const itemQtyField = document.getElementById('item_qty');

    form.addEventListener('submit', function(event) {
        if (!isAuthenticated) {
            event.preventDefault();
            modal.classList.remove('hidden');
        }
    });

    loginBtn.addEventListener('click', function() {
        window.location.href = '/login';
    });

    closeModal.addEventListener('click', function() {
        modal.classList.add('hidden');
    });

    donationTypeSelect.addEventListener('change', function() {
        const selectedValue = this.value;

        if (selectedValue === 'uang') {
            amountInput.classList.remove('hidden');
            itemInput.classList.add('hidden');
            amountField.setAttribute('required', 'required');
            itemNameField.removeAttribute('required');
            itemQtyField.removeAttribute('required');
        } else if (selectedValue === 'barang') {
            itemInput.classList.remove('hidden');
            amountInput.classList.add('hidden');
            itemNameField.setAttribute('required', 'required');
            itemQtyField.setAttribute('required', 'required');
            amountField.removeAttribute('required');
        } else {
            amountInput.classList.add('hidden');
            itemInput.classList.add('hidden');
            amountField.removeAttribute('required');
            itemNameField.removeAttribute('required');
            itemQtyField.removeAttribute('required');
        }
    });
});

</script>

@endsection
