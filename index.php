<?php

require_once "vendor/autoload.php";
use App\CovidData;

$data = new CovidData('covid_19.csv');
$records = $data->getRecords();

if ($_GET)
{
    $records = $data->searchRecords($_GET['search']);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>
<body>
<form>
<label>
    <input type="text" placeholder="Search for country" name="search">
    <input type="submit" value="Search" name="searchButton">
</label>
</form>
<table class="table">
        <tbody>
        <?php foreach($data->csvReader->getHeader() as $header): ?>
        <th> <?php echo mb_strimwidth($header, 0, 15);?></th>
        <?php endforeach; ?>
        <?php foreach ($records as $record): ?>
            <tr>
                <td><?php echo $record['Datums']; ?></td>
                <td> <?php echo $record['Valsts']; ?> </td>
                <td> <?php echo $record['14DienuKumulativaIncidence']; ?> </td>
                <td> <?php echo $record['Izcelosana']; ?> </td>
                <td> <?php echo $record['Pasizolacija']; ?> </td>
                <td> <?php echo $record['PersIrVakcParslSert_PasizolacijaLatvija']; ?> </td>
                <td> <?php echo $record['PersIrVakcParslSert_TestsPirmsIebrauksanasLV']; ?> </td>
                <td> <?php echo $record['PersIrVakcParslSert_TestsPecIebrauksanasLV']; ?> </td>
                <td> <?php echo $record['CitasPersonas_PasizolacijaLatvija']; ?> </td>
                <td> <?php echo $record['CitasPersonas_TestsPirmsIebrauksanasLV']; ?> </td>
                <td> <?php echo $record['CitasPersonas_TestsPecIebrauksanasLV']; ?> </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
