<?php
namespace common\models;

class Status
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    public $id;
    public $label;

    public function __construct($id = null)
    {
        if ($id !== null) {
            $this->id = $id;
            $this->label = $this->getLabel($id);
        }
    }

    public static function labels()
    {
        return [
            self::STATUS_ACTIVE => '已审核',
            self::STATUS_INACTIVE => '未审核',
        ];
    }

    public function getLabel($id)
    {
        $labels = self::labels();
        return isset($labels[$id]) ? $labels[$id] : null;
    }

}
