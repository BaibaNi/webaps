<?php
//echo "<pre>";
$search = $_GET["search"] ?? ""; //$search = implode($_GET);
$limit = 20;
$offset = $_GET["offset"] ?? 0;
$allData = json_decode(file_get_contents("https://data.gov.lv/dati/lv/api/3/action/datastore_search?q={$search}&offset={$offset}&resource_id=25e80bf3-f107-4ab4-89ef-251b5b9374e9&limit={$limit}"));

//OPTION --> if not using $allData->result->records further in the table
//$data = [];
//foreach ($allData as $i => $item){ // $allData->result->records
//    $data[$i] = $item;
//}

?>

<html>
<head style="font-size: larger"> <b>COMPANY REGISTER</b></head>
<body style="font-family: Tahoma; text-align: center">
    <form method="get" action="/">
        <input name="search" value=""/>
        <button type="submit">Search</button>
    </form>

    <table border="solid" style="font-size: small">
        <tr>
            <th>Company name</th>
            <th>Type</th>
            <th>Address</th>
        </tr>
<!--        --><?php //foreach ($data["result"]->records as $organization): ?>
        <?php foreach ($allData->result->records as $organization): ?>
            <tr>
                <td><?php echo $organization->name; ?></td>
                <td><?php echo $organization->type; ?></td>
                <td><?php echo $organization->address; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<br>
    <form method="get" action="/">

        <?php if($offset > 0): ?>
        <button type="submit" name="offset" value="<?php echo $offset - $limit; ?>"> ← Previous page </button>
        <?php endif; ?>

        <?php if(count($allData->result->records) >= $limit): ?>
        <button type="submit" name="offset" value="<?php echo $offset + $limit; ?>"> Next page → </button>
        <?php endif; ?>
    </form>
</body>
</html>
