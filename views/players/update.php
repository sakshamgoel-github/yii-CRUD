<h1>Edit the Player</h1>
<div class="container">
    <form method="post">
        <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">
        <div class="form-group">
            <label for="player-name">Name</label>
            <input type="text" id="player-name" name="players[name]" class="form-control" maxlength="50" value="<?= $player->name ?>" required>
        </div>

        <div class="form-group">
            <label>Gender</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="gender-male" name="players[gender]" value="M" <?= $player->gender === 'M' ? 'checked' : '' ?> required>
                <label class="form-check-label" for="gender-male">Male</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="gender-female" name="players[gender]" value="F" <?= $player->gender === 'F' ? 'checked' : '' ?> required>
                <label class="form-check-label" for="gender-female">Female</label>
            </div>
        </div>

        <div class="form-group">
            <label for="player-team">Team</label>
            <select id="player-team" name="players[team]" class="form-control" required>
                <?php foreach ($teams as $t) { ?>
                    <option value="<?= $t['id'] ?>" <?= $player->team == $t['id'] ? 'selected' : '' ?>><?= $t['id'] ?> - <?= $t['name'] ?></option>
                <?php } ?>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
