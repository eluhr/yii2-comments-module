<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2020 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dmstr\comments\models\query;

use \yii\db\ActiveQuery;
use \dmstr\comments\models\Comment as CommentModel;

/**
 * Class CommentQuery
 * @package project\modules\crud\models
 * @see \dmstr\comments\models\Comment
 */
class Comment extends ActiveQuery
{

    /**
     * @return self
     */
    public function ordered(): self
    {
        return $this->orderBy(['created_at' => SORT_DESC]);
    }
    /**
     * @return self
     */
    public function orderReversed(): self
    {
        return $this->orderBy(['created_at' => SORT_ASC]);
    }
    /**
     * @param null|string $db
     * @return CommentModel[]|array
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * @param null|string $db
     * @return CommentModel|null|array
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
