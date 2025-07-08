<?php
// Database connection
require_once '../../includes/config.php';



// Function to fetch sacraments report
function fetchSacramentsReport($conn, $start_date = null, $end_date = null) {
    $query = "
        (
            SELECT 
                'Baptism' AS sacrament,
                b.baptism_date AS sacrament_date,
                CONCAT(p.first_name, ' ', p.middle_name, ' ', p.last_name) AS person_name,
                p.dob AS date_of_birth,
                CONCAT(father.first_name, ' ', father.last_name) AS father_name,
                CONCAT(mother.first_name, ' ', mother.last_name) AS mother_name,
                CONCAT(pr.first_name, ' ', pr.last_name) AS priest_name,
                CONCAT(s1.first_name, ' ', s1.last_name) AS sponsor1,
                CONCAT(s2.first_name, ' ', s2.last_name) AS sponsor2
            FROM 
                baptism b
            JOIN person p ON b.person_id = p.person_id
            LEFT JOIN parent father ON b.father_id = father.parent_id
            LEFT JOIN parent mother ON b.mother_id = mother.parent_id
            LEFT JOIN priest pr ON b.priest_id = pr.priest_id
            LEFT JOIN sponsor s1 ON b.sponsor1_id = s1.sponsor_id
            LEFT JOIN sponsor s2 ON b.sponsor2_id = s2.sponsor_id
        )
        UNION ALL
        (
            SELECT 
                'Confirmation' AS sacrament,
                c.confirmation_date AS sacrament_date,
                CONCAT(p.first_name, ' ', p.middle_name, ' ', p.last_name) AS person_name,
                p.dob AS date_of_birth,
                NULL AS father_name,
                NULL AS mother_name,
                CONCAT(pr.first_name, ' ', pr.last_name) AS priest_name,
                CONCAT(s.first_name, ' ', s.last_name) AS sponsor1,
                NULL AS sponsor2
            FROM 
                confirmation c
            JOIN person p ON c.person_id = p.person_id
            LEFT JOIN priest pr ON c.priest_id = pr.priest_id
            LEFT JOIN sponsor s ON c.sponsor_id = s.sponsor_id
        )
        UNION ALL
        (
            SELECT 
                'Marriage' AS sacrament,
                m.marriage_date AS sacrament_date,
                CONCAT(groom.first_name, ' ', groom.middle_name, ' ', groom.last_name) AS person_name,
                groom.dob AS date_of_birth,
                NULL AS father_name,
                NULL AS mother_name,
                CONCAT(pr.first_name, ' ', pr.last_name) AS priest_name,
                CONCAT(s1.first_name, ' ', s1.last_name) AS sponsor1,
                CONCAT(s2.first_name, ' ', s2.last_name) AS sponsor2
            FROM 
                marriage m
            JOIN person groom ON m.groom_id = groom.person_id
            JOIN person bride ON m.bride_id = bride.person_id
            LEFT JOIN priest pr ON m.priest_id = pr.priest_id
            LEFT JOIN sponsor s1 ON m.sponsor1_id = s1.sponsor_id
            LEFT JOIN sponsor s2 ON m.sponsor2_id = s2.sponsor_id
        )
    ";

    // Add optional date range filter
    if ($start_date && $end_date) {
        $query .= " WHERE sacrament_date BETWEEN '$start_date' AND '$end_date'";
    }

    $query .= " ORDER BY sacrament_date ASC";

    return $conn->query($query);
}

// Handle form submission for date filtering
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;

// Fetch report data
$report_data = fetchSacramentsReport($conn, $start_date, $end_date);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sacraments Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Sacraments Report</h2>

<!-- Date Filter Form -->
<form method="GET" action="sacraments_report.php">
    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" value="<?= htmlspecialchars($start_date) ?>">
    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date" value="<?= htmlspecialchars($end_date) ?>">
    <button type="submit">Filter</button>
</form>

<br>

<!-- Report Table -->
<table>
    <tr>
        <th>Sacrament</th>
        <th>Date</th>
        <th>Person Name</th>
        <th>Date of Birth</th>
        <th>Parents/Sponsors</th>
        <th>Priest Name</th>
        <th>Sponsor 1</th>
        <th>Sponsor 2</th>
    </tr>
    <?php if ($report_data->num_rows > 0): ?>
        <?php while($row = $report_data->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['sacrament']) ?></td>
                <td><?= htmlspecialchars($row['sacrament_date']) ?></td>
                <td><?= htmlspecialchars($row['person_name']) ?></td>
                <td><?= htmlspecialchars($row['date_of_birth']) ?></td>
                <td>
                    <?php if ($row['father_name']): ?>
                        Father: <?= htmlspecialchars($row['father_name']) ?>, Mother: <?= htmlspecialchars($row['mother_name']) ?>
                    <?php else: ?>
                        Sponsor: <?= htmlspecialchars($row['sponsor1']) ?>
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($row['priest_name']) ?></td>
                <td><?= htmlspecialchars($row['sponsor1']) ?></td>
                <td><?= htmlspecialchars($row['sponsor2']) ?></td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="8">No records found.</td>
        </tr>
    <?php endif; ?>
</table>

</body>
</html>

<?php
$conn->close();
?>
