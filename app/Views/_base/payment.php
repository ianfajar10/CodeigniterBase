<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman dengan Bootstrap 4</title>
    <!-- Link ke Bootstrap 4 CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .full-screen {
            display: flex;
            justify-content: center; /* Menyusun elemen di tengah secara horizontal */
            align-items: center;     /* Menyusun elemen di tengah secara vertikal */
            height: 100vh;           /* Mengatur tinggi 100% dari viewport */
        }
    </style>
</head>

<body>
    <div class="full-screen">
        <button id="pay-button" class="btn btn-primary"> Bayar</button>
    </div>
    <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre>

    <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
    <!-- Use the full version of jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-vL0C2R76SHVQrIFS"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var transactionDetails = <?php echo $transaction_details; ?>;
        var orderId = transactionDetails.transaction_details_local.id;
        var price = transactionDetails.transaction_details_local.price;
        var productId = transactionDetails.transaction_details_local.product_id;
        var quantity = transactionDetails.transaction_details_local.qty;
        var username = transactionDetails.transaction_details_local.username;
        var receipt_number = transactionDetails.transaction_details_local.receipt_number;
        
            document.getElementById('pay-button').onclick = function() {

            snap.pay('<?php echo $snaptoken; ?>', {
                
                onSuccess: function(result) {
                    
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);

                    
                    $.ajax({
                        url: '/home/store_transaction',
                        type: 'POST',
                        data: {
                            order_id: orderId,
                            price: price,
                            product_id: productId,
                            quantity: quantity,
                            username: username,
                            receipt_number: receipt_number,
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                alert('Transaksi Berhasil');
            
                                // Reload the page or redirect to the homepage
                                window.location.href = '<?php echo base_url('home'); ?>';
                            } else {
                                alert('Transaksi Gagal');
                            }
                        },
                    });
                },
                
                onPending: function(result) {
                    console.log(1);
                    
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                
                onError: function(result) {
                    console.log(2);
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>