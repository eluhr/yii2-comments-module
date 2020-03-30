<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2020 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dmstr\comments\controllers;

use dmstr\comments\Module;
use http\Exception\InvalidArgumentException;
use project\modules\crud\models\Comment;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 *
 * --- PUBLIC ---
 *
 * @property Module $module
 */
class ModifyController extends Controller
{
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors['verbs'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'add' => ['POST'],
                'remove' => ['POST']
            ]
        ];
        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'matchCallback' => function () {
                        return \Yii::$app->user->can($this->module->editorRoleName);
                    }
                ]
            ]
        ];
        return $behaviors;
    }

    /**
     * @return Response
     */
    public function actionAdd(): Response
    {
        $model = new Comment();

        if (!$model->load(\Yii::$app->request->post()) || !$model->validate() || !$model->save()) {
            throw new InvalidArgumentException(\Yii::t('comment', 'Something went wrong while adding the comment.'));
        }
        return $this->goBack();
    }

    /**
     * @param string $id
     *
     * @throws HttpException
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     * @return Response
     */
    public function actionRemove(string $id): Response
    {
        $model = Comment::findOne($id);

        if ($model === null) {
            throw new NotFoundHttpException(\Yii::t('comment', 'Comment not found.'));
        }

        if ($model->delete() === false) {
            throw new HttpException(500, \Yii::t('comment', 'Error while deleting this comment.'));
        }

        return $this->goBack();
    }
}
