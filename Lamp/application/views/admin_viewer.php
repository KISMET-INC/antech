<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>
    <title>ADMIN</title>
</head>
<body>
    <h1> Welcome Dr. Moreland! </h2>
    <a href='/Lamp/index.php/estimate_controller/addtext'>add all hospitals </a>
    <a href='/Lamp/index.php/admin_controller/get_hospitals'>get all hospitals </a>
<br>
    <form action='/Lamp/index.php/admin_controller/get_completed_orders'>
        <button type='submit'>Get Completed ORders</button>
    </form>

    <? if($query !== NULL): ?>
    <table>
    <thead class="row">
        <tr>
            <? foreach ($query[0] as $key => $value): ?>
                <th><?= $key ?></th>
            <? endforeach ?>
        </tr>
            </thead>
        <? foreach ($query as $record): ?>
            <tr class="row">
                <?php $url = 'record/'. $record->antech_id ?>
                <td><?= $record->antech_id ?></td>
                <td><a href='<?= $url ?>'><?= $record->hospital_name ?></a></td>
                <td><?= $record->total_cost ?></td>
            </tr><!-- /.row -->
        <? endforeach ?>
    </table>
    <? endif ?>
</body>
</html>