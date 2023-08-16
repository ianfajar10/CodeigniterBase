// HASIL QUERY HARUS SAMA DENGAN COLUMNIDS

async function getDataAndPopulateTable(url, columnIDs) {
    var columnIDsLength = (columnIDs.length + 1);

    const apiUrl = url; // Ganti URL_API dengan URL endpoint API Anda

    // Show loading indicator while fetching data
    var loadingIndicator = '<tr><td colspan="' + columnIDsLength + '" class="text-center"><div class="text-primary" role="status"><img src="assets/images/custom/custom-loading.gif" alt="Loading..." style="width: 50px; height: 50px;"></div></td></tr>';
    $("#myTable tbody").html(loadingIndicator);

    try {
        const data = await $.ajax({
            url: apiUrl,
            method: 'GET',
            dataType: 'json',
        });

        // Simulate a 3-second delay (3000 milliseconds) for the loading indicator
        await new Promise(resolve => setTimeout(resolve, 1000));

        // Data fetched, remove loading indicator
        $("#myTable tbody").empty();

        var tableBody = $("#myTable tbody");
        $.each(data, function (index, item) {
            var row = `<tr><td>${index + 1}</td>`;

            // Iterate through each property (column) ID in columnIDs array
            $.each(columnIDs, function (key, value) {
                var col = item[value]; // Use value as the key to access the property value
                if (typeof col === 'undefined') {
                    col = ' - '; // Replace undefined value with ' - '
                }
                row += `<td>${col}</td>`;
            });

            row += "</tr>";
            tableBody.append(row);
        });
    } catch (error) {
        console.log("Error while fetching data from API:", error);
    }

    window.getDataAndPopulateTable = getDataAndPopulateTable;

    const dataTables = $('#myTable').DataTable({
        columnDefs: [{
            targets: 0,
            orderable: false,
            render: function (data, type, row, meta) {
                // Fungsi ini akan mengembalikan nomor urut dari baris (1, 2, 3, ...)
                return meta.row + 1;
            }
        }],
        lengthMenu: [15, 30, 50, 100], // Menentukan pilihan jumlah entri
        pageLength: 15 // Jumlah entri yang akan ditampilkan per halaman (default: 5)
    });

    // Tangani klik tombol pencarian
    $('#searchButton').on('click', async function () {
      const searchQuery = $('#searchInput').val();
      try {
        // Data fetched, remove loading indicator
        $("#myTable tbody").empty();

        $("#myTable tbody").html(loadingIndicator);

        // Simulate a 3-second delay (3000 milliseconds) for the loading indicator
        await new Promise(resolve => setTimeout(resolve, 1000));

        dataTables.search(searchQuery).draw();
      } catch (error) {
        console.log("Error while fetching data from API:", error);
      }
    });

    // Fungsi untuk menangani klik tombol jumlah data
    $('.btn-entries .dropdown-menu').on('click', '.dropdown-item', async function () {
        const selectedEntries = $(this).text();
        // Ubah teks tombol jumlah data sesuai dengan yang dipilih
        $('.btn-entries .btn-primary').text('Jumlah Baris: ' + selectedEntries);

        try {
          // Data fetched, remove loading indicator
          $("#myTable tbody").empty();

          $("#myTable tbody").html(loadingIndicator);

          // Simulate a 3-second delay (3000 milliseconds) for the loading indicator
          await new Promise(resolve => setTimeout(resolve, 1000));

          // Lakukan perubahan jumlah entri row di tabel
          const selectedValue = parseInt(selectedEntries);
          dataTables.page.len(selectedValue).draw();

        } catch (error) {
          console.log("Error while fetching data from API:", error);
        }
    });
}
