<?php
include_once(DOC_ROOT_PATH . "/backend/models/Customer.php");
include_once(DOC_ROOT_PATH . "/backend/interfaces/ICustomer.php");

class CustomerService implements ICustomer
{
    /**
     * @return mixed
     */
    private $_conn;
    private string $_table;
    public function __construct($conn, $table)
    {
        $this->_conn = $conn;
        $this->_table = $table;
    }

    function all()
    {
        $query = "SELECT * FROM " . $this->_table;
        $stmt = $this->_conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    /**
     * @param mixed $id
     * @return mixed
     */
    function customer(int $id)
    {
        $query = "SELECT * FROM " . $this->_table . ' WHERE customer_id = :id';
        $stmt = $this->_conn->prepare($query);
        $stmt->bindParam('id', $id);
        $stmt->execute();
        return $stmt;
    }

    function create(Customer $customer)
    {
        if ($customer != null) {
            $query = "INSERT INTO " . $this->_table . " SET first_name = :name, last_name = :surname, phone = :phone, country = :country;";
            $stmt = $this->_conn->prepare($query);
            $stmt->bindParam('name', $customer->first_name);
            $stmt->bindParam('surname', $customer->last_name);
            $stmt->bindParam('phone', $customer->phone);
            $stmt->bindParam('country', $customer->country);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                $customer->customer_id = intval($this->_conn->lastInsertId());
                return $customer;
            }
            return new Customer;
        }
        return 0;
    }
    /**
     * @param int $id
     * @param Customer $customer
     * @return mixed
     */
    public function update(int $id, Customer $customer)
    {
        if ($id > 0 && $customer != null) {
            $query = "UPDATE " . $this->_table
                . " SET first_name = :name, last_name = :surname, phone = :phone, country = :country WHERE customer_id = :id";
            $stmt = $this->_conn->prepare($query);
            $stmt->bindParam('name', $customer->first_name);
            $stmt->bindParam('surname', $customer->last_name);
            $stmt->bindParam('phone', $customer->phone);
            $stmt->bindParam('country', $customer->country);
            $stmt->bindParam('id', $id);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                $customer->customer_id = $id;
                return $customer;
            }
            return new Customer;
        }
        return 0;
    }


    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        if ($id > 0) {
            $query = "DELETE FROM " . $this->_table . " WHERE customer_id = :id";
            $stmt = $this->_conn->prepare($query);
            $stmt->bindParam('id', $id);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                return array('message' => "Successfully removed");
            }
            return array('message' => "Something went wrong.");
        }
        return 0;
    }
}
