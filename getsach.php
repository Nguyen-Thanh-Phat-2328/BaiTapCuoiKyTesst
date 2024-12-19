<?php
include "connect.php"; // Đảm bảo file kết nối chính xác

// Kiểm tra kết nối
if (!$conn) {
    die(json_encode([
        'success' => false,
        'message' => 'Kết nối cơ sở dữ liệu không thành công!',
        'result' => []
    ]));
}

// Thực hiện truy vấn
$query = "SELECT * FROM `books`"; // Thêm dấu chấm phẩy
$data = mysqli_query($conn, $query);

// Kiểm tra lỗi truy vấn
if (!$data) {
    die(json_encode([
        'success' => false,
        'message' => 'Truy vấn cơ sở dữ liệu thất bại!',
        'result' => []
    ]));
}

$result = array();

// Lấy dữ liệu từ truy vấn
while ($row = mysqli_fetch_assoc($data)) {
    $result[] = $row;
}

// Trả kết quả dưới dạng JSON
if (!empty($result)) {
    $arr = [
        'success' => true,
        'message' => "Thành công",
        'result' => $result
    ];
} else {
    $arr = [
        'success' => false,
        'message' => "Không có dữ liệu",
        'result' => []
    ];
}

header('Content-Type: application/json'); // Đảm bảo header trả về JSON
echo json_encode($arr, JSON_UNESCAPED_UNICODE);
?>
