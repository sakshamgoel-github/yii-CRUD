<?php

use yii\helpers\Html;

$genderArray = ["M" => "Male", "F" => "Female"]
?>
<h1>List of All Players</h1>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Gender</th>
            <th scope="col">Team</th>
            <th scope="col">Update</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($players as $index => $player) : ?>
            <tr>
                <th scope="row"><?= $index + 1 ?></th>
                <td><?= $player->id ?></td>
                <td><?= $player->name ?></td>
                <td><?= $genderArray[$player->gender] ?></td>
                <td><?= $player->team ?></td>
                <td>
                    <?= Html::a('Update', ['update', 'id' => $player->id], ['class' => 'btn btn-primary']) ?>
                </td>
                <td>
                    <?= Html::a('Delete', ['delete', 'id' => $player->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this player?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>