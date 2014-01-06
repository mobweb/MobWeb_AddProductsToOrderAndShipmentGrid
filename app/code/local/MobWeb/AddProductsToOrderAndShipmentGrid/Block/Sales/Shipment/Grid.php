<?php
class MobWeb_AddProductsToOrderAndShipmentGrid_Block_Sales_Shipment_Grid extends Mage_Adminhtml_Block_Sales_Shipment_Grid
{
    public function setCollection($collection)
    {
        $collection->getSelect()->join(
            array('shipment_item' => $collection->getTable('sales/shipment_item')),
            'main_table.entity_id = shipment_item.parent_id',
            array('sku' => new Zend_Db_Expr('group_concat(shipment_item.sku SEPARATOR "<br />")'))
        );
        $collection->getSelect()->group('main_table.entity_id');

        parent::setCollection($collection);
    }

    protected function _prepareColumns()
    {
        $this->addColumnAfter('sku',
            array(
                'header'    => Mage::helper('Sales')->__('SKU'),
                'index'     => 'sku',
                'type'      => 'text',
            ),
            'order_created_at'
        );

        return parent::_prepareColumns();
    }
}