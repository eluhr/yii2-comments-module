<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2020 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dmstr\comments\widgets;

use dmstr\comments\assets\CommentAssetBundle;
use  dmstr\comments\models\Comment;
use dmstr\comments\Module;
use yii\base\Widget;

/**
 *
 * --- PUBLIC ---
 *
 * @property string $key
 * @property int $maxDepth
 * @property string $moduleId
 * @property string $editorRoleName
 */
class Comments extends Widget
{
    /**
     * @var string $moduleId
     */
    public $moduleId = 'comment';

    /**
     * @var string $key
     */
    public $key;

    /**
     * @var int $maxDepth
     */
    public $maxDepth = 3;

    public function run(): string
    {
        /** @var Module $module */
        $module = \Yii::$app->getModule($this->moduleId);
        CommentAssetBundle::register(\Yii::$app->controller->view);
        return $this->render('comments.twig', [
            'comments' => Comment::commentsByKey($this->key),
            'model' => new Comment([
                'key' => $this->key
            ]),
            'maxDepth' => $this->maxDepth,
            'moduleId' => $this->moduleId,
            'editorRoleName' => $module->editorRoleName
        ]);
    }
}
