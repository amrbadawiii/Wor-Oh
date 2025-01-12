<?php

namespace App\Application\Models;

class Invoice
{
    private int $id;
    private int $warehouseId;
    private Warehouse $warehouse;
    private int $customerId;
    private Customer $customer;
    private ?int $orderId;
    private ?Order $order;
    private string $invoiceNumber;
    private string $invoiceDate;
    private ?string $dueDate;
    private string $invoiceStatus;
    private float $totalAmount;
    private float $paidAmount;
    private float $balanceDue;
    private ?string $notes;
    private ?int $createdBy;
    private ?User $createdByUser;
    private ?int $updatedBy;
    private ?User $updatedByUser;

    public function __construct(
        int $id,
        int $warehouseId,
        Warehouse $warehouse,
        int $customerId,
        Customer $customer,
        ?int $orderId,
        ?Order $order,
        string $invoiceNumber,
        string $invoiceDate,
        ?string $dueDate,
        string $invoiceStatus,
        float $totalAmount,
        float $paidAmount,
        float $balanceDue,
        string $notes,
        ?int $createdBy,
        ?User $createdByUser,
        ?int $updatedBy,
        ?User $updatedByUser
    ) {
        $this->id = $id;
        $this->warehouseId = $warehouseId;
        $this->warehouse = $warehouse;
        $this->customerId = $customerId;
        $this->customer = $customer;
        $this->orderId = $orderId;
        $this->order = $order;
        $this->invoiceNumber = $invoiceNumber;
        $this->invoiceDate = $invoiceDate;
        $this->dueDate = $dueDate;
        $this->invoiceStatus = $invoiceStatus;
        $this->totalAmount = $totalAmount;
        $this->paidAmount = $paidAmount;
        $this->balanceDue = $balanceDue;
        $this->notes = $notes;
        $this->createdBy = $createdBy;
        $this->createdByUser = $createdByUser;
        $this->updatedBy = $updatedBy;
        $this->updatedByUser = $updatedByUser;
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }
    public function getWarehouseId(): int
    {
        return $this->warehouseId;
    }
    public function getWarehouse(): Warehouse
    {
        return $this->warehouse;
    }
    public function getCustomerId(): int
    {
        return $this->customerId;
    }
    public function getCustomer(): Customer
    {
        return $this->customer;
    }
    public function getOrderId(): ?int
    {
        return $this->orderId;
    }
    public function getOrder(): ?Order
    {
        return $this->order;
    }
    public function getInvoiceNumber(): string
    {
        return $this->invoiceNumber;
    }
    public function getInvoiceDate(): string
    {
        return $this->invoiceDate;
    }
    public function getDueDate(): ?string
    {
        return $this->dueDate;
    }
    public function getInvoiceStatus(): string
    {
        return $this->invoiceStatus;
    }
    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }
    public function getPaidAmount(): float
    {
        return $this->paidAmount;
    }
    public function getBalanceDue(): float
    {
        return $this->balanceDue;
    }
    public function getNotes(): ?string
    {
        return $this->notes;
    }
    public function getCreatedBy(): ?int
    {
        return $this->createdBy;
    }
    public function getCreatedByUser(): ?User
    {
        return $this->createdByUser;
    }
    public function getUpdatedBy(): ?int
    {
        return $this->updatedBy;
    }
    public function getUpdatedByUser(): ?User
    {
        return $this->updatedByUser;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'warehouse_id' => $this->warehouseId,
            'warehouse' => $this->warehouse->toArray(),
            'customer_id' => $this->customerId,
            'customer' => $this->customer->toArray(),
            'order_id' => $this->orderId,
            'order' => $this->order ? $this->order->toArray() : null,
            'invoice_number' => $this->invoiceNumber,
            'invoice_date' => $this->invoiceDate,
            'due_date' => $this->dueDate,
            'invoice_status' => $this->invoiceStatus,
            'total_amount' => $this->totalAmount,
            'paid_amount' => $this->paidAmount,
            'balance_due' => $this->balanceDue,
            'notes' => $this->notes,
            'created_by' => $this->createdBy,
            'created_by_user' => $this->createdByUser ? $this->createdByUser->toArray() : null,
            'updated_by' => $this->updatedBy,
            'updated_by_user' => $this->updatedByUser ? $this->updatedByUser->toArray() : null,
        ];
    }
}
