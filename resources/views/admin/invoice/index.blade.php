@extends('layouts.admin')

@section('content')
<div class="invoice-container">
    {{-- Header Invoice --}}
    <div class="invoice-header">
        <h1 class="invoice-title">Invoice</h1>
        <div class="filter-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M6 12H18M10 18H14" stroke="#000080" stroke-width="2" stroke-linecap="round"/>
                <circle cx="6" cy="6" r="2" stroke="#000080" stroke-width="2"/>
                <circle cx="18" cy="12" r="2" stroke="#000080" stroke-width="2"/>
                <circle cx="12" cy="18" r="2" stroke="#000080" stroke-width="2"/>
            </svg>
        </div>
        <div class="invoice-divider"></div>
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
        <div class="export-buttons">
            <button class="export-btn pdf" onclick="exportPDF()">
                <i class="fas fa-file-pdf"></i> PDF
            </button>
            <button class="export-btn excel" onclick="exportExcel()">
                <i class="fas fa-file-excel"></i> Excel
            </button>
            <button class="export-btn print" onclick="printInvoice()">
                <i class="fas fa-print"></i> Print
            </button>
        </div>
    </div>

    {{-- Tabel Invoice --}}
    <div class="invoice-table-wrapper">
        <table class="invoice-table" id="invoiceTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Invoice</th>
                    <th>Tanggal</th>
                    <th>Nama Customer</th>
                    <th>Unit</th>
                    <th>Total Harga</th>
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

<!-- Modal Detail Invoice -->
<div id="invoiceModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Detail Invoice</h2>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>
        <div class="modal-body" id="modalBody">
            <!-- Detail invoice akan diisi -->
        </div>
    </div>
</div>

<script>
    // Data dummy invoice
    const invoiceData = [
        { no_invoice: 'INV-2024-001', tanggal: '2024-01-15', nama: 'John Doe', unit: 'Apartment Asia', total: 2500000, status: 'Lunas' },
        { no_invoice: 'INV-2024-002', tanggal: '2024-01-20', nama: 'Jane Smith', unit: 'Apartment Europe', total: 3200000, status: 'Pending' },
        { no_invoice: 'INV-2024-003', tanggal: '2024-02-05', nama: 'Michael Brown', unit: 'Apartment America', total: 2800000, status: 'Lunas' },
        { no_invoice: 'INV-2024-004', tanggal: '2024-02-18', nama: 'Sarah Wilson', unit: 'Apartment Africa', total: 3500000, status: 'Lunas' },
        { no_invoice: 'INV-2024-005', tanggal: '2024-03-10', nama: 'David Lee', unit: 'Apartment Australia', total: 4200000, status: 'Pending' },
        { no_invoice: 'INV-2024-006', tanggal: '2024-03-22', nama: 'Emily Chen', unit: 'Apartment Asia', total: 2700000, status: 'Lunas' },
        { no_invoice: 'INV-2024-007', tanggal: '2024-04-01', nama: 'James Wong', unit: 'Apartment Europe', total: 3100000, status: 'Pending' },
        { no_invoice: 'INV-2024-008', tanggal: '2024-04-14', nama: 'Linda Tan', unit: 'Apartment America', total: 2900000, status: 'Lunas' },
        { no_invoice: 'INV-2024-009', tanggal: '2024-05-02', nama: 'Robert Kim', unit: 'Apartment Africa', total: 3800000, status: 'Lunas' },
        { no_invoice: 'INV-2024-010', tanggal: '2024-05-19', nama: 'Patricia Lim', unit: 'Apartment Australia', total: 4000000, status: 'Pending' },
        { no_invoice: 'INV-2024-011', tanggal: '2024-06-07', nama: 'Kevin Ng', unit: 'Apartment Asia', total: 2600000, status: 'Lunas' },
        { no_invoice: 'INV-2024-012', tanggal: '2024-06-21', nama: 'Angela Goh', unit: 'Apartment Europe', total: 3300000, status: 'Pending' },
        { no_invoice: 'INV-2024-013', tanggal: '2024-07-03', nama: 'Brian Foo', unit: 'Apartment America', total: 3000000, status: 'Lunas' },
        { no_invoice: 'INV-2024-014', tanggal: '2024-07-17', nama: 'Cynthia Lau', unit: 'Apartment Africa', total: 3600000, status: 'Lunas' },
        { no_invoice: 'INV-2024-015', tanggal: '2024-08-05', nama: 'Dennis Chua', unit: 'Apartment Australia', total: 4400000, status: 'Pending' },
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
        if (status === 'Lunas') {
            return '<span class="status-badge paid">Lunas</span>';
        } else {
            return '<span class="status-badge unpaid">Pending</span>';
        }
    }

    function showDetail(no_invoice) {
        const invoice = invoiceData.find(item => item.no_invoice === no_invoice);
        if (invoice) {
            const modalBody = document.getElementById('modalBody');
            modalBody.innerHTML = `
                <div class="detail-invoice">
                    <div class="detail-row">
                        <strong>No Invoice:</strong> ${invoice.no_invoice}
                    </div>
                    <div class="detail-row">
                        <strong>Tanggal:</strong> ${invoice.tanggal}
                    </div>
                    <div class="detail-row">
                        <strong>Nama Customer:</strong> ${invoice.nama}
                    </div>
                    <div class="detail-row">
                        <strong>Unit:</strong> ${invoice.unit}
                    </div>
                    <div class="detail-row">
                        <strong>Total Harga:</strong> ${formatRupiah(invoice.total)}
                    </div>
                    <div class="detail-row">
                        <strong>Status:</strong> ${getStatusBadge(invoice.status)}
                    </div>
                    <div class="detail-row">
                        <strong>Tanggal Jatuh Tempo:</strong> ${getDueDate(invoice.tanggal)}
                    </div>
                </div>
            `;
            document.getElementById('invoiceModal').style.display = 'block';
        }
    }

    function getDueDate(tanggal) {
        let date = new Date(tanggal);
        date.setDate(date.getDate() + 14);
        return date.toISOString().split('T')[0];
    }

    function closeModal() {
        document.getElementById('invoiceModal').style.display = 'none';
    }

    function renderTable() {
        // Filter data berdasarkan search
        let filteredData = invoiceData.filter(item => 
            item.no_invoice.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.nama.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.unit.toLowerCase().includes(searchTerm.toLowerCase()) ||
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
                <td>${item.no_invoice}</td>
                <td>${item.tanggal}</td>
                <td>${item.nama}</td>
                <td>${item.unit}</td>
                <td>${formatRupiah(item.total)}</td>
                <td>${getStatusBadge(item.status)}</td>
                <td>
                    <div class="action-buttons">
                        <button class="action-btn view" onclick="showDetail('${item.no_invoice}')">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="action-btn download" onclick="downloadInvoice('${item.no_invoice}')">
                            <i class="fas fa-download"></i>
                        </button>
                        <button class="action-btn print" onclick="printSingleInvoice('${item.no_invoice}')">
                            <i class="fas fa-print"></i>
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
        const totalEntries = invoiceData.filter(item => 
            item.no_invoice.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.nama.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.unit.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.status.toLowerCase().includes(searchTerm.toLowerCase())
        ).length;
        const totalPages = Math.ceil(totalEntries / entriesPerPage);
        
        if (currentPage < totalPages) {
            currentPage++;
            renderTable();
        }
    }

    function downloadInvoice(no_invoice) {
        alert('Download invoice: ' + no_invoice);
    }

    function printSingleInvoice(no_invoice) {
        alert('Print invoice: ' + no_invoice);
    }

    function exportPDF() {
        alert('Export to PDF');
    }

    function exportExcel() {
        alert('Export to Excel');
    }

    function printInvoice() {
        window.print();
    }

    // Event listeners
    document.getElementById('showEntries').addEventListener('change', changeEntries);
    document.getElementById('searchInput').addEventListener('keyup', searchTable);

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('invoiceModal');
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
   INVOICE PAGE
   ======================================== */

.invoice-container {
    position: relative;
    width: 100%;
    max-width: 1300px;
    margin: 0 auto;
    padding: 0 20px;
}

/* ========== HEADER ========== */
.invoice-header {
    position: relative;
    width: 100%;
    height: 50px;
    filter: drop-shadow(0px 2px 4px rgba(0, 0, 0, 0.25));
    margin-bottom: 30px;
}

.invoice-title {
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

.invoice-divider {
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

.export-buttons {
    display: flex;
    gap: 10px;
}

.export-btn {
    padding: 6px 14px;
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

.export-btn.pdf {
    background: #dc3545;
    color: white;
}

.export-btn.pdf:hover {
    background: #c82333;
}

.export-btn.excel {
    background: #28a745;
    color: white;
}

.export-btn.excel:hover {
    background: #218838;
}

.export-btn.print {
    background: #17a2b8;
    color: white;
}

.export-btn.print:hover {
    background: #138496;
}

/* ========== TABLE ========== */
.invoice-table-wrapper {
    background: #FFFFFF;
    border-radius: 8px;
    overflow-x: auto;
    border: 1px solid #E0E0E0;
}

.invoice-table {
    width: 100%;
    border-collapse: collapse;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
}

.invoice-table thead tr {
    background: #F8F9FA;
    border-bottom: 2px solid #E0E0E0;
}

.invoice-table th {
    text-align: left;
    padding: 12px 16px;
    font-weight: 600;
    font-size: 14px;
    color: #495057;
    background: #F8F9FA;
}

.invoice-table td {
    padding: 12px 16px;
    font-weight: 400;
    font-size: 14px;
    color: #212529;
    border-bottom: 1px solid #E0E0E0;
}

.invoice-table tbody tr:hover {
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

.status-badge.paid {
    background: #28a745;
    color: #FFFFFF;
}

.status-badge.unpaid {
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

.action-btn.view {
    color: #17a2b8;
}
.action-btn.view:hover {
    background: rgba(23, 162, 184, 0.1);
}

.action-btn.download {
    color: #28a745;
}
.action-btn.download:hover {
    background: rgba(40, 167, 69, 0.1);
}

.action-btn.print {
    color: #6c757d;
}
.action-btn.print:hover {
    background: rgba(108, 117, 125, 0.1);
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
    margin: 10% auto;
    padding: 0;
    border-radius: 8px;
    width: 500px;
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

.detail-invoice {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.detail-row {
    padding: 8px 0;
    border-bottom: 1px solid #eee;
}

.detail-row strong {
    display: inline-block;
    width: 140px;
    color: #495057;
}

/* ========== PRINT STYLES ========== */
@media print {
    .table-controls,
    .pagination-wrapper,
    .export-buttons,
    .filter-icon,
    .action-buttons {
        display: none !important;
    }
    
    .invoice-container {
        padding: 0;
        margin: 0;
    }
    
    .invoice-table {
        width: 100%;
    }
}

/* ========== RESPONSIVE ========== */
@media (max-width: 768px) {
    .invoice-container {
        padding: 0 15px;
    }
    
    .invoice-title {
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
    
    .export-buttons {
        width: 100%;
        justify-content: space-between;
    }
    
    .export-btn {
        flex: 1;
        justify-content: center;
    }
    
    .invoice-table th,
    .invoice-table td {
        padding: 8px 12px;
        font-size: 12px;
    }
    
    .pagination-wrapper {
        flex-direction: column;
        align-items: center;
    }
    
    .modal-content {
        width: 95%;
        margin: 20% auto;
    }
}

@media (max-width: 576px) {
    .invoice-table th,
    .invoice-table td {
        padding: 6px 10px;
        font-size: 11px;
    }
    
    .action-btn i {
        font-size: 14px;
    }
    
    .detail-row strong {
        width: 120px;
        font-size: 13px;
    }
}
</style>
@endpush