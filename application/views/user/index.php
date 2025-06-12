<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Kinerja</title>

    <!-- FullCalendar & Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Optional: jQuery UI CSS (basic theme) if you want consistent styling, though Touch Punch doesn't strictly require it for functionality -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">

    <!-- jQuery & FullCalendar JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- jQuery UI is required by jQuery UI Touch Punch -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <!-- Load FullCalendar Indonesian locale -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/id.js"></script>
    <!-- Bootstrap JS Bundle for modals and other components -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- **IMPORTANT**: jQuery UI Touch Punch for touch support on jQuery UI elements like selectable days in FullCalendar -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.ui.touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>

    <style>
        /* Basic body styling */
        body {
            background-color: #f9f9f9;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh; /* Ensure body takes at least full viewport height */
        }

        /* Main container layout using Bootstrap's default behavior */
        .container {
            margin-top: 20px;
            /* Removed custom display: flex to rely on Bootstrap's .row behavior */
        }

        /* Calendar container styling */
        #calendar-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.08); /* Softer shadow */
            min-height: 400px; /* Ensure calendar has enough initial height to render */
        }

        /* FullCalendar element max width */
        #calendar { max-width: 100%; }

        /* Stats container styling */
        #stats-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.08); /* Softer shadow */
        }

        /* Styling for disabled calendar days */
        .disabled-day {
            background-color: #e0e0e0 !important; /* Lighter grey */
            pointer-events: none; /* Disables click events */
            opacity: 0.6; /* Slightly faded */
            cursor: not-allowed; /* Indicates non-clickable */
        }

        /* Common style for status boxes */
        .status-box {
            padding: 18px;
            border-radius: 10px;
            margin-bottom: 15px; /* Spacing between status boxes */
            font-weight: 500;
        }

        /* Specific styles for different status types */
        .status-pending { background-color: #fff3cd; border-left: 6px solid #ffc107; color: #664d03; }
        .status-approved { background-color: #d4edda; border-left: 6px solid #28a745; color: #155724; }
        .status-rejected { background-color: #f8d7da; border-left: 6px solid #dc3545; color: #721c24; }
        /* Styling for the export PDF button within a status box */
        .status-box .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
            transition: background-color 0.3s ease;
        }
        .status-box .btn-info:hover {
            background-color: #138496;
            border-color: #117a8b;
        }

        /* FullCalendar event colors based on validation status */
        .fc-event-validated {
            background-color: #28a745 !important; /* Green */
            border-color: #28a745 !important;
        }
        .fc-event-rejected {
            background-color: #dc3545 !important; /* Red */
            border-color: #dc3545 !important;
        }
        .fc-event-unvalidated {
            background-color: #ffc107 !important; /* Yellow/Orange */
            border-color: #ffc107 !important;
            color: #333 !important; /* Ensure text is visible */
        }

        /* Custom Message Box for alerts (replaces browser's alert) */
        #messageBox {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #f8d7da; /* Default error color */
            color: #721c24; /* Default error text color */
            padding: 15px 25px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            z-index: 1050; /* Ensure it's above other elements like modals */
            display: none; /* Hidden by default */
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            border: 1px solid #f5c6cb;
            text-align: center;
            max-width: 90%; /* Responsive width */
        }
        #messageBox.show {
            display: block;
            opacity: 1;
        }

        /* Responsive adjustments for smaller screens */
        @media (max-width: 768px) {
            .container .row {
                flex-direction: column; /* Stack calendar and stats vertically */
                gap: 15px; /* Add gap for spacing */
            }
            #calendar-container, #stats-container {
                width: 100%; /* Take full width */
                max-width: none; /* Override any max-width */
                margin-bottom: 0; /* Adjust margin */
            }
            #calendar-container, #stats-container {
                padding: 15px; /* Adjust padding for smaller screens */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row w-full">
            <!-- Kalender Section -->
            <div class="col-md-8 mb-3" id="calendar-container">
                <h4 class="mb-4 text-gray-700 font-semibold">Kalender Kinerja</h4>
                <div id="calendar"></div>
            </div>

            <!-- Statistik Section -->
            <div class="col-md-4" id="stats-container">
                <h4 class="mb-4 text-gray-700 font-semibold">Statistik Kinerja</h4>
                <div class="status-box bg-primary text-white p-3 rounded-md">
                    <h6>Total Aktivitas</h6>
                    <p id="total-aktivitas" class="text-2xl font-bold">0 Aktivitas</p>
                </div>
                <div class="status-box bg-primary text-white p-3 rounded-md">
                    <h6>Total Waktu</h6>
                    <p id="total-waktu-jam" class="text-2xl font-bold">0 Jam</p>
                </div>
                <div class="status-box status-pending">
                    <h6>Belum Validasi</h6>
                    <p id="count-belum-validasi" class="text-xl font-bold">0 Aktivitas</p>
                </div>
                <div class="status-box status-approved">
                    <h6>Disetujui</h6>
                    <p id="count-disetujui" class="text-xl font-bold">0 Aktivitas</p>
                </div>
                <div class="status-box status-rejected">
                    <h6>Ditolak</h6>
                    <p id="count-ditolak" class="text-xl font-bold">0 Aktivitas</p>
                </div>
                <div class="status-box text-center bg-light border-0">
                    <a href="<?=base_url()?>user/Dashboard/laporan" class="btn btn-info btn-block">Export PDF</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Input Kinerja -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Input Kinerja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="eventForm" method="post" action="<?= base_url('user/dashboard/simpan_kinerja') ?>" enctype="multipart/form-data">
                        <!-- Hidden inputs for user_id and base date -->
                        <input type="hidden" name="user_id" value="<?= $this->session->userdata('user_id'); ?>">
                        <input type="hidden" name="tanggal" id="formTanggalHidden" value="">

                        <!-- Tanggal display (readonly) -->
                        <div class="mb-3">
                            <label for="tanggalDisplay" class="form-label">Tanggal</label>
                            <input type="text" id="tanggalDisplay" class="form-control" readonly>
                        </div>
                        
                        <!-- Jam Mulai Input -->
                        <div class="mb-3">
                            <label for="jam_mulai" class="form-label">Jam Mulai</label>
                            <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required>
                        </div>
                        <!-- Jam Selesai Input -->
                        <div class="mb-3">
                            <label for="jam_selesai" class="form-label">Jam Selesai</label>
                            <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" required>
                        </div>
                        <!-- Upload Foto Input -->
                        <div class="mb-3">
                            <label for="foto" class="form-label">Upload Foto (JPG, JPEG, PNG, maks 40MB)</label>
                            <input type="file" id="foto" name="foto" class="form-control" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff,.svg,.webp,.pdf" required>
                            <p id="fileError" class="text-danger font-bold mt-2"></p>
                        </div>
                        <!-- Kinerja Textarea -->
                        <div class="mb-4">
                            <label for="kinerja" class="form-label">Kinerja</label>
                            <textarea class="form-control" id="kinerja" name="kinerja" rows="3" required></textarea>
                        </div>
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100">Simpan Kinerja</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Message Box for alerts (replaces browser's alert) -->
    <div id="messageBox"></div>

    <!-- Script Format Waktu Input -->
    <script>
    $(document).ready(function () {
        // Ensures time inputs are formatted correctly (e.g., 08:00 instead of 8:0)
        $("input[type='time']").on("input", function () {
            let timeValue = $(this).val();
            if (timeValue) {
                let [hours, minutes] = timeValue.split(":");
                hours = ('0' + hours).slice(-2);
                minutes = ('0' + minutes).slice(-2);
                $(this).val(`${hours}:${minutes}`);
            }
        });
    });
    </script>

    <!-- Script FullCalendar & Event Handling -->
    <script>
    $(document).ready(function () {
        // Function to show a custom message (replaces native alert)
        function showMessage(message, type = 'error') {
            const messageBox = $('#messageBox');
            messageBox.removeClass().addClass('message-box'); // Reset classes
            if (type === 'error') {
                messageBox.css({
                    backgroundColor: '#f8d7da', /* Light red */
                    color: '#721c24', /* Dark red text */
                    border: '1px solid #f5c6cb'
                });
            } else if (type === 'success') {
                messageBox.css({
                    backgroundColor: '#d4edda', /* Light green */
                    color: '#155724', /* Dark green text */
                    border: '1px solid #c3e6cb'
                });
            } else { /* Default for info/neutral */
                messageBox.css({
                    backgroundColor: '#e2e3e5',
                    color: '#383d41',
                    border: '1px solid #d6d8db'
                });
            }
            messageBox.text(message).addClass('show'); // Add 'show' class to display and animate
            setTimeout(() => {
                messageBox.removeClass('show'); // Remove 'show' class to hide after 3 seconds
            }, 3000);
        }

        // Define today's date and the allowed start date for input (1st of last month)
        let today = moment().format('YYYY-MM-DD');
        let startAllowedDate = moment().subtract(1, 'months').startOf('month').format('YYYY-MM-DD');

        // Initialize FullCalendar
        console.log("Initializing FullCalendar...");
        $('#calendar').fullCalendar({
            locale: 'id', // Set locale to Indonesian
            selectable: true, // Enable selection of days/time slots
            height: 'auto', // Adjust height automatically based on content
            header: { // Customize calendar header buttons
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            // Callback function when a date range/day is selected
            select: function (start) {
                console.log("Date selected:", start.format());
                let selectedDate = moment(start).format('YYYY-MM-DD');
                // Check if the selected date is within the allowed range
                if (selectedDate < startAllowedDate || selectedDate > today) {
                    showMessage("Anda hanya bisa input kinerja mulai dari tanggal 1 bulan lalu hingga hari ini.");
                    $('#calendar').fullCalendar('unselect'); // Deselect the date
                    return; // Stop execution if date is invalid
                }

                // Populate modal form fields with the selected date
                $('#tanggalDisplay').val(moment(start).format('DD MMMM YYYY')); // Display readable date
                $('#formTanggalHidden').val(selectedDate); // Hidden field for form submission
                $('#eventModal').modal('show'); // Show the input modal
            },

            // Callback to fetch events for the calendar
            events: function (start, end, timezone, callback) {
                $.ajax({
                    url: "<?php echo base_url('user/dashboard/get_kinerja_by_date'); ?>",
                    type: "GET",
                    dataType: "json",
                    data: {
                        start: startAllowedDate, // Pass allowed start date
                        end: today // Pass today's date
                    },
                    success: function (response) {
                        console.log("API Response (Events):", response);
                        // Map API response to FullCalendar event format
                        let events = response.map(function (event) {
                            return {
                                title: event.title,
                                start: event.start,
                                className: event.className // Custom class for coloring events
                            };
                        });
                        callback(events); // Render events on the calendar
                    },
                    error: function (xhr, status, error) {
                        console.error("Error fetching events:", status, error);
                        showMessage("Gagal memuat data kinerja.", 'error');
                    }
                });
            },

            // Callback function to manipulate day cells before rendering
            dayRender: function (date, cell) {
                let formattedDate = date.format('YYYY-MM-DD');
                // Add 'disabled-day' class to dates outside the allowed range
                if (formattedDate < startAllowedDate || formattedDate > today) {
                    cell.addClass("disabled-day");
                }
            },
            // Explicitly handle dayClick for better touch response, re-using select logic
            dayClick: function(date, jsEvent, view) {
                console.log("Day clicked:", date.format());
                // Ensure the 'select' function's logic is triggered consistently
                $('#calendar').fullCalendar('select', date);
            }
        });

        // Form Submission Handler for Kinerja Input
        $("#eventForm").submit(function (e) {
            e.preventDefault(); // Prevent default form submission
            let form = $(this);
            let submitButton = form.find("button[type=submit]");
            submitButton.prop("disabled", true); // Disable button to prevent multiple submissions

            let formData = new FormData(this); // Create FormData object for file upload
            $.ajax({
                url: "<?php echo base_url('user/dashboard/simpan_kinerja'); ?>",
                type: "POST",
                data: formData,
                processData: false, // Important: Don't process data (for FormData)
                contentType: false, // Important: Don't set content type (for FormData)
                success: function (response) {
                    showMessage("Data berhasil disimpan!", 'success');
                    form[0].reset(); // Reset the form
                    $('#eventModal').modal('hide'); // Hide the modal
                    $('#calendar').fullCalendar('refetchEvents'); // Refresh calendar events
                    updateStatusCounts(); // Update statistics after saving
                },
                error: function () {
                    showMessage("Gagal menyimpan data.", 'error');
                },
                complete: function () {
                    submitButton.prop("disabled", false); // Re-enable submit button
                }
            });
        });

        // Function to update statistics from API
        function updateStatusCounts() {
            $.ajax({
                url: "<?= base_url('user/dashboard/get_kinerja_status') ?>",
                type: "GET",
                dataType: "json",
                success: function (data) {
                    console.log("API Response (Status Counts):", data);

                    // Update total activities and total hours
                    $("#total-aktivitas").text(data.total_aktivitas + " Aktivitas");
                    $("#total-waktu-jam").text(data.total_waktu_jam + " Jam");

                    // Initialize status counts
                    let statusCounts = {
                        "Belum Validasi": 0,
                        "Disetujui": 0,
                        "Ditolak": 0
                    };

                    // Populate status counts from API response
                    $.each(data, function (index, item) {
                        if (typeof item === "object" && item.status && typeof item.jumlah !== 'undefined') {
                            statusCounts[item.status] = item.jumlah;
                        }
                    });

                    // Update display for each status
                    $("#count-belum-validasi").text(statusCounts["Belum Validasi"] + " Aktivitas");
                    $("#count-disetujui").text(statusCounts["Disetujui"] + " Aktivitas");
                    $("#count-ditolak").text(statusCounts["Ditolak"] + " Aktivitas");
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error getting status counts:", status, error);
                    showMessage("Gagal memuat statistik kinerja.", 'error');
                }
            });
        }

        updateStatusCounts(); // Call on document ready to load initial stats

        // Export PDF button click handler
        $("#btnExportPDF").click(function () {
            window.location.href = "<?= site_url('user/dashboard/export_pdf') ?>";
        });
    });
    </script>

    <!-- Script Validasi File -->
    <script>
    document.getElementById("foto").addEventListener("change", function () {
        let file = this.files[0];
        let maxSize = 40 * 1024 * 1024; // 40 MB in bytes
        let allowedExtensions = ["jpg", "jpeg", "png", "gif", "bmp", "tiff", "svg", "webp", "pdf"];
        let errorText = document.getElementById("fileError");
        let submitBtn = document.querySelector("button[type=submit]");

        if (file) {
            let fileSize = file.size;
            let fileExt = file.name.split('.').pop().toLowerCase();

            // Check file size
            if (fileSize > maxSize) {
                errorText.innerText = "❌ File terlalu besar! Maksimal 40MB.";
                this.value = ""; // Clear selected file
                submitBtn.disabled = true;
            } 
            // Check file extension
            else if (!allowedExtensions.includes(fileExt)) {
                errorText.innerText = "❌ Format file tidak diperbolehkan! Hanya JPG, JPEG, PNG, GIF, BMP, TIFF, SVG, WEBP, PDF.";
                this.value = ""; // Clear selected file
                submitBtn.disabled = true;
            } 
            // If file is valid
            else {
                errorText.innerText = "";
                submitBtn.disabled = false;
            }
        } else {
            // If no file is selected, clear error and enable button if other validations pass
            errorText.innerText = "";
            submitBtn.disabled = false; // Re-enable, assuming other inputs are valid
        }
    });
    </script>

</body>
</html>
