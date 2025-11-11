document.addEventListener("DOMContentLoaded", function() {
    
    // API Internal MAGMA (Khusus Status Gunung Berapi)
    const apiUrl = "https://magma.esdm.go.id/api/v1/gunung-api/status";
    
    // Proxy untuk mengatasi blokir (HANYA UNTUK TES)
    const proxyUrl = "https://api.allorigins.win/raw?url=";

    const container = document.getElementById("data-gunung");
    container.innerHTML = "Mengambil data status gunung berapi...";

    fetch(proxyUrl + encodeURIComponent(apiUrl))
        .then(response => {
            if (!response.ok) {
                throw new Error("Gagal mengambil data: " + response.status);
            }
            return response.json();
        })
        .then(data => {
            container.innerHTML = ""; 
            
            // Looping data LIST STATUS gunung (ini semua khusus gunung berapi)
            data.forEach(gunung => {
                const namaGunung = gunung.nama;
                const level = gunung.level_text;
                const updateTerakhir = gunung.updated_at;

                const divGunung = document.createElement("div");
                divGunung.className = "gunung"; 

                divGunung.innerHTML = `
                    <h3>${namaGunung}</h3>
                    <p><strong>Status:</strong> ${level}</p>
                    <p><strong>Update Terakhir:</strong> ${new Date(updateTerakhir).toLocaleString("id-ID")}</p>
                `;
                container.appendChild(divGunung);
            });
        })
        .catch(error => {
            console.error("Kesalahan:", error);
            container.innerHTML = `<p style="color: red;">Gagal memuat data MAGMA. API mungkin diblokir atau diubah.</p>`;
        });
});