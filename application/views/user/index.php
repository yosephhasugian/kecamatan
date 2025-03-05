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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/id.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <style>
          body { background-color: #f9f9f9; }
        .container { display: flex; justify-content: space-between; margin-top: 10px; }
        #calendar-container { width: 65%; background-color: #fff; padding: 15px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        #calendar { max-width: 100%; }
        #stats-container { width: 30%; background-color: #fff; padding: 15px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        .disabled-day { background-color: #e0e0e0 !important; pointer-events: none; opacity: 0.5; }
        .status-box { padding: 15px; border-radius: 10px; margin-top: 10px; }
        .status-pending { background-color: #fff3cd; border-left: 5px solid #ffc107; }
        .status-approved { background-color: #d4edda; border-left: 5px solid #28a745; }
        .status-rejected { background-color: #f8d7da; border-left: 5px solid #dc3545; }
        .fc-event-validated {
                background-color: green !important;
                border-color: green !important;
            }
            .fc-event-rejected {
                background-color: red !important;
                border-color: red !important;
            }
            .fc-event-unvalidated {
                background-color: yellow !important;
                border-color: yellow !important;
            }
                       
    </style>
</head>
<body>
    <div class="container">
        <div id="calendar-container">
            <h4>Kalender Kinerja</h4>
            <div id="calendar"></div>
        </div>

        <!-- Statistik -->
        <div id="stats-container">
            <div class="status-box bg-primary text-white p-3 rounded">
                <h6>Total Aktivitas</h6>
                <p id="total-aktivitas">0 Aktivitas</p>
                </div>
                <div class="status-box bg-primary text-white p-3 rounded">
                <h6>Total Waktu</h6>
                <p id="total-waktu">0 Menit</p>
            </div>
            <div class="status-box status-pending">
                <h6>Belum Validasi</h6>
                <p id="count-belum-validasi">0 Aktivitas</p>
            </div>
            <div class="status-box status-approved">
                <h6>Disetujui</h6>
                <p id="count-disetujui">0 Aktivitas</p>
            </div>
            <div class="status-box status-rejected">
                <h6>Ditolak</h6>
                <p id="count-ditolak">0 Aktivitas</p>
            </div>
            <div class="status-box status-rejected">
               
                <a href="<?=base_url()?>user/Dashboard/laporan" class="btn btn-info btn-sm">Export PDF</a>
             </div>
            </div>

            
    </div>
  

    <!-- Modal Input Kinerja -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Input Kinerja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="eventForm" method="post" action="<?= base_url('user/dashboard/simpan_kinerja') ?>" enctype="multipart/form-data">
                    
                    <input type="hidden" name="user_id" value="<?= $this->session->userdata('user_id'); ?>">
                    <input type="hidden" name="tanggal" value="<?= date('Y-m-d'); ?>">

                        <input type="text" id="tanggal" name="tanggal" class="form-control" readonly>
                        <div class="mb-3">
                            <label>Jam Mulai</label>
                            <input type="time" class="form-control" name="jam_mulai" required>
                        </div>
                        <div class="mb-3">
                            <label>Jam Selesai</label>
                            <input type="time" class="form-control" name="jam_selesai" required>
                        </div>
                        <div class="mb-3">
                            <label>Upload Foto</label>
                            <label for="foto" class="form-label">Pilih Foto (JPG, JPEG, PNG):</label>
                                                      
                            <input type="file" id="foto" name="foto" class="form-control" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff,.svg,.webp,.pdf" required>
                            <p id="fileError" style="color: red; font-weight: bold;"></p>
                        </div>
                        <div class="mb-3">
                            <label>Kinerja</label>
                            <textarea class="form-control" name="kinerja" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function () {
        let today = moment().format('YYYY-MM-DD'); 
        let startAllowedDate = moment().subtract(1, 'months').startOf('month').format('YYYY-MM-DD');

        $('#calendar').fullCalendar({
            locale: 'id',
            selectable: true,
            select: function (start) {
                let selectedDate = moment(start).format('YYYY-MM-DD');

                if (selectedDate < startAllowedDate || selectedDate > today) {
                    alert("Anda hanya bisa input kinerja mulai dari tanggal 1 bulan lalu hingga hari ini.");
                    $('#calendar').fullCalendar('unselect'); 
                    return;
                }

                $('#tanggal').val(selectedDate);
                $('#eventModal').modal('show');
            },

            events: function (start, end, timezone, callback) {
                $.ajax({
                    url: "<?php echo base_url('user/dashboard/get_kinerja_by_date'); ?>",
                    type: "GET",
                    dataType: "json",
                    data: {
                        start: startAllowedDate,
                        end: today
                    },
                    success: function (response) {
                        console.log("Response dari API:", response); // Debugging
                         // Modifikasi response untuk menambahkan className berdasarkan status validasi
                         var events = response.map(function (event) {
                            return {
                                    title: event.title,
                                    start: event.start,
                                    className: event.className
                            };
                        });
                        callback(events);
                    }
                });
            },

            dayRender: function (date, cell) {
                let formattedDate = date.format('YYYY-MM-DD');

                if (formattedDate < startAllowedDate || formattedDate > today) {
                    cell.addClass("disabled-day");
                }
            }
        });

        $("#eventForm").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            let submitButton = form.find("button[type=submit]");

            submitButton.prop("disabled", true);

            let formData = new FormData(this);
            $.ajax({
                url: "<?php echo base_url('user/dashboard/simpan_kinerja'); ?>",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function () {
                    alert("Data berhasil disimpan!");
                    form[0].reset();
                    $('#eventModal').modal('hide');
                    $('#calendar').fullCalendar('refetchEvents');
                },
                error: function () {
                    alert("Gagal menyimpan data.");
                },
                complete: function () {
                    submitButton.prop("disabled", false);
                }
            });
        });

        // **Update Statistik**
        function updateStatusCounts() {
    $.ajax({
        url: "<?= base_url('user/dashboard/get_kinerja_status') ?>",
        type: "GET",
        dataType: "json",
        success: function (data) {
            console.log("DEBUG: Data dari API:", data); // Debugging di console

            // Set total aktivitas dan total waktu
            $("#total-aktivitas").text(data.total_aktivitas + " Aktivitas");
            $("#total-waktu").text(data.total_waktu + " Menit");

            // Reset nilai awal
            let statusCounts = {
                "Belum Validasi": 0,
                "Disetujui": 0,
                "Ditolak": 0
            };

            // Looping melalui key numerik untuk menemukan status kinerja
            $.each(data, function(index, item) {
                if (typeof item === "object" && item.status && item.jumlah) {
                    statusCounts[item.status] = item.jumlah;
                }
            });

            // Tampilkan jumlah status ke dalam HTML
            $("#count-belum-validasi").text(statusCounts["Belum Validasi"] + " Aktivitas");
            $("#count-disetujui").text(statusCounts["Disetujui"] + " Aktivitas");
            $("#count-ditolak").text(statusCounts["Ditolak"] + " Aktivitas");
        },
        error: function (xhr, status, error) {
            console.log("AJAX Error:", status, error);
        }
    });
}

        // Jalankan update pertama kali saat halaman dimuat
        updateStatusCounts();

        // Export PDF
        $("#btnExportPDF").click(function () {
            window.location.href = "<?= site_url('user/dashboard/export_pdf') ?>";
        });
    });
</script>

<script>
    document.getElementById("foto").addEventListener("change", function () {
        let file = this.files[0];
        let maxSize = 40 * 1024 * 1024; // 40MB
        let allowedExtensions = ["jpg", "jpeg", "png", "gif", "bmp", "tiff", "svg", "webp", "pdf"];
        let errorText = document.getElementById("fileError");
        let submitBtn = document.querySelector("button[type=submit]");

        if (file) {
            let fileSize = file.size;
            let fileExt = file.name.split('.').pop().toLowerCase();

            if (fileSize > maxSize) {
                errorText.innerText = "❌ File terlalu besar! Maksimal 40MB.";
                this.value = ""; // Reset input file
                submitBtn.disabled = true;
            } else if (!allowedExtensions.includes(fileExt)) {
                errorText.innerText = "❌ Format file tidak diperbolehkan!";
                this.value = ""; // Reset input file
                submitBtn.disabled = true;
            } else {
                errorText.innerText = ""; // Hapus pesan error
                submitBtn.disabled = false;
            }
        }
    });
</script>

</body>
</html>
