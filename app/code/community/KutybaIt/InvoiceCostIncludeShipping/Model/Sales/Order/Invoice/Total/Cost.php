<?php

class KutybaIt_InvoiceCostIncludeShipping_Model_Sales_Order_Invoice_Total_Cost extends Mage_Sales_Model_Order_Invoice_Total_Cost
{
    /**
     * Collect total cost of invoiced items
     * Add cost of shipping items to customer
     *
     * @param Mage_Sales_Model_Order_Invoice $invoice
     * @return Mage_Sales_Model_Order_Invoice_Total_Cost
     */
    public function collect(Mage_Sales_Model_Order_Invoice $invoice)
    {
        parent::collect($invoice);

        $costs = [
            "default" => 15,
            "kurier_kurier" => 11.5,
            "flatrate_flatrate" => 7,
        ];

        $shippingMethod = $invoice->getOrder()->getShippingMethod();
        $correctedCost = $invoice->getBaseCost();

        if (isset($costs[$shippingMethod])) {
            $correctedCost += $costs[$shippingMethod];
        } else {
            $correctedCost += $costs["default"];
        }

        $invoice->setBaseCost($correctedCost);
        return $this;
    }
}