<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Kinerja</title>

    <!-- FullCalendar & Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">

    <!-- jQuery & FullCalendar JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    

    <style>
     .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
        
    </style>
</head>
<body>

    <!-- Modal Input Kinerja -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kinerja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Edit Kinerja</h3>
        <form id="editForm" method="post" action="<?= base_url('pengawas/update_kinerja'); ?>">
            <input type="hidden" name="id" id="editId">
            <label for="editKinerja">Kegiatan:</label>
            <textarea name="kinerja" id="editKinerja"></textarea>
            <label for="editJamMulai">Jam Mulai:</label>
            <input type="time" name="jam_mulai" id="editJamMulai">
            <label for="editJamSelesai">Jam Selesai:</label>
            <input type="time" name="jam_selesai" id="editJamSelesai">
            <button type="submit">Simpan</button>
        </form>
    </div>
</div>
        </div>
    </div>

    <script>
    const editModal = document.getElementById('editModal');
    const editBtns = document.querySelectorAll('.btn-edit');
    const editId = document.getElementById('editId');
    const editKinerja = document.getElementById('editKinerja');
    const editJamMulai = document.getElementById('editJamMulai');
    const editJamSelesai = document.getElementById('editJamSelesai');
    const closeBtn = document.querySelector('.close');

    editBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            editId.value = btn.dataset.id;
            editKinerja.value = btn.dataset.kinerja;
            editJamMulai.value = btn.dataset.jamMulai;
            editJamSelesai.value = btn.dataset.jamSelesai;
            editModal.style.display = 'block';
        });
    });

    closeBtn.addEventListener('click', () => {
        editModal.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target == editModal) {
            editModal.style.display = 'none';
        }
    });
</script>
</body>
</html>
