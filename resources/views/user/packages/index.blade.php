@extends('adminlte::page')

@section('title', 'Packages')

@section('content_header')
<div class="packages-header-bar">

    <h1>Daftar Package</h1>

    <div class="header-actions" data-toggle="modal" data-target="#filterModal">
        <i class="fas fa-filter"></i>
    </div>

</div>
@stop
@section('content')
<div class="packages-wrapper">

    <div class="packages-container">

        <div class="row">

            {{-- CARD 1 --}}
            <div class="col-md-6 mb-4">
                <div class="package-item">

                    {{-- IMAGE --}}
                    <div class="package-image">
                        <img src="https://images.unsplash.com/photo-1501183638710-841dd1904471" alt="">
                    </div>

                    {{-- TYPE --}}
                    <div class="package-type">Tipe 1</div>

                    {{-- TITLE --}}
                    <div class="package-title">
                        Grand Asia Afrika Apartment
                    </div>

                    {{-- PRICE --}}
                    <div class="package-price">
                        Price IDR 100,000 - 500,000
                    </div>

                    {{-- BUTTON --}}
                   <div class="package-action">
                       <button 
                            class="btn btn-warning btn-view-detail"
                            data-toggle="modal"
                            data-target="#packageModal"
                            data-title="Luxury Villa Bandung"
                            data-type="Tipe 2"
                            data-price="IDR 500,000 - 1,000,000"
                            data-image="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267"
                            data-desc="Lorem ipsum dolor sit amet consectetur adipiscing elit..."
                        >
                            View Detail
                        </button>
                    </div>

                </div>
            </div>

            {{-- CARD 2 --}}
            <div class="col-md-6 mb-4">
                <div class="package-item">

                    <div class="package-image">
                        <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267" alt="">
                    </div>

                    <div class="package-type">Tipe 2</div>

                    <div class="package-title">
                        Luxury Villa Bandung
                    </div>

                    <div class="package-price">
                        Price IDR 500,000 - 1,000,000
                    </div>

                    <div class="package-action">
                        <button 
                            class="btn btn-warning btn-view-detail"
                            data-toggle="modal"
                            data-target="#packageModal"
                            data-title="Luxury Villa Bandung"
                            data-type="Tipe 2"
                            data-price="IDR 500,000 - 1,000,000"
                            data-image="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267"
                            data-desc="Lorem ipsum dolor sit amet consectetur adipiscing elit..."
                        >
                            View Detail
                        </button>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

<!-- Modal Wrapper WAJIB -->
<!-- Modal Detail Package (UKURAN DIPERKECIL) -->
<div class="modal fade" id="packageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content package-modal">

            <!-- Tombol Close -->
            <button type="button" class="modal-close-btn" data-dismiss="modal" aria-label="Close">
                ✕
            </button>

            <div class="modal-inner">

                {{-- LEFT SIDE --}}
                <div class="modal-left">
                    <img id="modalImage" class="modal-img" alt="Package Image">
                    
                    <div class="modal-desc">
                        <h4 class="desc-title">Description</h4>
                        <p id="modalDesc" class="desc-text"></p>
                    </div>
                </div>

                {{-- RIGHT SIDE --}}
                <div class="modal-right">

                    <!-- Tipe -->
                    <div class="type-text" id="modalType"></div>

                    <!-- Judul -->
                    <div class="title-text" id="modalTitle"></div>

                    <!-- Lokasi -->
                    <div class="location">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" stroke="rgba(115,115,115,0.5)" stroke-width="1.5"/>
                            <circle cx="12" cy="9" r="2.5" stroke="rgba(115,115,115,0.5)" stroke-width="1.5"/>
                        </svg>
                        <span>Jln Asia Afrika Bandung, Jawa Barat</span>
                    </div>

                    <!-- Fitur -->
                    <div class="features-title">Hotel Features</div>
                    <div class="features" id="modalFeatures">
                        <span>📶 Wifi</span>
                        <span>🛁 Bathtub</span>
                        <span>🏊 Pool</span>
                        <span>☕ Coffee</span>
                        <span>🛏️ King Bed</span>
                    </div>

                    <!-- Harga -->
                    <div class="price-box">
                        <div class="price-title">Price</div>
                        <div class="price-text" id="modalPrice"></div>
                    </div>

                    <!-- Form Booking -->
                    <div class="booking-box">
                        <div class="box checkin">
                            <label>Check in</label>
                            <input type="date" value="2026-12-12">
                        </div>
                        <div class="box checkout">
                            <label>Check Out</label>
                            <input type="date" value="2026-12-24">
                        </div>
                        <div class="box guest">
                            <label>Guest</label>
                            <select>
                                <option>1 Guest</option>
                                <option selected>2 Guest</option>
                                <option>3 Guest</option>
                                <option>4 Guest</option>
                            </select>
                        </div>
                    </div>

                    <!-- Tombol Booking -->
                    <button class="btn-booking">
                        Booking Now
                    </button>

                </div>

            </div>

        </div>
    </div>
</div>

<!-- Modal Filter -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-filter-dialog">
        <div class="modal-content filter-modal-content">

            <!-- Header Filter -->
            <div class="filter-header">
                <span class="filter-title">Filter</span>
                <button type="button" class="filter-close" data-dismiss="modal" aria-label="Close">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M1.5 1.5L16.5 16.5M16.5 1.5L1.5 16.5" stroke="white" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>

            <!-- Filter Body -->
            <div class="filter-body">

                <!-- Filter Type -->
                <div class="filter-group">
                    <div class="filter-label" id="typeLabel">
                        <span>All Types</span>
                        <svg class="arrow-icon" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M6 4L10 8L6 12" stroke="rgba(255,255,255,0.8)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="filter-options" id="typeOptions" style="display: none;">
                        <div class="filter-option" data-type="all">All Types</div>
                        <div class="filter-option" data-type="tipe1">Tipe 1</div>
                        <div class="filter-option" data-type="tipe2">Tipe 2</div>
                        <div class="filter-option" data-type="tipe3">Tipe 3</div>
                    </div>
                </div>

                <!-- Selected Type -->
                <div class="selected-filter" id="selectedType">
                    <span>Type A A</span>
                </div>

                <!-- Filter Price -->
                <div class="filter-group">
                    <div class="filter-label" id="priceLabel">
                        <span>All Price</span>
                        <svg class="arrow-icon" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M10 12L6 8L10 4" stroke="rgba(255,255,255,0.8)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="filter-options" id="priceOptions" style="display: none;">
                        <div class="filter-option" data-price="all">All Price</div>
                        <div class="filter-option" data-price="0-500000">IDR 0 - 500,000</div>
                        <div class="filter-option" data-price="500000-1000000">IDR 500,000 - 1,000,000</div>
                        <div class="filter-option" data-price="1000000-2000000">IDR 1,000,000 - 2,000,000</div>
                    </div>
                </div>

                <!-- Selected Price -->
                <div class="selected-filter" id="selectedPrice">
                    <span>Lates</span>
                </div>

            </div>

        </div>
    </div>
</div>
@stop


@push('js')
<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.btn-view-detail').forEach(btn => {
        btn.addEventListener('click', function () {

            document.getElementById('modalTitle').innerText = this.dataset.title || 'Grand Asia Afrika Apartement';
            document.getElementById('modalType').innerText = this.dataset.type || 'TIPE 1';
            document.getElementById('modalPrice').innerText = this.dataset.price || 'IDR 100,000 - 500,000';
            document.getElementById('modalImage').src = this.dataset.image || '/default-image.jpg';
            document.getElementById('modalDesc').innerText = this.dataset.desc || 'Yorem ipsum dolor sit amet, consectetur adipiscing elit.';

            // Optional: Update fitur dari data
            if (this.dataset.features) {
                const features = JSON.parse(this.dataset.features);
                const featuresContainer = document.getElementById('modalFeatures');
                if (featuresContainer && features.length) {
                    featuresContainer.innerHTML = features.map(f => `<span>${f}</span>`).join('');
                }
            }

        });
    });

});
</script>
@endpush

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function() {

    // =====================
    // FILTER MODAL LOGIC
    // =====================
    
    // Buka modal filter saat icon filter diklik
    const filterIcon = document.querySelector('.header-actions');
    if (filterIcon) {
        filterIcon.addEventListener('click', function() {
            $('#filterModal').modal('show');
        });
    }

    // Dropdown Type
    const typeLabel = document.getElementById('typeLabel');
    const typeOptions = document.getElementById('typeOptions');
    const selectedType = document.querySelector('#selectedType span');
    
    if (typeLabel) {
        typeLabel.addEventListener('click', function(e) {
            e.stopPropagation();
            // Tutup dropdown price jika terbuka
            if (priceOptions && priceOptions.style.display === 'block') {
                priceOptions.style.display = 'none';
                priceLabel.classList.remove('open');
            }
            // Toggle dropdown type
            const isOpen = typeOptions.style.display === 'block';
            typeOptions.style.display = isOpen ? 'none' : 'block';
            typeLabel.classList.toggle('open', !isOpen);
        });
    }
    
    // Dropdown Price
    const priceLabel = document.getElementById('priceLabel');
    const priceOptions = document.getElementById('priceOptions');
    const selectedPrice = document.querySelector('#selectedPrice span');
    
    if (priceLabel) {
        priceLabel.addEventListener('click', function(e) {
            e.stopPropagation();
            // Tutup dropdown type jika terbuka
            if (typeOptions && typeOptions.style.display === 'block') {
                typeOptions.style.display = 'none';
                typeLabel.classList.remove('open');
            }
            // Toggle dropdown price
            const isOpen = priceOptions.style.display === 'block';
            priceOptions.style.display = isOpen ? 'none' : 'block';
            priceLabel.classList.toggle('open', !isOpen);
        });
    }
    
    // Pilih option Type
    const typeOptionItems = document.querySelectorAll('.filter-option[data-type]');
    typeOptionItems.forEach(option => {
        option.addEventListener('click', function() {
            const selectedValue = this.textContent;
            if (selectedType) {
                selectedType.textContent = selectedValue;
            }
            // Tutup dropdown
            typeOptions.style.display = 'none';
            typeLabel.classList.remove('open');
            
            // Trigger filter (bisa ditambahkan logic filter packages)
            filterPackages();
        });
    });
    
    // Pilih option Price
    const priceOptionItems = document.querySelectorAll('.filter-option[data-price]');
    priceOptionItems.forEach(option => {
        option.addEventListener('click', function() {
            const selectedValue = this.textContent;
            if (selectedPrice) {
                selectedPrice.textContent = selectedValue;
            }
            // Tutup dropdown
            priceOptions.style.display = 'none';
            priceLabel.classList.remove('open');
            
            // Trigger filter (bisa ditambahkan logic filter packages)
            filterPackages();
        });
    });
    
    // Tutup dropdown saat klik di luar
    document.addEventListener('click', function(e) {
        if (typeOptions && typeOptions.style.display === 'block') {
            if (!typeLabel.contains(e.target) && !typeOptions.contains(e.target)) {
                typeOptions.style.display = 'none';
                typeLabel.classList.remove('open');
            }
        }
        if (priceOptions && priceOptions.style.display === 'block') {
            if (!priceLabel.contains(e.target) && !priceOptions.contains(e.target)) {
                priceOptions.style.display = 'none';
                priceLabel.classList.remove('open');
            }
        }
    });
    
    // Fungsi filter packages (implementasi sesuai kebutuhan)
    function filterPackages() {
        const selectedTypeValue = selectedType ? selectedType.textContent : 'All Types';
        const selectedPriceValue = selectedPrice ? selectedPrice.textContent : 'Lates';
        
        console.log('Filter by:', {
            type: selectedTypeValue,
            price: selectedPriceValue
        });
        
        // Di sini kamu bisa tambahkan logic untuk:
        // - Menyembunyikan/menampilkan package cards
        // - AJAX request ke server
        // - Dll
        
        // Contoh sederhana:
        const packages = document.querySelectorAll('.package-item');
        packages.forEach(pkg => {
            // Ambil type dan price dari card
            const pkgType = pkg.querySelector('.package-type')?.textContent || '';
            const pkgPrice = pkg.querySelector('.package-price')?.textContent || '';
            
            let showByType = true;
            let showByPrice = true;
            
            // Filter by type (kecuali "All Types" atau "All")
            if (selectedTypeValue !== 'All Types' && selectedTypeValue !== 'All') {
                showByType = pkgType === selectedTypeValue;
            }
            
            // Filter by price (sesuaikan dengan kebutuhan)
            if (selectedPriceValue !== 'All Price' && selectedPriceValue !== 'Lates') {
                // Logic filter price sesuai range
                showByPrice = true; // Implement sesuai kebutuhan
            }
            
            // Tampilkan atau sembunyikan card
            if (showByType && showByPrice) {
                pkg.closest('.col-md-6').style.display = 'block';
            } else {
                pkg.closest('.col-md-6').style.display = 'none';
            }
        });
    }
    
    // Reset filter (opsional)
    function resetFilter() {
        if (selectedType) selectedType.textContent = 'All Types';
        if (selectedPrice) selectedPrice.textContent = 'Lates';
        filterPackages();
    }

});
</script>
@endpush