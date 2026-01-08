<!-- Image Preview Modal (reusable) -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Preview Gambar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="imagePreviewModalImg" src="" alt="Preview"
                    style="max-width:100%; max-height:80vh; border-radius:6px;" />
            </div>
            <div class="modal-footer">
                <a id="imagePreviewDownloadBtn" href="#" download class="btn btn-primary" style="display:none;"><i
                        class="fa fa-download"></i> Download Gambar</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('click', function (e) {
        const target = e.target;
        if (target && target.classList && target.classList.contains('clickable-preview')) {
            const src = target.dataset.full || target.src;
            if (!src) return;
            const modalImg = document.getElementById('imagePreviewModalImg');
            const downloadBtn = document.getElementById('imagePreviewDownloadBtn');

            modalImg.src = src;

            // set download link
            downloadBtn.href = src;
            const filename = src.split('/').pop().split('?')[0] || 'image';
            downloadBtn.setAttribute('download', filename);
            downloadBtn.style.display = 'inline-block';

            const modalEl = document.getElementById('imagePreviewModal');
            const bs = new bootstrap.Modal(modalEl);
            bs.show();
        }
    });
</script>
