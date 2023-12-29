const mobileScreen = window.matchMedia("(max-width: 990px )");
$(document).ready(function () {
    $(".dashboard-nav-dropdown-toggle").click(function () {
        $(this).closest(".dashboard-nav-dropdown")
            .toggleClass("show")
            .find(".dashboard-nav-dropdown")
            .removeClass("show");
        $(this).parent()
            .siblings()
            .removeClass("show");
    });
    $(".menu-toggle").click(function () {
        if (mobileScreen.matches) {
            $(".dashboard-nav").toggleClass("mobile-show");
        } else {
            $(".dashboard").toggleClass("dashboard-compact");
        }
    });
});

const select = document.getElementById('aracSelectId');
const property = document.getElementById('aracOzellik');
if(select){

// Select elementinde değişiklik olduğunda yapılacak işlemler
select.addEventListener('change', function() {
    const selectedAracId = this.value; // Seçilen araç ID'si
    // Veri gönderme işlemi
    fetch('api/getAracOzellikData', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        body: JSON.stringify({ arac_id: selectedAracId }),
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        // Seçilen araca ait özellikleri temizle
        aracOzellik.innerHTML = '';

        // Her bir özellik için option oluştur ve select'e ekle
        data.forEach(ozellik => {
            const option = document.createElement('option');
            option.value = ozellik.id; // Özelliğin ID'si
            option.textContent = ozellik.ozellik; // Özelliğin adı ya da değeri
            aracOzellik.appendChild(option);
        });
    })
    .catch(error => {
        console.error('Hata:', error);
    });
});
}
