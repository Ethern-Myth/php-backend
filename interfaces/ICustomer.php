<?php
include_once(DOC_ROOT_PATH . "/backend/models/Customer.php");
interface ICustomer
{
    public function all();
    public function customer(int $id);
    public function create(Customer $customer);
    public function update(int $id, Customer $customer);
    public function delete(int $id);
}
