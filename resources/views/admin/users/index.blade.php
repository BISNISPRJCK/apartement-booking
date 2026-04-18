@extends('layouts.admin')

@section('content')
<div class="user-container">
    {{-- Header User --}}
    <div class="user-header">
        <h1 class="user-title">Data User</h1>
        <div class="filter-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M6 12H18M10 18H14" stroke="#000080" stroke-width="2" stroke-linecap="round"/>
                <circle cx="6" cy="6" r="2" stroke="#000080" stroke-width="2"/>
                <circle cx="18" cy="12" r="2" stroke="#000080" stroke-width="2"/>
                <circle cx="12" cy="18" r="2" stroke="#000080" stroke-width="2"/>
            </svg>
        </div>
        <div class="user-divider"></div>
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
            <button class="add-btn" onclick="addUser()">
                <i class="fas fa-plus"></i> Tambah User
            </button>
            <button class="refresh-btn" onclick="refreshData()">
                <i class="fas fa-sync-alt"></i>
            </button>
        </div>
    </div>

    {{-- Tabel User --}}
    <div class="user-table-wrapper">
        <table class="user-table" id="userTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID User</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Terdaftar</th>
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

<!-- Modal Tambah/Edit User -->
<div id="userModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="modalTitle">Tambah User</h2>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>
        <div class="modal-body">
            <form id="userForm">
                <input type="hidden" id="userId">
                <div class="form-group-modal">
                    <label>Nama Lengkap</label>
                    <input type="text" id="nama" class="modal-input" required>
                </div>
                <div class="form-group-modal">
                    <label>Email</label>
                    <input type="email" id="email" class="modal-input" required>
                </div>
                <div class="form-group-modal">
                    <label>No HP</label>
                    <input type="text" id="no_hp" class="modal-input" required>
                </div>
                <div class="form-group-modal">
                    <label>Role</label>
                    <select id="role" class="modal-input" required>
                        <option value="">Pilih Role</option>
                        <option value="Admin">Admin</option>
                        <option value="Staff">Staff</option>
                        <option value="User">User</option>
                    </select>
                </div>
                <div class="form-group-modal">
                    <label>Status</label>
                    <select id="status" class="modal-input" required>
                        <option value="Aktif">Aktif</option>
                        <option value="Nonaktif">Nonaktif</option>
                    </select>
                </div>
                <div class="form-group-modal">
                    <label>Password</label>
                    <input type="password" id="password" class="modal-input" placeholder="Kosongkan jika tidak ingin mengubah">
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
    // Data dummy user
    let userData = [
        { id: 'USR-001', nama: 'John Doe', email: 'john@example.com', no_hp: '0811 3678 2234', role: 'Admin', status: 'Aktif', terdaftar: '2024-01-15' },
        { id: 'USR-002', nama: 'Jane Smith', email: 'jane@example.com', no_hp: '0812 3456 7890', role: 'Staff', status: 'Aktif', terdaftar: '2024-01-20' },
        { id: 'USR-003', nama: 'Michael Brown', email: 'michael@example.com', no_hp: '0813 4567 8901', role: 'User', status: 'Aktif', terdaftar: '2024-02-05' },
        { id: 'USR-004', nama: 'Sarah Wilson', email: 'sarah@example.com', no_hp: '0814 5678 9012', role: 'Staff', status: 'Nonaktif', terdaftar: '2024-02-18' },
        { id: 'USR-005', nama: 'David Lee', email: 'david@example.com', no_hp: '0815 6789 0123', role: 'Admin', status: 'Aktif', terdaftar: '2024-03-10' },
        { id: 'USR-006', nama: 'Emily Chen', email: 'emily@example.com', no_hp: '0816 7890 1234', role: 'User', status: 'Aktif', terdaftar: '2024-03-22' },
        { id: 'USR-007', nama: 'James Wong', email: 'james@example.com', no_hp: '0817 8901 2345', role: 'Staff', status: 'Aktif', terdaftar: '2024-04-01' },
        { id: 'USR-008', nama: 'Linda Tan', email: 'linda@example.com', no_hp: '0818 9012 3456', role: 'User', status: 'Nonaktif', terdaftar: '2024-04-14' },
        { id: 'USR-009', nama: 'Robert Kim', email: 'robert@example.com', no_hp: '0819 0123 4567', role: 'Admin', status: 'Aktif', terdaftar: '2024-05-02' },
        { id: 'USR-010', nama: 'Patricia Lim', email: 'patricia@example.com', no_hp: '0820 1234 5678', role: 'Staff', status: 'Aktif', terdaftar: '2024-05-19' },
        { id: 'USR-011', nama: 'Kevin Ng', email: 'kevin@example.com', no_hp: '0821 2345 6789', role: 'User', status: 'Aktif', terdaftar: '2024-06-07' },
        { id: 'USR-012', nama: 'Angela Goh', email: 'angela@example.com', no_hp: '0822 3456 7890', role: 'Staff', status: 'Nonaktif', terdaftar: '2024-06-21' },
        { id: 'USR-013', nama: 'Brian Foo', email: 'brian@example.com', no_hp: '0823 4567 8901', role: 'User', status: 'Aktif', terdaftar: '2024-07-03' },
        { id: 'USR-014', nama: 'Cynthia Lau', email: 'cynthia@example.com', no_hp: '0824 5678 9012', role: 'Admin', status: 'Aktif', terdaftar: '2024-07-17' },
        { id: 'USR-015', nama: 'Dennis Chua', email: 'dennis@example.com', no_hp: '0825 6789 0123', role: 'Staff', status: 'Aktif', terdaftar: '2024-08-05' },
    ];

    let currentPage = 1;
    let entriesPerPage = 10;
    let searchTerm = '';

    function getStatusBadge(status) {
        if (status === 'Aktif') {
            return '<span class="status-badge active">Aktif</span>';
        } else {
            return '<span class="status-badge inactive">Nonaktif</span>';
        }
    }

    function getRoleBadge(role) {
        if (role === 'Admin') {
            return '<span class="role-badge admin">Admin</span>';
        } else if (role === 'Staff') {
            return '<span class="role-badge staff">Staff</span>';
        } else {
            return '<span class="role-badge user">User</span>';
        }
    }

    function renderTable() {
        // Filter data berdasarkan search
        let filteredData = userData.filter(item => 
            item.nama.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.id.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.email.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.no_hp.includes(searchTerm) ||
            item.role.toLowerCase().includes(searchTerm.toLowerCase()) ||
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
                <td>${item.id}</td>
                <td>${item.nama}</td>
                <td>${item.email}</td>
                <td>${item.no_hp}</td>
                <td>${getRoleBadge(item.role)}</td>
                <td>${getStatusBadge(item.status)}</td>
                <td>${item.terdaftar}</td>
                <td>
                    <div class="action-buttons">
                        <button class="action-btn edit" onclick="editUser('${item.id}')">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="action-btn delete" onclick="deleteUser('${item.id}')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        <button class="action-btn view" onclick="viewUser('${item.id}')">
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
        const totalEntries = userData.filter(item => 
            item.nama.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.id.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.email.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.no_hp.includes(searchTerm) ||
            item.role.toLowerCase().includes(searchTerm.toLowerCase()) ||
            item.status.toLowerCase().includes(searchTerm.toLowerCase())
        ).length;
        const totalPages = Math.ceil(totalEntries / entriesPerPage);
        
        if (currentPage < totalPages) {
            currentPage++;
            renderTable();
        }
    }

    function addUser() {
        document.getElementById('modalTitle').innerText = 'Tambah User';
        document.getElementById('userForm').reset();
        document.getElementById('userId').value = '';
        document.getElementById('userModal').style.display = 'block';
    }

    function editUser(id) {
        const user = userData.find(item => item.id === id);
        if (user) {
            document.getElementById('modalTitle').innerText = 'Edit User';
            document.getElementById('userId').value = user.id;
            document.getElementById('nama').value = user.nama;
            document.getElementById('email').value = user.email;
            document.getElementById('no_hp').value = user.no_hp;
            document.getElementById('role').value = user.role;
            document.getElementById('status').value = user.status;
            document.getElementById('userModal').style.display = 'block';
        }
    }

    function viewUser(id) {
        const user = userData.find(item => item.id === id);
        if (user) {
            alert(`Detail User:\n\nID: ${user.id}\nNama: ${user.nama}\nEmail: ${user.email}\nNo HP: ${user.no_hp}\nRole: ${user.role}\nStatus: ${user.status}\nTerdaftar: ${user.terdaftar}`);
        }
    }

    function deleteUser(id) {
        if (confirm('Apakah Anda yakin ingin menghapus user ini?')) {
            userData = userData.filter(item => item.id !== id);
            renderTable();
            alert('User berhasil dihapus!');
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
        document.getElementById('userModal').style.display = 'none';
    }

    // Handle form submit
    document.getElementById('userForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const userId = document.getElementById('userId').value;
        const nama = document.getElementById('nama').value;
        const email = document.getElementById('email').value;
        const no_hp = document.getElementById('no_hp').value;
        const role = document.getElementById('role').value;
        const status = document.getElementById('status').value;
        
        if (userId) {
            // Edit existing user
            const index = userData.findIndex(item => item.id === userId);
            if (index !== -1) {
                userData[index] = {
                    ...userData[index],
                    nama: nama,
                    email: email,
                    no_hp: no_hp,
                    role: role,
                    status: status
                };
                alert('User berhasil diupdate!');
            }
        } else {
            // Add new user
            const newId = `USR-${String(userData.length + 1).padStart(3, '0')}`;
            const today = new Date().toISOString().split('T')[0];
            userData.push({
                id: newId,
                nama: nama,
                email: email,
                no_hp: no_hp,
                role: role,
                status: status,
                terdaftar: today
            });
            alert('User berhasil ditambahkan!');
        }
        
        closeModal();
        renderTable();
    });

    // Event listeners
    document.getElementById('showEntries').addEventListener('change', changeEntries);
    document.getElementById('searchInput').addEventListener('keyup', searchTable);

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('userModal');
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
   USER PAGE
   ======================================== */

.user-container {
    position: relative;
    width: 100%;
    max-width: 1300px;
    margin: 0 auto;
    padding: 0 20px;
}

/* ========== HEADER ========== */
.user-header {
    position: relative;
    width: 100%;
    height: 50px;
    filter: drop-shadow(0px 2px 4px rgba(0, 0, 0, 0.25));
    margin-bottom: 30px;
}

.user-title {
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

.user-divider {
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
.user-table-wrapper {
    background: #FFFFFF;
    border-radius: 8px;
    overflow-x: auto;
    border: 1px solid #E0E0E0;
}

.user-table {
    width: 100%;
    border-collapse: collapse;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
}

.user-table thead tr {
    background: #F8F9FA;
    border-bottom: 2px solid #E0E0E0;
}

.user-table th {
    text-align: left;
    padding: 12px 16px;
    font-weight: 600;
    font-size: 14px;
    color: #495057;
    background: #F8F9FA;
}

.user-table td {
    padding: 12px 16px;
    font-weight: 400;
    font-size: 14px;
    color: #212529;
    border-bottom: 1px solid #E0E0E0;
}

.user-table tbody tr:hover {
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

.status-badge.active {
    background: #28a745;
    color: #FFFFFF;
}

.status-badge.inactive {
    background: #dc3545;
    color: #FFFFFF;
}

/* Role Badges */
.role-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    font-size: 12px;
    text-align: center;
}

.role-badge.admin {
    background: #000080;
    color: #FFFFFF;
}

.role-badge.staff {
    background: #17a2b8;
    color: #FFFFFF;
}

.role-badge.user {
    background: #6c757d;
    color: #FFFFFF;
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

.form-group-modal {
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
    .user-container {
        padding: 0 15px;
    }
    
    .user-title {
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
    
    .user-table th,
    .user-table td {
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
    .user-table th,
    .user-table td {
        padding: 6px 10px;
        font-size: 11px;
    }
    
    .action-btn i {
        font-size: 14px;
    }
    
    .status-badge,
    .role-badge {
        padding: 2px 8px;
        font-size: 10px;
    }
}
</style>
@endpush