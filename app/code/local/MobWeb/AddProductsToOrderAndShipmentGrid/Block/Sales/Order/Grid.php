<?php
class MobWeb_AddProductsToOrderAndShipmentGrid_Block_Sales_Order_Grid extends Mage_Adminhtml_Block_Sales_Order_Grid
{
    public function setCollection($collection)
    {
        $collection->getSelect()->join(
            array('order_item' => $collection->getTable('sales/order_item')),
            'main_table.entity_id = order_item.order_id',
            array('sku' => new Zend_Db_Expr('group_concat(order_item.sku SEPARATOR "<br />")'))
        );
        $collection->getSelect()->group('main_table.entity_id');

        return parent::setCollection($collection);
    }

    protected function _prepareColumns()
    {
        $this->addColumnAfter('sku',
            array(
                'header'    => Mage::helper('Sales')->__('SKU'),
                'index'     => 'sku',
                'type'      => 'text',
            ),
            'created_at'
        );

        return parent::_prepareColumns();
    }
}