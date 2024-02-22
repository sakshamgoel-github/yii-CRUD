<h1>Add a new Player</h1>
<div class="container">
    <form method="post">
        <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">
        <div class="form-group">
            <label for="player-name">Name</label>
            <input type="text" id="player-name" name="players[name]" class="form-control" maxlength="50" required>
        </div>

        <div class="form-group">
            <label>Gender</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="gender-male" name="players[gender]" value="M" required>
                <label class="form-check-label" for="gender-male">Male</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="gender-female" name="players[gender]" value="F" required>
                <label class="form-check-label" for="gender-female">Female</label>
            </div>
        </div>

        <div class="form-group">
            <label for="player-team">Team</label>
            <select id="player-team" name="players[team]" class="form-control" required>
                <?php foreach ($teams as $t) { ?>
                    <option value="<?= $t['id'] ?>"><?= $t['id'] ?> - <?= $t['name'] ?></option>
                <?php } ?>
            </select>
        </div>
        

        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>

<?php
use yii\helpers\Html;
// Retrieve the players array from the session
$players = Yii::$app->session->get('players', []);

if (!empty($players)) :
?>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Team</th>
                <th>Remove</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($players as $index => $player) : ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= Html::encode($player['name']) ?></td>
                    <td><?= Html::encode($player['gender']) ?></td>
                    <td><?= Html::encode($player['team']) ?></td>
                    <td>
                        <?= Html::a('Remove', ['players/remove', 'index' => $index], ['class' => 'btn btn-danger']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= Html::a('Save Players to Database', ['players/save-to-database'], ['class' => 'btn btn-success']) ?>
<?php endif; ?>




