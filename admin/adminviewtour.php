<?php
include '../dbconnect.php';

// Handle filters
$filters = [];
$filter_query = "SELECT * FROM tours WHERE 1=1";

if (isset($_GET['cityid']) && $_GET['cityid'] !== '') {
    $cityid = (int)$_GET['cityid'];
    $filter_query .= " AND cityid = $cityid";
    $filters['cityid'] = $cityid;
}


if (isset($_GET['price_per_person']) && $_GET['price_per_person'] !== '') {
    $price = $_GET['price_per_person'];
    if ($price == 'under5m') {
        $filter_query .= " AND price_per_person < 5000000";
    } elseif ($price == '5m-10m') {
        $filter_query .= " AND price_per_person BETWEEN 5000000 AND 10000000";
    } elseif ($price == 'above10m') {
        $filter_query .= " AND price_per_person > 10000000";
    }
    $filters['price_per_person'] = $price;
}

if (isset($_GET['season']) && $_GET['season'] !== '') {
    $season = $_GET['season'];
    $filter_query .= " AND season = '$season'";
    $filters['season'] = $season;
}

// Fetch tours
$tours = $conn->query($filter_query);

// Fetch cities for dropdown
$cities = $conn->query("SELECT cityid, city FROM cities");
$city_options = [];
while ($row = $cities->fetch_assoc()) {
    $city_options[$row['cityid']] = $row['city'];
}

// Fetch tour for editing
$edit = null;
if (isset($_GET["edit"])) {
    $id = (int)$_GET["edit"];
    $edit = $conn->query("SELECT * FROM tours WHERE tourid = $id")->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Tour Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" type="text/css" href="../css/adminviewtour.css">
    <link rel="icon" type="image/png" href="../images/favicon.png">

</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold mb-6 text-center">Tour List</h2>

        <div class="flex justify-center">
            <form method="GET" 
                  class="sticky top-4 z-10 w-full max-w-5xl mb-6 bg-white p-6 rounded-lg shadow-md">
                <div class="flex flex-wrap items-end gap-4 justify-center">
                    <div class="mr-5"> <label class="block mb-1 font-semibold" for="cityid">City</label>
                        <select id="cityid" name="cityid" class="border border-gray-300 px-3 py-2 rounded">
                            <option value="">All Cities</option>
                            <?php foreach ($city_options as $id => $name) { ?>
                                <option value="<?= $id ?>" <?= isset($filters['cityid']) && $filters['cityid'] == $id ? "selected" : "" ?>>
                                    <?= "$id - $name" ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mr-5"> <label class="block mb-1 font-semibold" for="price_per_person">Price</label>
                        <select id="price_per_person" name="price_per_person" class="border border-gray-300 px-4 py-2 rounded">
                            <option value="">All Prices</option>
                            <option value="under5m" <?= isset($filters['price_per_person']) && $filters['price_per_person'] == 'under5m' ? "selected" : "" ?>>Under 5000000</option>
                            <option value="5m-10m" <?= isset($filters['price_per_person']) && $filters['price_per_person'] == '5m-10m' ? "selected" : "" ?>>5000000 - 10000000</option>
                            <option value="above10m" <?= isset($filters['price_per_person']) && $filters['price_per_person'] == 'above10m' ? "selected" : "" ?>>Above 10000000</option>
                        </select>
                    </div>

                    <div class="mr-5"> <label class="block mb-1 font-semibold" for="season">Season</label>
                        <select id="season" name="season" class="border border-gray-300 px-3 py-2 rounded">
                            <option value="">All </option>
                            <option value="Spring" <?= isset($filters['season']) && $filters['season'] == 'Spring' ? "selected" : "" ?>>Spring</option>
                            <option value="Summer" <?= isset($filters['season']) && $filters['season'] == 'Summer' ? "selected" : "" ?>>Summer</option>
                            <option value="Fall" <?= isset($filters['season']) && $filters['season'] == 'Fall' ? "selected" : "" ?>>Fall</option>
                            <option value="Winter" <?= isset($filters['season']) && $filters['season'] == 'Winter' ? "selected" : "" ?>>Winter</option>
                        </select>
                    </div>

                    <div class="self-end">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Apply Filters
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

        <!-- Tour List -->
        <div class="overflow-x-auto mb-10">
            <table class="min-w-full bg-white border border-gray-300 shadow-sm rounded-lg text-sm">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="p-3 border">ID</th>
                        <th class="p-3 border">City</th>
                        <th class="p-3 border">Tour Name</th>
                        <th class="p-3 border">Description</th>
                        <th class="p-3 border">Duration (days)</th>
                        <th class="p-3 border">Price/Person</th>
                        <th class="p-3 border">Season</th>
                        <th class="p-3 border">Created At</th>
                        <th class="p-3 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = $tours->fetch_assoc()) { ?>
                    <tr class="hover:bg-gray-50">
                        <td class="p-3 border text-center"><?= $row["tourid"] ?></td>
                        <td class="p-3 border"><?= $row["cityid"] ?> - <?= htmlspecialchars($city_options[$row["cityid"]] ?? "Unknown") ?></td>
                        <td class="p-3 border"><?= htmlspecialchars($row["tour_name"]) ?></td>
                        <td class="p-3 border"><?= nl2br(htmlspecialchars($row["description"])) ?></td>
                        <td class="p-3 border text-center"><?= $row["duration_days"] ?></td>
                        <td class="p-3 border text-right"><?= number_format($row["price_per_person"]) ?></td>
                        <td class="p-3 border"><?= htmlspecialchars($row["season"]) ?></td>
                        <td class="p-3 border"><?= $row["created_at"] ?></td>
                        <td class="p-3 border text-center">
                            <a href="?edit=<?= $row["tourid"] ?>" class="text-blue-600 hover:underline mr-2">Edit</a> |
                            <a href="controllers/delete.php?delete=<?= $row["tourid"] ?>" class="text-red-600 hover:underline ml-2" onclick="return confirm('Are you sure you want to delete this tour?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Add/Edit Form -->
        <div class="max-w-2xl mx-auto bg-white p-10 rounded-lg shadow-md form-container">
            <h2 class="text-2xl font-bold mb-6 text-center"><?= $edit ? "Edit Tour #" . $edit["tourid"] : "Add New Tour" ?></h2>
            <form method="POST" action="<?= $edit ? 'controllers/edittour.php' : 'controllers/addtour.php' ?>" class="space-y-4">
                <input type="hidden" name="tourid" value="<?= $edit["tourid"] ?? '' ?>">
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
                    <label class="block mb-1 font-semibold" for="tour_name">Tour Name</label>
                    <input id="tour_name" name="tour_name" type="text" value="<?= htmlspecialchars($edit["tour_name"] ?? '') ?>" class="w-full border border-gray-300 px-3 py-2 rounded" required />
                </div>
                <div>
                    <label class="block mb-1 font-semibold" for="description">Description</label>
                    <textarea id="description" name="description" class="w-full border border-gray-300 px-3 py-2 rounded" rows="4"><?= htmlspecialchars($edit["description"] ?? '') ?></textarea>
                </div>
                <div>
                    <label class="block mb-1 font-semibold" for="duration_days">Duration (days)</label>
                    <input id="duration_days" name="duration_days" type="number" value="<?= $edit["duration_days"] ?? '' ?>" class="w-full border border-gray-300 px-3 py-2 rounded" required />
                </div>
                <div>
                    <label class="block mb-1 font-semibold" for="price_per_person">Price per Person</label>
                    <input id="price_per_person" name="price_per_person" type="number" value="<?= $edit["price_per_person"] ?? '' ?>" class="w-full border border-gray-300 px-3 py-2 rounded" required />
                </div>
                <div>
                    <label class="block mb-1 font-semibold" for="season">Season</label>
                    <select id="season" name="season" class="w-full border border-gray-300 px-3 py-2 rounded" required>
                        <option value="Spring" <?= ($edit["season"] ?? '') == 'Spring' ? "selected" : "" ?>>Spring</option>
                        <option value="Summer" <?= ($edit["season"] ?? '') == 'Summer' ? "selected" : "" ?>>Summer</option>
                        <option value="Fall" <?= ($edit["season"] ?? '') == 'Fall' ? "selected" : "" ?>>Fall</option>
                        <option value="Winter" <?= ($edit["season"] ?? '') == 'Winter' ? "selected" : "" ?>>Winter</option>
                    </select>
                </div>
                <div class="flex justify-between pt-4">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                        <?= $edit ? "Update Tour" : "Add Tour" ?>
                    </button>
                </div>
            </form>
        </div>

        <div class="text-center mt-10">
            <button type="button" onclick="window.location.href='admindashboard.php'" class="bg-gray-600 text-white px-6 py-2 rounded hover:bg-gray-700 transition btn-back">
                Back to Dashboard
            </button>
        </div>
    </div>
</body>
</html>