@extends('layouts.admin')

@section('content')
<div class="product-container">
    {{-- Header Product --}}
    <div class="product-header">
        <h1 class="product-title">Product Apartemen</h1>
        <div class="filter-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M6 12H18M10 18H14" stroke="#000080" stroke-width="2" stroke-linecap="round"/>
                <circle cx="6" cy="6" r="2" stroke="#000080" stroke-width="2"/>
                <circle cx="18" cy="12" r="2" stroke="#000080" stroke-width="2"/>
                <circle cx="12" cy="18" r="2" stroke="#000080" stroke-width="2"/>
            </svg>
        </div>
        <div class="product-divider"></div>
    </div>

    {{-- Filter Show Entries --}}
    <div class="table-controls">
        <div class="show-entries">
            <label>Show</label>
            <select id="showEntries" class="entries-select" onchange="changeEntries()">
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <label>entries</label>
        </div>
        <div class="search-box">
            <input type="text" id="searchInput" class="table-search" placeholder="Search...">
            <i class="fas fa-search search-table-icon"></i>
        </div>
        <div class="action-controls">
            <button class="add-btn" onclick="addProduct()">
                <i class="fas fa-plus"></i> Tambah Produk
            </button>
            <button class="refresh-btn" onclick="refreshData()">
                <i class="fas fa-sync-alt"></i>
            </button>
        </div>
    </div>

    {{-- Tabel Product --}}
    <div class="product-table-wrapper">
        <table class="product-table" id="productTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Unit</th>
                    <th>Nama Apartemen</th>
                    <th>Tipe</th>
                    <th>Luas (m²)</th>
                    <th>Harga/Bulan</th>
                    <th>Fasilitas</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <!-- Data akan diisi oleh JavaScript -->
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="pagination-wrapper">
        <div class="pagination-info" id="paginationInfo">
            Showing 1 to 10 of 25 entries
        </div>
        <div class="pagination-buttons" id="paginationButtons">
            <button class="page-btn" onclick="prevPage()" disabled>Previous</button>
            <button class="page-btn" onclick="nextPage()">Next</button>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Product -->
<div id="productModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="modalTitle">Tambah Produk</h2>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>
        <div class="modal-body">
            <form id="productForm">
                <input type="hidden" id="productId">
                <div class="form-row-modal">
                    <div class="form-group-modal">
                        <label>Kode Unit</label>
                        <input type="text" id="kode_unit" class="modal-input" required>
                    </div>
                    <div class="form-group-modal">
                        <label>Tipe Apartemen</label>
                        <select id="tipe" class="modal-input" required>
                            <option value="">Pilih Tipe</option>
                            <option value="Studio">Studio</option>
                            <option value="1 Bedroom">1 Bedroom</option>
                            <option value="2 Bedroom">2 Bedroom</option>
                            <option value="3 Bedroom">3 Bedroom</option>
                            <option value="Penthouse">Penthouse</option>
                        </select>
                    </div>
                </div>
                <div class="form-group-modal">
                    <label>Nama Apartemen</label>
                    <input type="text" id="nama" class="modal-input" required>
                </div>
                <div class="form-row-modal">
                    <div class="form-group-modal">
                        <label>Luas (m²)</label>
                        <input type="number" id="luas" class="modal-input" required>
                    </div>
                    <div class="form-group-modal">
                        <label>Harga/Bulan (Rp)</label>
                        <input type="number" id="harga" class="modal-input" required>
                    </div>
                </div>
                <div class="form-group-modal">
                    <label>Fasilitas</label>
                    <div class="fasilitas-group">
                        <label class="checkbox-label">
                            <input type="checkbox" value="AC"> AC
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" value="TV"> TV
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" value="Kulkas"> Kulkas
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" value="Water Heater"> Water Heater
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" value="Kitchen Set"> Kitchen Set
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" value="Wifi"> Wifi
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" value="Parking"> Parking
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" value="Swimming Pool"> Swimming Pool
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" value="Gym"> Gym
                        </label>
                    </div>
                </div>
                <div class="form-group-modal">
                    <label>Status</label>
                    <select id="status" class="modal-input" required>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Disewa">Disewa</option>
                        <option value="Maintenance">Maintenance</option>
                    </select>
                </div>
                <div class="form-group-modal">
                    <label>Deskripsi</label>
                    <textarea id="deskripsi" class="modal-input" rows="3" placeholder="Deskripsi apartemen..."></textarea>
                </div>
                <div class="modal-buttons">
                    <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
                    <button type="submit" class="btn-save">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Data dummy product apartemen
    let productData = [
        { 
            id: 'APT-001', 
            kode_unit: 'A-01', 
            nama: 'Apartemen Asia', 
            tipe: 'Studio', 
            luas: 35, 
            harga: 2500000, 
            fasilitas: ['AC', 'TV', 'Kulkas', 'Water Heater'],
            status: 'Tersedia',
            deskripsi: 'Apartemen nyaman dengan pemandangan kota'
        },
        { 
            id: 'APT-002', 
            kode_unit: 'A-02', 
            nama: 'Apartemen Asia', 
            tipe: '1 Bedroom', 
            luas: 45, 
            harga: 3200000, 
            fasilitas: ['AC', 'TV', 'Kulkas', 'Water Heater', 'Kitchen Set'],
            status: 'Disewa',
            deskripsi: 'Apartemen dengan 1 kamar tidur, cocok untuk pasangan'
        },
        { 
            id: 'APT-003', 
            kode_unit: 'E-01', 
            nama: 'Apartemen Europe', 
            tipe: '2 Bedroom', 
            luas: 65, 
            harga: 4500000, 
            fasilitas: ['AC', 'TV', 'Kulkas', 'Water Heater', 'Kitchen Set', 'Wifi'],
            status: 'Tersedia',
            deskripsi: 'Apartemen luas dengan 2 kamar tidur'
        },
        { 
            id: 'APT-004', 
            kode_unit: 'E-02', 
            nama: 'Apartemen Europe', 
            tipe: 'Studio', 
            luas: 38, 
            harga: 2800000, 
            fasilitas: ['AC', 'TV', 'Kulkas'],
            status: 'Maintenance',
            deskripsi: 'Sedang dalam perawatan'
        },
        { 
            id: 'APT-005', 
            kode_unit: 'AM-01', 
            nama: 'Apartemen America', 
            tipe: 'Penthouse', 
            luas: 120, 
            harga: 8500000, 
            fasilitas: ['AC', 'TV', 'Kulkas', 'Water Heater', 'Kitchen Set', 'Wifi', 'Parking', 'Swimming Pool', 'Gym'],
            status: 'Tersedia',
            deskripsi: 'Apartemen mewah di lantai atas dengan fasilitas lengkap'
        },
        { 
            id: 'APT-006', 
            kode_unit: 'AM-02', 
            nama: 'Apartemen America', 
            tipe: '1 Bedroom', 
            luas: 50, 
            harga: 3500000, 
            fasilitas: ['AC', 'TV', 'Kulkas', 'Water Heater', 'Kitchen Set', 'Wifi'],
            status: 'Tersedia',
            deskripsi: 'Apartemen modern dengan desain minimalis'
        },
        { 
            id: 'APT-007', 
            kode_unit: 'AF-01', 
            nama: 'Apartemen Africa', 
            tipe: 'Studio', 
            luas: 32, 
            harga: 2200000, 
            fasilitas: ['AC', 'TV', 'Kulkas'],
            status: 'Tersedia',
            deskripsi: 'Apartemen ekonomis dengan fasilitas dasar'
        },
        { 
            id: 'APT-008', 
            kode_unit: 'AF-02', 
            nama: 'Apartemen Africa', 
            tipe: '2 Bedroom', 
            luas: 70, 
            harga: 4800000, 
            fasilitas: ['AC', 'TV', 'Kulkas', 'Water Heater', 'Kitchen Set', 'Wifi', 'Parking'],
            status: 'Disewa',
            deskripsi: 'Apartemen keluarga dengan 2 kamar tidur'
        },
        { 
            id: 'APT-009', 
            kode_unit: 'AU-01', 
            nama: 'Apartemen Australia', 
            tipe: '1 Bedroom', 
            luas: 55, 
            harga: 3800000, 
            fasilitas: ['AC', 'TV', 'Kulkas', 'Water Heater', 'Kitchen Set', 'Wifi', 'Parking'],
            status: 'Tersedia',
            deskripsi: 'Apartemen dengan pemandangan taman'
        },
        { 
            id: 'APT-010', 
            kode_unit: 'AU-02', 
            nama: 'Apartemen Australia', 
            tipe: '3 Bedroom', 
            luas: 90, 
            harga: 6500000, 
            fasilitas: ['AC', 'TV', 'Kulkas', 'Water Heater', 'Kitchen Set', 'Wifi', 'Parking', 'Swimming Pool'],
            status: 'Tersedia',
            deskripsi: 'Apartemen besar cocok untuk keluarga'
        },
    ];

    let currentPage = 1;
    let entriesPerPage = 10;
    let searchTerm = '';

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(angka);
    }

    function getStatusBadge(status) {
        if (status === 'Tersedia') {
            return '<span class="status-badge available">Tersedia</span>';
        } else if (status === 'Disewa') {
            return '<span class="status-badge rented">Disewa</span>';
        } else {
            return '<span class="status-badge maintenance">Maintenance</span>';
        }
    }

    function renderTable() {
        // Filter data berdasarkan search
        let filteredData = productData.filter(item => 
            item.kode_unit.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.nama.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.tipe.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.status.toLowerCase().includes(searchTerm.toLowerCase())
        );

        const totalEntries = filteredData.length;
        const totalPages = Math.ceil(totalEntries / entriesPerPage);
        
        // Pagination
        const start = (currentPage - 1) * entriesPerPage;
        const end = start + entriesPerPage;
        const paginatedData = filteredData.slice(start, end);

        // Render table body
        const tbody = document.getElementById('tableBody');
        tbody.innerHTML = '';
        
        paginatedData.forEach((item, index) => {
            const row = tbody.insertRow();
            row.innerHTML = `
                <td>${start + index + 1}</td>
                <td>${item.kode_unit}</td>
                <td>${item.nama}</td>
                <td>${item.tipe}</td>
                <td>${item.luas} m²</td>
                <td>${formatRupiah(item.harga)}</td>
                <td>${item.fasilitas.slice(0, 3).join(', ')}${item.fasilitas.length > 3 ? '...' : ''}</td>
                <td>${getStatusBadge(item.status)}</td>
                <td>
                    <div class="action-buttons">
                        <button class="action-btn edit" onclick="editProduct('${item.id}')">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="action-btn delete" onclick="deleteProduct('${item.id}')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        <button class="action-btn view" onclick="viewProduct('${item.id}')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </td>
            `;
        });

        // Update pagination info
        const startEntry = totalEntries === 0 ? 0 : start + 1;
        const endEntry = Math.min(end, totalEntries);
        document.getElementById('paginationInfo').innerHTML = `Showing ${startEntry} to ${endEntry} of ${totalEntries} entries`;

        // Update pagination buttons
        const prevBtn = document.querySelector('.pagination-buttons button:first-child');
        const nextBtn = document.querySelector('.pagination-buttons button:last-child');
        
        prevBtn.disabled = currentPage === 1;
        nextBtn.disabled = currentPage === totalPages || totalPages === 0;
    }

    function changeEntries() {
        entriesPerPage = parseInt(document.getElementById('showEntries').value);
        currentPage = 1;
        renderTable();
    }

    function searchTable() {
        searchTerm = document.getElementById('searchInput').value;
        currentPage = 1;
        renderTable();
    }

    function prevPage() {
        if (currentPage > 1) {
            currentPage--;
            renderTable();
        }
    }

    function nextPage() {
        const totalEntries = productData.filter(item => 
            item.kode_unit.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.nama.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.tipe.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.status.toLowerCase().includes(searchTerm.toLowerCase())
        ).length;
        const totalPages = Math.ceil(totalEntries / entriesPerPage);
        
        if (currentPage < totalPages) {
            currentPage++;
            renderTable();
        }
    }

    function addProduct() {
        document.getElementById('modalTitle').innerText = 'Tambah Produk';
        document.getElementById('productForm').reset();
        document.getElementById('productId').value = '';
        // Reset checkboxes
        document.querySelectorAll('.checkbox-label input').forEach(cb => cb.checked = false);
        document.getElementById('productModal').style.display = 'block';
    }

    function editProduct(id) {
        const product = productData.find(item => item.id === id);
        if (product) {
            document.getElementById('modalTitle').innerText = 'Edit Produk';
            document.getElementById('productId').value = product.id;
            document.getElementById('kode_unit').value = product.kode_unit;
            document.getElementById('nama').value = product.nama;
            document.getElementById('tipe').value = product.tipe;
            document.getElementById('luas').value = product.luas;
            document.getElementById('harga').value = product.harga;
            document.getElementById('status').value = product.status;
            document.getElementById('deskripsi').value = product.deskripsi;
            
            // Set checkboxes
            document.querySelectorAll('.checkbox-label input').forEach(cb => {
                cb.checked = product.fasilitas.includes(cb.value);
            });
            
            document.getElementById('productModal').style.display = 'block';
        }
    }

    function viewProduct(id) {
        const product = productData.find(item => item.id === id);
        if (product) {
            alert(`Detail Produk:\n\nKode Unit: ${product.kode_unit}\nNama: ${product.nama}\nTipe: ${product.tipe}\nLuas: ${product.luas} m²\nHarga: ${formatRupiah(product.harga)}\nFasilitas: ${product.fasilitas.join(', ')}\nStatus: ${product.status}\nDeskripsi: ${product.deskripsi}`);
        }
    }

    function deleteProduct(id) {
        if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
            productData = productData.filter(item => item.id !== id);
            renderTable();
            alert('Produk berhasil dihapus!');
        }
    }

    function refreshData() {
        searchTerm = '';
        document.getElementById('searchInput').value = '';
        currentPage = 1;
        renderTable();
        alert('Data berhasil di-refresh!');
    }

    function closeModal() {
        document.getElementById('productModal').style.display = 'none';
    }

    // Handle form submit
    document.getElementById('productForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const productId = document.getElementById('productId').value;
        const kode_unit = document.getElementById('kode_unit').value;
        const nama = document.getElementById('nama').value;
        const tipe = document.getElementById('tipe').value;
        const luas = parseInt(document.getElementById('luas').value);
        const harga = parseInt(document.getElementById('harga').value);
        const status = document.getElementById('status').value;
        const deskripsi = document.getElementById('deskripsi').value;
        
        // Get selected fasilitas
        const fasilitas = [];
        document.querySelectorAll('.checkbox-label input:checked').forEach(cb => {
            fasilitas.push(cb.value);
        });
        
        if (productId) {
            // Edit existing product
            const index = productData.findIndex(item => item.id === productId);
            if (index !== -1) {
                productData[index] = {
                    ...productData[index],
                    kode_unit: kode_unit,
                    nama: nama,
                    tipe: tipe,
                    luas: luas,
                    harga: harga,
                    fasilitas: fasilitas,
                    status: status,
                    deskripsi: deskripsi
                };
                alert('Produk berhasil diupdate!');
            }
        } else {
            // Add new product
            const newId = `APT-${String(productData.length + 1).padStart(3, '0')}`;
            productData.push({
                id: newId,
                kode_unit: kode_unit,
                nama: nama,
                tipe: tipe,
                luas: luas,
                harga: harga,
                fasilitas: fasilitas,
                status: status,
                deskripsi: deskripsi
            });
            alert('Produk berhasil ditambahkan!');
        }
        
        closeModal();
        renderTable();
    });

    // Event listeners
    document.getElementById('showEntries').addEventListener('change', changeEntries);
    document.getElementById('searchInput').addEventListener('keyup', searchTable);

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('productModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }

    // Initial render
    renderTable();
</script>
@endsection

@push('styles')
<style>
/* ========================================
   PRODUCT PAGE
   ======================================== */

.product-container {
    position: relative;
    width: 100%;
    max-width: 1300px;
    margin: 0 auto;
    padding: 0 20px;
}

/* ========== HEADER ========== */
.product-header {
    position: relative;
    width: 100%;
    height: 50px;
    filter: drop-shadow(0px 2px 4px rgba(0, 0, 0, 0.25));
    margin-bottom: 30px;
}

.product-title {
    position: absolute;
    left: 2px;
    top: 0;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    font-size: 28px;
    line-height: 42px;
    color: #000080;
    margin: 0;
}

.filter-icon {
    position: absolute;
    right: 0;
    top: 11px;
    width: 20px;
    height: 20px;
    cursor: pointer;
}

.filter-icon svg {
    width: 20px;
    height: 20px;
}

.product-divider {
    position: absolute;
    width: 100%;
    left: 0;
    bottom: 0;
    border: 1px solid #000080;
}

/* ========== TABLE CONTROLS ========== */
.table-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 15px;
}

.show-entries {
    display: flex;
    align-items: center;
    gap: 8px;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    color: #333;
}

.entries-select {
    padding: 6px 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    background: #fff;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    cursor: pointer;
}

.search-box {
    position: relative;
}

.table-search {
    width: 250px;
    padding: 8px 12px 8px 35px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
}

.search-table-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #999;
    font-size: 14px;
}

.action-controls {
    display: flex;
    gap: 10px;
}

.add-btn {
    padding: 6px 14px;
    background: #000080;
    color: white;
    border: none;
    border-radius: 6px;
    font-family: 'Poppins', sans-serif;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.add-btn:hover {
    background: #0000a0;
    transform: scale(1.02);
}

.refresh-btn {
    padding: 6px 12px;
    background: #6c757d;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.refresh-btn:hover {
    background: #5a6268;
}

/* ========== TABLE ========== */
.product-table-wrapper {
    background: #FFFFFF;
    border-radius: 8px;
    overflow-x: auto;
    border: 1px solid #E0E0E0;
}

.product-table {
    width: 100%;
    border-collapse: collapse;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
}

.product-table thead tr {
    background: #F8F9FA;
    border-bottom: 2px solid #E0E0E0;
}

.product-table th {
    text-align: left;
    padding: 12px 16px;
    font-weight: 600;
    font-size: 14px;
    color: #495057;
    background: #F8F9FA;
}

.product-table td {
    padding: 12px 16px;
    font-weight: 400;
    font-size: 14px;
    color: #212529;
    border-bottom: 1px solid #E0E0E0;
}

.product-table tbody tr:hover {
    background: #F8F9FA;
}

/* Status Badges */
.status-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    font-size: 12px;
    text-align: center;
}

.status-badge.available {
    background: #28a745;
    color: #FFFFFF;
}

.status-badge.rented {
    background: #dc3545;
    color: #FFFFFF;
}

.status-badge.maintenance {
    background: #ffc107;
    color: #212529;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 8px;
}

.action-btn {
    background: transparent;
    border: none;
    cursor: pointer;
    padding: 6px;
    border-radius: 4px;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.action-btn.edit {
    color: #ffc107;
}
.action-btn.edit:hover {
    background: rgba(255, 193, 7, 0.1);
}

.action-btn.delete {
    color: #dc3545;
}
.action-btn.delete:hover {
    background: rgba(220, 53, 69, 0.1);
}

.action-btn.view {
    color: #17a2b8;
}
.action-btn.view:hover {
    background: rgba(23, 162, 184, 0.1);
}

.action-btn i {
    font-size: 16px;
}

/* ========== PAGINATION ========== */
.pagination-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
    flex-wrap: wrap;
    gap: 15px;
}

.pagination-info {
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    color: #6c757d;
}

.pagination-buttons {
    display: flex;
    gap: 8px;
}

.page-btn {
    padding: 6px 14px;
    border: 1px solid #ddd;
    background: #fff;
    border-radius: 6px;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.page-btn:hover:not(:disabled) {
    background: #f0f0f0;
    border-color: #000080;
    color: #000080;
}

.page-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* ========== MODAL ========== */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
}

.modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 0;
    border-radius: 8px;
    width: 600px;
    max-width: 90%;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    animation: modalSlideIn 0.3s ease;
}

@keyframes modalSlideIn {
    from {
        transform: translateY(-50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.modal-header {
    padding: 15px 20px;
    background: #000080;
    color: white;
    border-radius: 8px 8px 0 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h2 {
    margin: 0;
    font-size: 20px;
}

.close {
    color: white;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

.close:hover {
    opacity: 0.7;
}

.modal-body {
    padding: 20px;
}

.form-row-modal {
    display: flex;
    gap: 15px;
    margin-bottom: 15px;
}

.form-group-modal {
    flex: 1;
    margin-bottom: 15px;
}

.form-group-modal label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
    color: #333;
}

.modal-input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
}

.modal-input:focus {
    outline: none;
    border-color: #000080;
}

textarea.modal-input {
    resize: vertical;
}

.fasilitas-group {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 6px;
    background: #f9f9f9;
}

.checkbox-label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    cursor: pointer;
}

.modal-buttons {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 20px;
}

.btn-cancel {
    padding: 8px 16px;
    background: #6c757d;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

.btn-save {
    padding: 8px 16px;
    background: #000080;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

.btn-cancel:hover {
    background: #5a6268;
}

.btn-save:hover {
    background: #0000a0;
}

/* ========== RESPONSIVE ========== */
@media (max-width: 768px) {
    .product-container {
        padding: 0 15px;
    }
    
    .product-title {
        font-size: 22px;
        line-height: 33px;
    }
    
    .filter-icon {
        top: 7px;
    }
    
    .table-controls {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .search-box {
        width: 100%;
    }
    
    .table-search {
        width: 100%;
    }
    
    .action-controls {
        width: 100%;
        justify-content: space-between;
    }
    
    .add-btn {
        flex: 1;
        justify-content: center;
    }
    
    .product-table th,
    .product-table td {
        padding: 8px 12px;
        font-size: 12px;
    }
    
    .pagination-wrapper {
        flex-direction: column;
        align-items: center;
    }
    
    .form-row-modal {
        flex-direction: column;
        gap: 0;
    }
    
    .fasilitas-group {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .modal-content {
        width: 95%;
        margin: 20% auto;
    }
}

@media (max-width: 576px) {
    .product-table th,
    .product-table td {
        padding: 6px 10px;
        font-size: 11px;
    }
    
    .action-btn i {
        font-size: 14px;
    }
    
    .fasilitas-group {
        grid-template-columns: 1fr;
    }
}
</style>
@endpush