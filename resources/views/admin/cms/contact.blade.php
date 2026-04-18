@extends('layouts.admin')

@section('content')
<div class="cms-container">
    {{-- Header CMS --}}
    <div class="cms-header">
        <h1 class="cms-title">CMS - Content Management</h1>
        <div class="filter-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M6 12H18M10 18H14" stroke="#000080" stroke-width="2" stroke-linecap="round"/>
                <circle cx="6" cy="6" r="2" stroke="#000080" stroke-width="2"/>
                <circle cx="18" cy="12" r="2" stroke="#000080" stroke-width="2"/>
                <circle cx="12" cy="18" r="2" stroke="#000080" stroke-width="2"/>
            </svg>
        </div>
        <div class="cms-divider"></div>
    </div>

    {{-- Tabs Navigation --}}
    <div class="cms-tabs">
        <button class="tab-btn active" onclick="showTab('contact')">Contact</button>
        <button class="tab-btn" onclick="showTab('about')">About</button>
        <button class="tab-btn" onclick="showTab('product')">Product CMS</button>
        <button class="tab-btn" onclick="showTab('booking')">Booking CMS</button>
        <button class="tab-btn" onclick="showTab('invoice')">Invoice CMS</button>
    </div>

    {{-- Tab Content --}}
    <div class="tab-content" id="contactTab">
        <div class="content-card">
            <div class="card-header">
                <h3>Kontak Kami</h3>
                <button class="save-btn" onclick="saveContent('contact')">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
            <div class="card-body">
                <form id="contactForm">
                    <div class="form-group-cms">
                        <label>Alamat</label>
                        <textarea id="contact_alamat" class="cms-textarea" rows="3">Jl. Sudirman No. 123, Jakarta Selatan, Indonesia</textarea>
                    </div>
                    <div class="form-row-cms">
                        <div class="form-group-cms">
                            <label>Telepon</label>
                            <input type="text" id="contact_telp" class="cms-input" value="(021) 1234 5678">
                        </div>
                        <div class="form-group-cms">
                            <label>WhatsApp</label>
                            <input type="text" id="contact_wa" class="cms-input" value="0812 3456 7890">
                        </div>
                    </div>
                    <div class="form-row-cms">
                        <div class="form-group-cms">
                            <label>Email</label>
                            <input type="email" id="contact_email" class="cms-input" value="info@vantixstay.com">
                        </div>
                        <div class="form-group-cms">
                            <label>Instagram</label>
                            <input type="text" id="contact_instagram" class="cms-input" value="@vantixstay">
                        </div>
                    </div>
                    <div class="form-row-cms">
                        <div class="form-group-cms">
                            <label>Facebook</label>
                            <input type="text" id="contact_facebook" class="cms-input" value="vantixstay">
                        </div>
                        <div class="form-group-cms">
                            <label>Twitter</label>
                            <input type="text" id="contact_twitter" class="cms-input" value="@vantixstay">
                        </div>
                    </div>
                    <div class="form-group-cms">
                        <label>Google Maps Embed</label>
                        <textarea id="contact_maps" class="cms-textarea" rows="4">&lt;iframe src="https://www.google.com/maps/embed?..." width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"&gt;&lt;/iframe&gt;</textarea>
                        <small class="form-text">Masukkan kode embed Google Maps</small>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="tab-content" id="aboutTab" style="display: none;">
        <div class="content-card">
            <div class="card-header">
                <h3>Tentang Kami</h3>
                <button class="save-btn" onclick="saveContent('about')">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
            <div class="card-body">
                <form id="aboutForm">
                    <div class="form-group-cms">
                        <label>Judul</label>
                        <input type="text" id="about_title" class="cms-input" value="Tentang Vantix Stay">
                    </div>
                    <div class="form-group-cms">
                        <label>Deskripsi</label>
                        <textarea id="about_description" class="cms-textarea" rows="6">Vantix Stay adalah penyedia layanan sewa apartemen terpercaya yang telah beroperasi sejak 2020. Kami menyediakan berbagai pilihan unit apartemen berkualitas dengan lokasi strategis di pusat kota. Dengan pelayanan profesional dan harga yang kompetitif, kami berkomitmen untuk memberikan pengalaman menginap yang nyaman dan berkesan bagi setiap pelanggan.</textarea>
                    </div>
                    <div class="form-group-cms">
                        <label>Visi</label>
                        <textarea id="about_visi" class="cms-textarea" rows="3">Menjadi penyedia layanan sewa apartemen terbaik di Indonesia dengan standar pelayanan internasional.</textarea>
                    </div>
                    <div class="form-group-cms">
                        <label>Misi</label>
                        <textarea id="about_misi" class="cms-textarea" rows="4">1. Menyediakan unit apartemen berkualitas dengan harga terjangkau
2. Memberikan pelayanan terbaik 24/7 untuk seluruh pelanggan
3. Terus berinovasi dalam meningkatkan kenyamanan hunian
4. Membangun kemitraan yang saling menguntungkan</textarea>
                    </div>
                    <div class="form-row-cms">
                        <div class="form-group-cms">
                            <label>Tahun Berdiri</label>
                            <input type="text" id="about_tahun" class="cms-input" value="2020">
                        </div>
                        <div class="form-group-cms">
                            <label>Jumlah Unit</label>
                            <input type="text" id="about_unit" class="cms-input" value="100+">
                        </div>
                    </div>
                    <div class="form-row-cms">
                        <div class="form-group-cms">
                            <label>Pelanggan Puas</label>
                            <input type="text" id="about_customer" class="cms-input" value="500+">
                        </div>
                        <div class="form-group-cms">
                            <label>Lokasi Strategis</label>
                            <input type="text" id="about_lokasi" class="cms-input" value="10+">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="tab-content" id="productTab" style="display: none;">
        <div class="content-card">
            <div class="card-header">
                <h3>Product CMS</h3>
                <button class="save-btn" onclick="saveContent('product')">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
            <div class="card-body">
                <form id="productCMSForm">
                    <div class="form-group-cms">
                        <label>Hero Section Title</label>
                        <input type="text" id="product_hero_title" class="cms-input" value="Temukan Apartemen Impian Anda">
                    </div>
                    <div class="form-group-cms">
                        <label>Hero Section Subtitle</label>
                        <textarea id="product_hero_subtitle" class="cms-textarea" rows="2">Nikmati kenyamanan tinggal di apartemen premium dengan fasilitas lengkap dan lokasi strategis</textarea>
                    </div>
                    <div class="form-group-cms">
                        <label>Featured Text</label>
                        <input type="text" id="product_featured" class="cms-input" value="Unit Terlaris Bulan Ini">
                    </div>
                    <div class="form-group-cms">
                        <label>Footer Copyright</label>
                        <input type="text" id="product_copyright" class="cms-input" value="Copyright 2026 by Vantix Stay. All Rights Reserved.">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="tab-content" id="bookingTab" style="display: none;">
        <div class="content-card">
            <div class="card-header">
                <h3>Booking CMS</h3>
                <button class="save-btn" onclick="saveContent('booking')">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
            <div class="card-body">
                <form id="bookingCMSForm">
                    <div class="form-group-cms">
                        <label>Booking Page Title</label>
                        <input type="text" id="booking_title" class="cms-input" value="Form Pemesanan Apartemen">
                    </div>
                    <div class="form-group-cms">
                        <label>Booking Description</label>
                        <textarea id="booking_description" class="cms-textarea" rows="3">Isi form di bawah ini untuk melakukan pemesanan unit apartemen. Tim kami akan segera menghubungi Anda maksimal 1x24 jam.</textarea>
                    </div>
                    <div class="form-group-cms">
                        <label>Terms & Conditions</label>
                        <textarea id="booking_terms" class="cms-textarea" rows="4">1. Pembayaran DP minimal 50% dari total harga sewa
2. Pembatalan H-7 mendapatkan refund 100%
3. Pembatalan H-3 mendapatkan refund 50%
4. Pembatalan H-1 tidak mendapatkan refund</textarea>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="tab-content" id="invoiceTab" style="display: none;">
        <div class="content-card">
            <div class="card-header">
                <h3>Invoice CMS</h3>
                <button class="save-btn" onclick="saveContent('invoice')">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
            <div class="card-body">
                <form id="invoiceCMSForm">
                    <div class="form-group-cms">
                        <label>Company Name</label>
                        <input type="text" id="invoice_company" class="cms-input" value="Vantix Stay">
                    </div>
                    <div class="form-group-cms">
                        <label>Company Address</label>
                        <textarea id="invoice_address" class="cms-textarea" rows="2">Jl. Sudirman No. 123, Jakarta Selatan, Indonesia</textarea>
                    </div>
                    <div class="form-row-cms">
                        <div class="form-group-cms">
                            <label>Company Phone</label>
                            <input type="text" id="invoice_phone" class="cms-input" value="(021) 1234 5678">
                        </div>
                        <div class="form-group-cms">
                            <label>Company Email</label>
                            <input type="email" id="invoice_email" class="cms-input" value="info@vantixstay.com">
                        </div>
                    </div>
                    <div class="form-group-cms">
                        <label>Bank Account</label>
                        <textarea id="invoice_bank" class="cms-textarea" rows="3">Bank BCA - 1234567890 a.n Vantix Stay
Bank Mandiri - 9876543210 a.n Vantix Stay
Bank BRI - 5555555555 a.n Vantix Stay</textarea>
                    </div>
                    <div class="form-group-cms">
                        <label>Invoice Footer Note</label>
                        <textarea id="invoice_footer" class="cms-textarea" rows="2">Terima kasih telah mempercayakan hunian Anda kepada Vantix Stay.</textarea>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function showTab(tabName) {
        // Hide all tabs
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.style.display = 'none';
        });
        
        // Remove active class from all buttons
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        
        // Show selected tab
        document.getElementById(`${tabName}Tab`).style.display = 'block';
        
        // Add active class to clicked button
        event.target.classList.add('active');
    }
    
    function saveContent(contentType) {
        let data = {};
        let message = '';
        
        switch(contentType) {
            case 'contact':
                data = {
                    alamat: document.getElementById('contact_alamat').value,
                    telp: document.getElementById('contact_telp').value,
                    wa: document.getElementById('contact_wa').value,
                    email: document.getElementById('contact_email').value,
                    instagram: document.getElementById('contact_instagram').value,
                    facebook: document.getElementById('contact_facebook').value,
                    twitter: document.getElementById('contact_twitter').value,
                    maps: document.getElementById('contact_maps').value
                };
                message = 'Kontak berhasil disimpan!';
                break;
                
            case 'about':
                data = {
                    title: document.getElementById('about_title').value,
                    description: document.getElementById('about_description').value,
                    visi: document.getElementById('about_visi').value,
                    misi: document.getElementById('about_misi').value,
                    tahun: document.getElementById('about_tahun').value,
                    unit: document.getElementById('about_unit').value,
                    customer: document.getElementById('about_customer').value,
                    lokasi: document.getElementById('about_lokasi').value
                };
                message = 'About berhasil disimpan!';
                break;
                
            case 'product':
                data = {
                    hero_title: document.getElementById('product_hero_title').value,
                    hero_subtitle: document.getElementById('product_hero_subtitle').value,
                    featured: document.getElementById('product_featured').value,
                    copyright: document.getElementById('product_copyright').value
                };
                message = 'Product CMS berhasil disimpan!';
                break;
                
            case 'booking':
                data = {
                    title: document.getElementById('booking_title').value,
                    description: document.getElementById('booking_description').value,
                    terms: document.getElementById('booking_terms').value
                };
                message = 'Booking CMS berhasil disimpan!';
                break;
                
            case 'invoice':
                data = {
                    company: document.getElementById('invoice_company').value,
                    address: document.getElementById('invoice_address').value,
                    phone: document.getElementById('invoice_phone').value,
                    email: document.getElementById('invoice_email').value,
                    bank: document.getElementById('invoice_bank').value,
                    footer: document.getElementById('invoice_footer').value
                };
                message = 'Invoice CMS berhasil disimpan!';
                break;
        }
        
        // Simpan ke localStorage untuk demo
        localStorage.setItem(`cms_${contentType}`, JSON.stringify(data));
        
        // Tampilkan notifikasi
        alert(message);
        
        // Optional: Kirim ke server via AJAX
        console.log(`Saved ${contentType}:`, data);
    }
    
    function loadContent() {
        // Load Contact
        const contactData = localStorage.getItem('cms_contact');
        if (contactData) {
            const data = JSON.parse(contactData);
            document.getElementById('contact_alamat').value = data.alamat;
            document.getElementById('contact_telp').value = data.telp;
            document.getElementById('contact_wa').value = data.wa;
            document.getElementById('contact_email').value = data.email;
            document.getElementById('contact_instagram').value = data.instagram;
            document.getElementById('contact_facebook').value = data.facebook;
            document.getElementById('contact_twitter').value = data.twitter;
            document.getElementById('contact_maps').value = data.maps;
        }
        
        // Load About
        const aboutData = localStorage.getItem('cms_about');
        if (aboutData) {
            const data = JSON.parse(aboutData);
            document.getElementById('about_title').value = data.title;
            document.getElementById('about_description').value = data.description;
            document.getElementById('about_visi').value = data.visi;
            document.getElementById('about_misi').value = data.misi;
            document.getElementById('about_tahun').value = data.tahun;
            document.getElementById('about_unit').value = data.unit;
            document.getElementById('about_customer').value = data.customer;
            document.getElementById('about_lokasi').value = data.lokasi;
        }
        
        // Load Product CMS
        const productData = localStorage.getItem('cms_product');
        if (productData) {
            const data = JSON.parse(productData);
            document.getElementById('product_hero_title').value = data.hero_title;
            document.getElementById('product_hero_subtitle').value = data.hero_subtitle;
            document.getElementById('product_featured').value = data.featured;
            document.getElementById('product_copyright').value = data.copyright;
        }
        
        // Load Booking CMS
        const bookingData = localStorage.getItem('cms_booking');
        if (bookingData) {
            const data = JSON.parse(bookingData);
            document.getElementById('booking_title').value = data.title;
            document.getElementById('booking_description').value = data.description;
            document.getElementById('booking_terms').value = data.terms;
        }
        
        // Load Invoice CMS
        const invoiceData = localStorage.getItem('cms_invoice');
        if (invoiceData) {
            const data = JSON.parse(invoiceData);
            document.getElementById('invoice_company').value = data.company;
            document.getElementById('invoice_address').value = data.address;
            document.getElementById('invoice_phone').value = data.phone;
            document.getElementById('invoice_email').value = data.email;
            document.getElementById('invoice_bank').value = data.bank;
            document.getElementById('invoice_footer').value = data.footer;
        }
    }
    
    // Load data saat halaman dimuat
    document.addEventListener('DOMContentLoaded', loadContent);
</script>
@endsection

@push('styles')
<style>
/* ========================================
   CMS PAGE
   ======================================== */

.cms-container {
    position: relative;
    width: 100%;
    max-width: 1000px;
    margin: 0 auto;
    padding: 0 20px;
}

/* ========== HEADER ========== */
.cms-header {
    position: relative;
    width: 100%;
    height: 50px;
    filter: drop-shadow(0px 2px 4px rgba(0, 0, 0, 0.25));
    margin-bottom: 30px;
}

.cms-title {
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

.cms-divider {
    position: absolute;
    width: 100%;
    left: 0;
    bottom: 0;
    border: 1px solid #000080;
}

/* ========== TABS ========== */
.cms-tabs {
    display: flex;
    gap: 10px;
    margin-bottom: 25px;
    flex-wrap: wrap;
    border-bottom: 1px solid #e0e0e0;
    padding-bottom: 10px;
}

.tab-btn {
    padding: 10px 24px;
    background: transparent;
    border: none;
    font-family: 'Poppins', sans-serif;
    font-size: 16px;
    font-weight: 500;
    color: #6c757d;
    cursor: pointer;
    transition: all 0.3s ease;
    border-radius: 8px;
}

.tab-btn:hover {
    color: #000080;
    background: rgba(0, 0, 128, 0.05);
}

.tab-btn.active {
    color: #000080;
    background: rgba(0, 0, 128, 0.1);
    border-bottom: 2px solid #000080;
}

/* ========== CONTENT CARD ========== */
.content-card {
    background: #FFFFFF;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 25px;
    background: #F8F9FA;
    border-bottom: 1px solid #E0E0E0;
}

.card-header h3 {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    font-size: 20px;
    font-weight: 600;
    color: #000080;
}

.save-btn {
    padding: 8px 20px;
    background: #000080;
    color: white;
    border: none;
    border-radius: 6px;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.save-btn:hover {
    background: #0000a0;
    transform: scale(1.02);
}

.card-body {
    padding: 25px;
}

/* ========== FORM ========== */
.form-group-cms {
    margin-bottom: 20px;
}

.form-group-cms label {
    display: block;
    margin-bottom: 8px;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    font-size: 14px;
    color: #333;
}

.cms-input {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    transition: all 0.2s ease;
}

.cms-input:focus {
    outline: none;
    border-color: #000080;
    box-shadow: 0 0 0 2px rgba(0, 0, 128, 0.1);
}

.cms-textarea {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    resize: vertical;
    transition: all 0.2s ease;
}

.cms-textarea:focus {
    outline: none;
    border-color: #000080;
    box-shadow: 0 0 0 2px rgba(0, 0, 128, 0.1);
}

.form-row-cms {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
}

.form-row-cms .form-group-cms {
    flex: 1;
    margin-bottom: 0;
}

.form-text {
    display: block;
    margin-top: 5px;
    font-size: 12px;
    color: #6c757d;
}

/* ========== RESPONSIVE ========== */
@media (max-width: 768px) {
    .cms-container {
        padding: 0 15px;
    }
    
    .cms-title {
        font-size: 22px;
        line-height: 33px;
    }
    
    .filter-icon {
        top: 7px;
    }
    
    .cms-tabs {
        gap: 5px;
    }
    
    .tab-btn {
        padding: 8px 16px;
        font-size: 14px;
    }
    
    .card-header {
        flex-direction: column;
        gap: 15px;
        align-items: flex-start;
    }
    
    .form-row-cms {
        flex-direction: column;
        gap: 20px;
    }
    
    .form-row-cms .form-group-cms {
        margin-bottom: 0;
    }
    
    .card-body {
        padding: 20px;
    }
}

@media (max-width: 576px) {
    .cms-title {
        font-size: 20px;
    }
    
    .tab-btn {
        padding: 6px 12px;
        font-size: 12px;
    }
    
    .card-header h3 {
        font-size: 18px;
    }
    
    .save-btn {
        padding: 6px 16px;
        font-size: 13px;
    }
}
</style>
@endpush