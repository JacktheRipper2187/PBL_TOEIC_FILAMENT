<!-- Modal Konfirmasi -->
<div id="confirmationModal" class="modal hidden fixed inset-0 z-50 bg-gray-500 bg-opacity-75 flex items-center justify-center">
    <div class="modal-content bg-white rounded-lg p-8 max-w-sm w-full">
        <h2 class="text-xl font-bold mb-4">Konfirmasi Pengambilan Sertifikat</h2>
        <p>Apakah Anda yakin ingin mengonfirmasi pengambilan sertifikat ini?</p>
        <div class="mt-4 flex justify-end">
            <button id="cancelButton" class="btn btn-secondary mr-2">Batal</button>
            <button id="confirmButton" class="btn btn-primary">Konfirmasi</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const modal = document.getElementById('confirmationModal');
        const confirmButton = document.getElementById('confirmButton');
        const cancelButton = document.getElementById('cancelButton');

        function showModal() {
            modal.classList.remove('hidden');
        }

        function closeModal() {
            modal.classList.add('hidden');
        }

        cancelButton.addEventListener('click', closeModal);

        confirmButton.addEventListener('click', function () {
            window.location.href = '/update-pengambilan-sertifikat/' + '{{ $record->id }}';
        });

        showModal();
    });
</script>
