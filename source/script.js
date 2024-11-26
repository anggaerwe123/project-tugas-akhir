function addHashToUrl() {
    // Setelah form disubmit, tambahkan #produk pada URL
    setTimeout(function() {
        window.location.hash = '#produk';
    }, 10);  // Timeout sedikit untuk menunggu redirect
}