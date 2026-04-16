<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="//unpkg.com/alpinejs" defer></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    new Litepicker({
        element: document.getElementById('tanggal'),
        format: 'YYYY-MM-DD',
        maxDate: new Date(),
        singleMode: true,
        dropdowns: {
            minYear: 2000,
            maxYear: new Date().getFullYear(),
            months: true,
            years: true
        }
    });
});
</script>
