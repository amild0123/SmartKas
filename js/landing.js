// Menunggu seluruh konten HTML selesai dimuat
document.addEventListener('DOMContentLoaded', () => {
    
    // 1. Logika untuk Tombol Daftar (Navbar)
    const btnDaftar = document.querySelector('.btn-daftar');
    btnDaftar.addEventListener('click', () => {
        alert('Mengarahkan ke halaman Pendaftaran SmartKas...');
    });

    // 2. Logika untuk Tombol Login Sekarang (Hero Section)
    const btnLogin = document.querySelector('.btn-login');
    btnLogin.addEventListener('click', () => {
        console.log('User menekan tombol Login');
        // Contoh: mengarahkan ke halaman login
        // window.location.href = 'login.html'; 
        alert('Halo! Silakan masuk ke akun SmartKas Anda.');
    });

    // 3. Efek Hover Sederhana pada Kartu Fitur (Opsional)
    const cards = document.querySelectorAll('.card');
    
    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-10px)';
            card.style.transition = 'all 0.3s ease';
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
        });
    });

});