<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2020 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * --- PUBLIC ---
 *
 * @property string $editorRoleName
 */
namespace dmstr\comments;

class Module extends \yii\base\Module
{
    /**
     * @var string $editorRoleName
     */
    public $editorRoleName = 'Editor';
}
