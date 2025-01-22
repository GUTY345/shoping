function fetchOrderReport() {
    $.ajax({
        url: 'get_order_report.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#totalOrders').text(response.total_orders);
            $('#totalSales').text(numberWithCommas(response.total_sales) + ' บาท');
        },
        error: function() {
            console.log("เกิดข้อผิดพลาดในการดึงข้อมูล");
        }
    });
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

$(document).ready(function() {
    fetchOrderReport();

    // ตั้งให้ดึงข้อมูลใหม่ทุก 5 วินาที
    setInterval(fetchOrderReport, 5000);
});