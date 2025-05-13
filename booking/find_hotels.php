<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Tìm Tour Theo Thành Phố</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
  var cityMap = {}; // Lưu name -> id

  $(document).ready(function() {
    $("#city").on("input", function() {
      var query = $(this).val().trim();
      if (query.length >= 1) {
        $.ajax({
          url: "get_hotel.php",
          method: "GET",
          data: { q: query },
          dataType: "json",
          success: function(data) {
            cityMap = {}; // Xoá map cũ
            let list = data.map(item => {
              cityMap[item.name] = item.id; // Gán name -> id
              return `<option value="${item.name}">`;
            }).join("");
            $("#city_list").html(list);
          },
          error: function(xhr, status, error) {
            console.error("AJAX error:", status, error);
            $("#city_list").html("");
          }
        });
      } else {
        $("#city_list").html("");
      }
    });

$("form").on("submit", function(e) {
  e.preventDefault();
  var cityName = $("#city").val().trim();
  var cityId = cityMap[cityName];
  if (cityId) {
    window.location.href = `../view_hotels.php?city_id=${cityId}`;
  } else {
    alert("Thành phố không hợp lệ hoặc chưa được chọn từ danh sách.");
  }
});

  });
  </script>
</head>
<body>
  <h2>Tìm khách sạn</h2>
  <form method="GET" action="">
    <input type="text" name="city" id="city" list="city_list" placeholder="Nhập tên thành phố" required>
    <datalist id="city_list"></datalist>
    <button type="submit">Tìm kiếm</button>
  </form>
</body>
</html>
