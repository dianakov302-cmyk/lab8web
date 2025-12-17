<?php
// Отримуємо JSON з локального файлу
$jsonData = file_get_contents('people.json');
if ($jsonData === false) {
    die("Не вдалося відкрити файл people.json");
}

// Декодуємо JSON у PHP об'єкти
$people = json_decode($jsonData);
if ($people === null) {
    die("Помилка при декодуванні JSON");
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Список людей</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
<h2>Список людей</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Ім'я</th>
        <th>Username</th>
        <th>Email</th>
        <th>Телефон</th>
        <th>Веб-сайт</th>
        <th>Адреса</th>
        <th>Координати</th>
        <th>Компанія</th>
        <th>CatchPhrase</th>
        <th>BS</th>
    </tr>
    <?php foreach ($people as $person): ?>
        <tr>
            <td><?= htmlspecialchars($person->id ?? '') ?></td>
            <td><?= htmlspecialchars($person->name ?? '') ?></td>
            <td><?= htmlspecialchars($person->username ?? '') ?></td>
            <td><?= htmlspecialchars($person->email ?? '') ?></td>
            <td><?= htmlspecialchars($person->phone ?? '') ?></td>
            <td><?= htmlspecialchars($person->website ?? '') ?></td>
            <td>
                <?= htmlspecialchars(
                    isset($person->address)
                        ? ($person->address->street . ', ' . $person->address->suite . ', ' . $person->address->city . ', ' . $person->address->zipcode)
                        : ''
                ) ?>
            </td>
            <td>
                <?= htmlspecialchars(
                    isset($person->address->geo)
                        ? ($person->address->geo->lat . ', ' . $person->address->geo->lng)
                        : ''
                ) ?>
            </td>
            <td><?= htmlspecialchars(isset($person->company) ? $person->company->name : '') ?></td>
            <td><?= htmlspecialchars(isset($person->company) ? $person->company->catchPhrase : '') ?></td>
            <td><?= htmlspecialchars(isset($person->company) ? $person->company->bs : '') ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
