<?php

namespace core\forms\users;

use core\entities\cabinet\Purchase;
use core\entities\Nomenclature;
use yii\base\Model;

class NomenclatureForm extends Model
{
    public $name;
    public $abbreviation;

    public function __construct(Nomenclature $nomenclature, $config = [])
    {
        $this->name = $nomenclature->name;
        $this->abbreviation = $nomenclature->abbreviation;

        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['nomenclatures'], 'each', 'rule' => ['string']],
        ];
    }

}



