<?php
namespace core\forms\users;

use core\entities\cabinet\Purchase;
use core\forms\CompositeForm;

/**
 * @property PurchaseItemForm[] $items
 * @property NomenclatureForm[] $nomenclatures
 */

class PurchaseCreateForm extends CompositeForm
{
    public $title;
    public $budget;
    public $status;
    public $description;

    public function __construct($config = [])
    {
        $this->status = Purchase::STATUS_DRAFT;
        $this->items = [new PurchaseItemForm()];

        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'budget'], 'required'],
            [['status'], 'integer'],
            [['description'], 'string'],
            [['budget'], 'number'],
            [['created_at'], 'safe'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    protected function internalForms(): array
    {
        return ['items'];
    }

}


