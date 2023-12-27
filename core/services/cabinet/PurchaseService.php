<?php

namespace core\services\cabinet;

use core\entities\cabinet\purchase;
use core\entities\PurchaseItem;
use core\forms\cabinet\PurchaseEditForm;
use core\forms\users\PurchaseCreateForm;
use core\repositories\cabinet\PurchaseRepository;
use core\services\TransactionService;

class PurchaseService
{
    private $purchases;
    private $transaction;

    public function __construct(PurchaseRepository $purchases, TransactionService $transaction)
    {
        $this->purchases = $purchases;
        $this->transaction = $transaction;
    }

    public function create(PurchaseCreateForm $form): void
    {
        $purchase = Purchase::create(
            $form->title,
            $form->budget,
            $form->description,
            $form->status
        );

        $this->transaction->wrap(function () use ($form, $purchase) {
            foreach ($form->items as $item) {
                $purchase->assignmentItems($item);
            }

            $this->purchases->save($purchase);
        });
    }

    public function edit(Purchase $purchase, PurchaseEditForm $form): void
    {

        if ($purchase->status === Purchase::STATUS_ACTIVE && (int)$form->status === Purchase::STATUS_DRAFT) {
            $form->status = Purchase::STATUS_ACTIVE;
        }

        $purchase->edit(
            $form->title,
            $form->budget,
            $form->description,
            $form->status
        );

        $this->transaction->wrap(function () use ($form, $purchase) {
            PurchaseItem::deleteAll(['purchase_id' => $purchase->id]);

            if (!empty($form->items)) {
                foreach ($form->items as $item) {
                    $purchase->assignmentItems($item);
                }
            }

            $this->purchases->save($purchase);

        });
    }
}

