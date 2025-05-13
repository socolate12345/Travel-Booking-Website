<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Tìm Tour Theo Thành Phố</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
  $(document).ready(function() {
    $("#city").on("input", function() {
      var query = $(this).val().trim();
      if (query.length >= 1) {
        $.ajax({
          url: "get_tour.php",
          method: "GET",
          data: { q: query },
          dataType: "json",
          success: function(data) {
            console.log("Received data:", data); // Log response for debugging
            let list = data.map(item => `<option value="${item}">`).join("");
            $("#city_list").html(list);
          },
          error: function(xhr, status, error) {
            console.error("AJAX error:", status, error); // Log errors
            $("#city_list").html(""); // Clear suggestions on error
          }
        });
      } else {
        $("#city_list").html(""); // Clear suggestions if query is too short
      }
    });

    $("form").on("submit", function(e) {
      e.preventDefault();
      var city = $("#city").val().trim();
      if (city) {
        var citySlug = city.toLowerCase().replace(/\s+/g, '_');
        window.location.href = `../Journey/viewjourney_${citySlug}.php`;
      } else {
        alert("Vui lòng nhập tên thành phố!");
      }
    });
  });
  </script>
</head>
<body>
  <h2>Tìm tour du lịch</h2>
  <form method="GET" action="">
    <input type="text" name="city" id="city" list="city_list" placeholder="Nhập tên thành phố" required>
    <datalist id="city_list"></datalist>
    <button type="submit">Tìm kiếm</button>
  </form>
</body>
</html>