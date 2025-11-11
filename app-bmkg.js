document.addEventListener("DOMContentLoaded", function() {

    const apiUrl = "https://data.bmkg.go.id/DataMKG/TEWS/autogempa.json";
    const container = document.getElementById("data-gempa");

    // Karena API BMKG publik dan mendukung CORS, kita tidak perlu proxy
    fetch(apiUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error("Gagal mengambil data dari BMKG");
            }
            return response.json();
        })
        .then(data => {
            container.innerHTML = ""; // Kosongkan kontainer

            // Ambil data gempa dari struktur JSON
            const gempa = data.Infogempa.gempa;

            const waktu = gempa.DateTime;
            const magnitudo = gempa.Magnitude;
            const kedalaman = gempa.Kedalaman;
            const wilayah = gempa.Wilayah;
            const potensi = gempa.Potensi;
            const gambar = `https://data.bmkg.go.id/DataMKG/TEWS/${gempa.Shakemap}`;

            const divGempa = document.createElement("div");
            divGempa.className = "gempa-info";

            divGempa.innerHTML = `
                <h3>${wilayah}</h3>
                <p><strong>Waktu:</strong> ${new Date(waktu).toLocaleString("id-ID")}</p>
                <p><strong>Magnitudo:</strong> ${magnitudo} SR</p>
                <p><strong>Kedalaman:</strong> ${kedalaman}</p>
                <p><strong>Potensi:</strong> ${potensi}</p>
                <img src="${gambar}" alt="Peta Guncangan" style="max-width: 100%; border-radius: 8px;">
            `;

            container.appendChild(divGempa);
        })
        .catch(error => {
            console.error("Terjadi kesalahan:", error);
            container.innerHTML = `<p style="color: red;">Maaf, terjadi kesalahan saat memuat data gempa.</p>`;
        });
});