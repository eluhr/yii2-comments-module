<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2020 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dmstr\comments\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;
use yii\web\YiiAsset;

class CommentAssetBundle extends AssetBundle
{
    public $sourcePath = __DIR__ . DIRECTORY_SEPARATOR . '/web';

    public $js = [
        'js/reply.js'
    ];

    public $depends = [
        JqueryAsset::class,
        \rmrevin\yii\fontawesome\AssetBundle::class,
        YiiAsset::class
    ];
}
