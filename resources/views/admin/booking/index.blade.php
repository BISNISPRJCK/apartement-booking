@extends('layouts.admin')

@section('content')
<div class="booking-container">
    {{-- Header Booking --}}
    <div class="booking-header">
        <h1 class="booking-title">Booking</h1>
        <div class="filter-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M6 12H18M10 18H14" stroke="#000080" stroke-width="2" stroke-linecap="round"/>
                <circle cx="6" cy="6" r="2" stroke="#000080" stroke-width="2"/>
                <circle cx="18" cy="12" r="2" stroke="#000080" stroke-width="2"/>
                <circle cx="12" cy="18" r="2" stroke="#000080" stroke-width="2"/>
            </svg>
        </div>
        <div class="booking-divider"></div>
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
    </div>

    {{-- Tabel Booking --}}
    <div class="booking-table-wrapper">
        <table class="booking-table" id="bookingTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Booking</th>
                    <th>Nama Customer</th>
                    <th>No HP</th>
                    <th>Unit</th>
                    <th>Pembayaran</th>
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

<script>
    // Data dummy booking
    const bookingData = [
        { id: 'B001', nama: 'John Doe', hp: '0811 3678 2234', unit: 'Apartment Asia', payment: 'pending' },
        { id: 'B002', nama: 'Jane Smith', hp: '0812 3456 7890', unit: 'Apartment Europe', payment: 'pending' },
        { id: 'B003', nama: 'Michael Brown', hp: '0813 4567 8901', unit: 'Apartment America', payment: 'pending' },
        { id: 'B004', nama: 'Sarah Wilson', hp: '0814 5678 9012', unit: 'Apartment Africa', payment: 'pending' },
        { id: 'B005', nama: 'David Lee', hp: '0815 6789 0123', unit: 'Apartment Australia', payment: 'pending' },
        { id: 'B006', nama: 'Emily Chen', hp: '0816 7890 1234', unit: 'Apartment Asia', payment: 'pending' },
        { id: 'B007', nama: 'James Wong', hp: '0817 8901 2345', unit: 'Apartment Europe', payment: 'pending' },
        { id: 'B008', nama: 'Linda Tan', hp: '0818 9012 3456', unit: 'Apartment America', payment: 'pending' },
        { id: 'B009', nama: 'Robert Kim', hp: '0819 0123 4567', unit: 'Apartment Africa', payment: 'pending' },
        { id: 'B010', nama: 'Patricia Lim', hp: '0820 1234 5678', unit: 'Apartment Australia', payment: 'pending' },
        { id: 'B011', nama: 'Kevin Ng', hp: '0821 2345 6789', unit: 'Apartment Asia', payment: 'pending' },
        { id: 'B012', nama: 'Angela Goh', hp: '0822 3456 7890', unit: 'Apartment Europe', payment: 'pending' },
        { id: 'B013', nama: 'Brian Foo', hp: '0823 4567 8901', unit: 'Apartment America', payment: 'pending' },
        { id: 'B014', nama: 'Cynthia Lau', hp: '0824 5678 9012', unit: 'Apartment Africa', payment: 'pending' },
        { id: 'B015', nama: 'Dennis Chua', hp: '0825 6789 0123', unit: 'Apartment Australia', payment: 'pending' },
    ];

    let currentPage = 1;
    let entriesPerPage = 10;
    let searchTerm = '';

    function getPaymentButtons(id) {
        return `
            <div class="payment-buttons">
                <button class="payment-btn accept" onclick="updatePayment('${id}', 'accept')">
                    Accept
                </button>
                <button class="payment-btn cancel" onclick="updatePayment('${id}', 'cancel')">
                    Cancel
                </button>
            </div>
        `;
    }

    function updatePayment(id, status) {
        const booking = bookingData.find(item => item.id === id);
        if (booking) {
            if (status === 'accept') {
                booking.payment = 'accept';
                alert(`Pembayaran untuk booking ${id} telah di-ACCEPT`);
            } else {
                booking.payment = 'cancel';
                alert(`Pembayaran untuk booking ${id} telah di-CANCEL`);
            }
            renderTable();
        }
    }

    function renderTable() {
        // Filter data berdasarkan search
        let filteredData = bookingData.filter(item => 
            item.nama.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.id.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.hp.includes(searchTerm) ||
            item.unit.toLowerCase().includes(searchTerm.toLowerCase())
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
                <td>${item.id}</td>
                <td>${item.nama}</td>
                <td>${item.hp}</td>
                <td>${item.unit}</td>
                <td>${getPaymentButtons(item.id)}</td>
                <td>
                    <button class="edit-btn" onclick="editBooking('${item.id}')">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M3 17.25V21H6.75L17.81 9.94L14.06 6.19L3 17.25Z" fill="#006CF9"/>
                            <path d="M20.71 5.63L18.37 3.29C18.14 3.06 17.8 3 17.55 3.16L15.3 4.71L19.29 8.7L20.71 7.29C21.1 6.9 21.1 6.27 20.71 5.63Z" fill="#006CF9"/>
                        </svg>
                    </button>
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
        const totalEntries = bookingData.filter(item => 
            item.nama.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.id.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.hp.includes(searchTerm) ||
            item.unit.toLowerCase().includes(searchTerm.toLowerCase())
        ).length;
        const totalPages = Math.ceil(totalEntries / entriesPerPage);
        
        if (currentPage < totalPages) {
            currentPage++;
            renderTable();
        }
    }

    function editBooking(id) {
        alert('Edit booking: ' + id);
    }

    // Event listeners
    document.getElementById('showEntries').addEventListener('change', changeEntries);
    document.getElementById('searchInput').addEventListener('keyup', searchTable);

    // Initial render
    renderTable();
</script>
@endsection

@push('styles')
<style>
/* ========================================
   BOOKING PAGE - SESUAI FIGMA
   ======================================== */

.booking-container {
    position: relative;
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* ========== HEADER ========== */
.booking-header {
    position: relative;
    width: 100%;
    height: 50px;
    filter: drop-shadow(0px 2px 4px rgba(0, 0, 0, 0.25));
    margin-bottom: 30px;
}

.booking-title {
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

.booking-divider {
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

/* ========== TABLE ========== */
.booking-table-wrapper {
    background: #FFFFFF;
    border-radius: 8px;
    overflow-x: auto;
    border: 1px solid #E0E0E0;
}

.booking-table {
    width: 100%;
    border-collapse: collapse;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
}

.booking-table thead tr {
    background: #F8F9FA;
    border-bottom: 2px solid #E0E0E0;
}

.booking-table th {
    text-align: left;
    padding: 12px 16px;
    font-weight: 600;
    font-size: 14px;
    color: #495057;
    background: #F8F9FA;
}

.booking-table td {
    padding: 12px 16px;
    font-weight: 400;
    font-size: 14px;
    color: #212529;
    border-bottom: 1px solid #E0E0E0;
}

.booking-table tbody tr:hover {
    background: #F8F9FA;
}

/* ========== PAYMENT BUTTONS ========== */
.payment-buttons {
    display: flex;
    gap: 10px;
}

.payment-btn {
    padding: 5px 16px;
    border-radius: 6px;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    font-size: 13px;
    cursor: pointer;
    transition: all 0.2s ease;
    border: none;
}

.payment-btn.accept {
    background: #28a745;
    color: #FFFFFF;
}

.payment-btn.accept:hover {
    background: #218838;
    transform: scale(1.02);
}

.payment-btn.cancel {
    background: #dc3545;
    color: #FFFFFF;
}

.payment-btn.cancel:hover {
    background: #c82333;
    transform: scale(1.02);
}

/* Edit Button */
.edit-btn {
    background: transparent;
    border: none;
    cursor: pointer;
    padding: 4px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
    border-radius: 4px;
}

.edit-btn:hover {
    background: rgba(0, 108, 249, 0.1);
    transform: scale(1.05);
}

.edit-btn svg {
    width: 20px;
    height: 20px;
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

/* ========== RESPONSIVE ========== */
@media (max-width: 768px) {
    .booking-container {
        padding: 0 15px;
    }
    
    .booking-title {
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
    
    .booking-table th,
    .booking-table td {
        padding: 8px 12px;
        font-size: 12px;
    }
    
    .payment-btn {
        padding: 3px 10px;
        font-size: 11px;
    }
    
    .payment-buttons {
        gap: 6px;
    }
    
    .pagination-wrapper {
        flex-direction: column;
        align-items: center;
    }
}

@media (max-width: 576px) {
    .booking-table th,
    .booking-table td {
        padding: 6px 10px;
        font-size: 11px;
    }
    
    .payment-btn {
        padding: 2px 8px;
        font-size: 10px;
    }
    
    .edit-btn svg {
        width: 16px;
        height: 16px;
    }
}
</style>
@endpush