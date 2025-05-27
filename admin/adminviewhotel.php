<?php
include '../dbconnect.php';

// Handle filters
$filters = [];
$filter_query = "SELECT * FROM hotels WHERE 1=1";

if (isset($_GET['cityid']) && $_GET['cityid'] !== '') {
    $cityid = (int)$_GET['cityid'];
    $filter_query .= " AND cityid = $cityid";
    $filters['cityid'] = $cityid;
}

if (isset($_GET['ratings']) && $_GET['ratings'] !== '') {
    $ratings = (int)$_GET['ratings'];
    $filter_query .= " AND ratings = $ratings";
    $filters['ratings'] = $ratings;
}

if (isset($_GET['cost']) && $_GET['cost'] !== '') {
    $cost = $_GET['cost'];
    if ($cost == 'under1m') {
        $filter_query .= " AND cost < 1000000";
    } elseif ($cost == '1m-2m') {
        $filter_query .= " AND cost BETWEEN 1000000 AND 2000000";
    } elseif ($cost == 'above2m') {
        $filter_query .= " AND cost > 2000000";
    }
    $filters['cost'] = $cost;
}

if (isset($_GET['payment_status']) && $_GET['payment_status'] !== '') {
    $payment_status = $_GET['payment_status'];
    $filter_query .= " AND payment_status = '$payment_status'";
    $filters['payment_status'] = $payment_status;
}

// Fetch hotels
$result = $conn->query($filter_query);

// Fetch cities for dropdown
$cities_result = $conn->query("SELECT cityid, city FROM cities");
$city_options = [];
while ($city = $cities_result->fetch_assoc()) {
    $city_options[$city['cityid']] = $city['city'];
}

// Fetch hotel for editing
$edit = null;
if (isset($_GET["edit"])) {
    $id = (int)$_GET["edit"];
    $edit = $conn->query("SELECT * FROM hotels WHERE hotelid = $id")->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Manage Hotels</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" type="text/css" href="../css/adminviewhotel.css">
    <link rel="icon" type="image/png" href="../images/favicon.png">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold mb-6 text-center">Hotel List</h2>

        <form method="GET" class="mb-6 space-y-4 bg-white p-6 rounded-lg shadow-md flex justify-center">
            <div class="flex space-x-4 items-center">
                <div>
                    <label class="block mb-1 font-semibold" for="cityid">City</label>
                    <select id="cityid" name="cityid" class="border border-gray-300 px-3 py-2 rounded">
                        <option value="">All Cities</option>
                        <?php foreach ($city_options as $id => $name) { ?>
                            <option value="<?= $id ?>" <?= isset($filters['cityid']) && $filters['cityid'] == $id ? "selected" : "" ?>>
                                <?= "$id - $name" ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label class="block mb-1 font-semibold" for="ratings">Ratings</label>
                    <select id="ratings" name="ratings" class="border border-gray-300 px-3 py-2 rounded">
                        <option value="">All Ratings</option>
                        <?php for ($i = 1; $i <= 5; $i++) { ?>
                            <option value="<?= $i ?>" <?= isset($filters['ratings']) && $filters['ratings'] == $i ? "selected" : "" ?>>
                                <?= $i ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label class="block mb-1 font-semibold" for="cost">Cost</label>
                    <select id="cost" name="cost" class="border border-gray-300 px-3 py-2 rounded">
                        <option value="">All Costs</option>
                        <option value="under1m" <?= isset($filters['cost']) && $filters['cost'] == 'under1m' ? "selected" : "" ?>>Under 1M</option>
                        <option value="1m-2m" <?= isset($filters['cost']) && $filters['cost'] == '1m-2m' ? "selected" : "" ?>>1M - 2M</option>
                        <option value="above2m" <?= isset($filters['cost']) && $filters['cost'] == 'above2m' ? "selected" : "" ?>>Above 2M</option>
                    </select>
                </div>
                <div class="pt-6">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Apply Filters</button>
                </div>
            </div>
        </form>
    </div>
        <!-- Hotel List -->
        <div class="overflow-x-auto mb-10">
            <table class="min-w-full bg-white border border-gray-300 shadow-sm rounded-lg text-sm">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="p-3 border">ID</th>
                        <th class="p-3 border">Hotel Name</th>
                        <th class="p-3 border">City</th>
                        <th class="p-3 border">Cost</th>
                        <th class="p-3 border">Amenities</th>
                        <th class="p-3 border">Ratings</th>
                        <th class="p-3 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr class="hover:bg-gray-50">
                        <td class="p-3 border text-center"><?= $row["hotelid"] ?></td>
                        <td class="p-3 border"><?= htmlspecialchars($row["hotel"]) ?></td>
                        <td class="p-3 border"><?= $row["cityid"] ?> - <?= $city_options[$row["cityid"]] ?? "Unknown" ?></td>
                        <td class="p-3 border text-right"><?= number_format($row["cost"]) ?></td>
                        <td class="p-3 border"><?= nl2br(htmlspecialchars($row["amenities"])) ?></td>
                        <td class="p-3 border text-center"><?= $row["ratings"] ?></td>
                        <td class="p-3 border text-center">
                            <a href="?edit=<?= $row["hotelid"] ?>" class="text-blue-600 hover:underline mr-2">Edit</a> |
                            <a href="controllers/deletehotel.php?delete=<?= $row["hotelid"] ?>" class="text-red-600 hover:underline ml-2" onclick="return confirm('Delete this hotel?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Add/Edit Form -->
        <div class="max-w-2xl mx-auto bg-white p-10 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6 text-center"><?= $edit ? "Edit Hotel #" . $edit["hotelid"] : "Add New Hotel" ?></h2>
            <form method="POST" action="<?= $edit ? 'controllers/edithotel.php' : 'controllers/addhotel.php' ?>" class="space-y-4">
                <input type="hidden" name="hotelid" value="<?= $edit["hotelid"] ?? '' ?>">
                <div>
                    <label class="block mb-1 font-semibold" for="hotel">Hotel Name</label>
                    <input id="hotel" name="hotel" type="text" value="<?= htmlspecialchars($edit["hotel"] ?? '') ?>" class="w-full border border-gray-300 px-3 py-2 rounded" required />
                </div>
                <div>
                    <label class="block mb-1 font-semibold" for="cityid">City</label>
                    <select id="cityid" name="cityid" class="w-full border border-gray-300 px-3 py-2 rounded" required>
                        <?php foreach ($city_options as $id => $name) { ?>
                            <option value="<?= $id ?>" <?= ($edit["cityid"] ?? '') == $id ? "selected" : "" ?>>
                                <?= "$id - $name" ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label class="block mb-1 font-semibold" for="cost">Cost</label>
                    <input id="cost" name="cost" type="number" value="<?= $edit["cost"] ?? '' ?>" class="w-full border border-gray-300 px-3 py-2 rounded" required />
                </div>
                <div>
                    <label class="block mb-1 font-semibold" for="amenities">Amenities</label>
                    <textarea id="amenities" name="amenities" class="w-full border border-gray-300 px-3 py-2 rounded" rows="3"><?= htmlspecialchars($edit["amenities"] ?? '') ?></textarea>
                </div>
                <div>
                    <label class="block mb-1 font-semibold" for="ratings">Ratings (1-5)</label>
                    <input id="ratings" name="ratings" type="number" min="1" max="5" value="<?= $edit["ratings"] ?? '' ?>" class="w-full border border-gray-300 px-3 py-2 rounded" required />
                </div>
                <div class="flex justify-between pt-4">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                        <?= $edit ? "Update" : "Add New" ?>
                    </button>
                </div>
            </form>
        </div>

        <div class="text-center mt-10">
            <button type="button" onclick="window.location.href='admindashboard.php'" class="bg-gray-600 text-white px-6 py-2 rounded hover:bg-gray-700 transition">
                Back to Dashboard
            </button>
        </div>
    </div>
</body>
</html>