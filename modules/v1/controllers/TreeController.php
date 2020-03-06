<?php


namespace app\modules\v1\controllers;


class TreeController
{

    public $modelClass = 'app\modules\icase\models\InsClassification';

    protected function insert($item) {
//        if ($this->isEmpty()) {
//            // правило 1
//            $this->root = $node;
//        }
//        else {
//            // правило 1
//            $this->insertNode($node, $this->root);
//        }
    }

    protected function insertNode($node, &$subtree) {
        if ($subtree === null) {
            // правило 2
            $subtree = $node;
        }
        else {
            if ($node->value > $subtree->value) {
                // правило 2b
                $this->insertNode($node, $subtree->right);
            }
            else if ($node->value < $subtree->value) {
                // правило 2c
                $this->insertNode($node, $subtree->left);
            }
            else {
                // исключаем повторы, правило 2d
            }
        }
    }
}