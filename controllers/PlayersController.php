<?php

namespace app\controllers;

use yii\web\NotFoundHttpException;
use yii\web\Controller;
use app\models\players;
use app\models\Teams;
use Yii;

/**
 * PlayersController implements the CRUD actions for players model.
 */
class PlayersController extends Controller
{
    public function actionIndex()
    {
        $sql = "SELECT * FROM players";
        // findBySql runs the command and ->all() will return all the results from the query
        $players = players::findBySql($sql)->all();

        return $this->render('index', [
            'players' => $players,
        ]);
    }
    public function actionCreate()
    {
        $model = new players();
        $sql = "SELECT * FROM teams";
        $teams = Teams::findBySql($sql)->all();

        /*
        $model->load(Yii::$app->request->post()): this statement will load the post data into the model
        $model->save(): this statement saves it to database.
        if there is no post request found then we simply render the create form.
        */

        // Check if their is a post request
        if (Yii::$app->request->post()) {
            // Create a new session variable or retrieve the existing one
            $players = Yii::$app->session->get('players', []);

            // Add the newly created player to the session variable
            $model->load(Yii::$app->request->post());
            $players[] = $model->attributes;

            // Set the session variable with the updated player array
            Yii::$app->session->set('players', $players);
            return $this->redirect('create');
        }
        return $this->render('create', [
            'model' => $model,
            'teams' => $teams,
        ]);
    }
    public function actionRemove($index)
{
    // Retrieve the players array from the session
    $players = Yii::$app->session->get('players', []);

    // Remove the player at the specified index from the session array
    unset($players[$index]);

    // Save the updated players array back to the session
    Yii::$app->session->set('players', $players);

    // Redirect back to the view-players page
    return $this->redirect('create');
}

    public function actionSaveToDatabase()
    {
        // Retrieve the players array from the session
        $players = Yii::$app->session->get('players', []);

        // Save each player to the database
        foreach ($players as $player) {
            $model = new players();
            $model->attributes = $player;
            if (!$model->save()) {
                Yii::$app->session->setFlash('error', 'Failed to save players to the database.');
                return $this->redirect('create');
            }
        }

        // Clear the players array from the session after saving to the database
        Yii::$app->session->remove('players');
        return $this->redirect('index');
    }

    public function actionDelete($id)
    {
        $player = players::findOne($id);

        if (!$player) {
            throw new NotFoundHttpException('The requested player does not exist.');
        }

        $player->delete();

        return $this->redirect(['index']); // Redirect to the index page after deletion
    }
    
    public function actionUpdate($id)
    {
        $player = players::findOne($id);
        $sql = "SELECT * FROM teams";
        $teams = Teams::findBySql($sql)->all();
        if (!$player) {
            throw new NotFoundHttpException('The requested player does not exist.');
        }

        if ($player->load(Yii::$app->request->post()) && $player->save()) {
            // Redirect to view the newly created player or to another page
            return $this->redirect('index');
        }

        return $this->render('update', ['player' => $player, 'teams' => $teams]);
    }
}
