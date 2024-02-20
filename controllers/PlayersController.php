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

        // Check if the model is loaded with POST data and if it's successfully saved
        
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect('index');
            }
        

        return $this->render('create', [
            'model' => $model,
            'teams' => $teams,
        ]);
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
