<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2020 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dmstr\comments\models;

use dmstr\comments\models\query\Comment as CommentQuery;
use yii\db\ActiveQuery;
use \yii\db\ActiveRecord;
use Yii;

/**
 * Class Comment
 * @package project\modules\crud\models
 *
 * @property ActiveQuery $comments
 * @property ActiveQuery $parentComment
 * @property int $id
 * @property string $key
 */
class Comment extends ActiveRecord
{
    public static function commentsByKey(string $key, int $parentId = null, bool $reverseOrder = false): array
    {
        $query = self::find()->andWhere(['key' => $key])->andWhere(['parent_comment_id' => $parentId]);
        if ($reverseOrder) {
            $query->orderReversed();
        } else {
            $query->ordered();
        }
        return $query->all();
    }

    public function childComments(): array
    {
        return self::commentsByKey($this->key, $this->id, true);
    }

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'stg_comment';
    }


    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        $rules = parent::rules();
        $rules[] = [['parent_comment_id'], 'integer'];
        $rules[] = [['key', 'name', 'message'], 'required'];
        $rules[] = [['message'], 'string'];
        $rules[] = [['created_at', 'updated_at'], 'safe'];
        $rules[] = [['key'], 'string', 'max' => 45];
        $rules[] = [['name'], 'string', 'max' => 80];
        $rules[] = [['parent_comment_id'], 'exist', 'skipOnError' => true, 'targetClass' => self::class, 'targetAttribute' => ['parent_comment_id' => 'id']];

        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $attributeLabels = parent::attributeLabels();

        $attributeLabels['parent_comment_id'] = Yii::t('comments', 'Parent Comment ID');
        $attributeLabels['key'] = Yii::t('comments', 'Key');
        $attributeLabels['name'] = Yii::t('comments', 'Name');

        return $attributeLabels;
    }

    /**
     * @return ActiveQuery
     */
    public function getParentComment(): ActiveQuery
    {
        return $this->hasOne(self::className(), ['id' => 'parent_comment_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getComments(): ActiveQuery
    {
        return $this->hasMany(self::className(), ['parent_comment_id' => 'id']);
    }


    /**
     * @return CommentQuery the active query used by this AR class.
     */
    public static function find(): CommentQuery
    {
        return new CommentQuery(static::class);
    }
}
