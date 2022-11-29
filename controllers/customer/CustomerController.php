<?php

include_once(DOC_ROOT_PATH . "/backend/models/Customer.php");
include_once(DOC_ROOT_PATH . "/backend/interfaces/ICustomer.php");

class CustomerController
{
    private ICustomer $_customer;
    public function __construct(ICustomer $customer)
    {
        $this->_customer = $customer;
    }
    //Query Response
    public function getAllCustomers(): void
    {
        $result = $this->_customer->all();
        $num = $result->rowCount();

        //Check for data
        if ($num > 0) {
            $customer_arr = array();
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $customer_item = array(
                    'customer_id' => $customer_id,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'phone' => $phone,
                    'country' => $country,
                );
                array_push($customer_arr, $customer_item);
            }
            echo json_encode($customer_arr);
        } else {
            //No customers
            echo json_encode(
                array('message' => 'No Customer Found')
            );
        }
    }

    public function getCustomer(int $id): void
    {
        $result = $this->_customer->customer($id);
        $num = $result->rowCount();

        if ($num > 0) {
            $customer_arr = $result->fetch(PDO::FETCH_ASSOC);
            echo json_encode($customer_arr);
        } else {
            echo json_encode(
                array('message' => 'No Customer Found')
            );
        }
    }

    public function createCustomer($customer): void
    {
        if ($this->validate($customer) == false) {
            $data = $this->convertObj($customer);
            $result = $this->_customer->create($data);
            echo json_encode($result);
        } else {
            http_response_code(400);
            echo json_encode(
                array('message' => 'Customer data cannot be empty')
            );
        }
    }

    public function updateCustomer(int $id, $customer): void
    {
        if ($this->validate($customer) == false) {
            $data = $this->convertObj($customer);
            $result = $this->_customer->update($id, $data);
            echo json_encode($result);
        } else {
            http_response_code(400);
            echo json_encode(
                array('message' => 'Customer data cannot be empty.')
            );
        }
    }

    public function deleteCustomer(int $id): void
    {
        if ($id > 0) {
            $result = $this->_customer->delete($id);
            http_response_code(200);
            echo json_encode($result);
        } else {
            http_response_code(400);
            echo json_encode(
                array('message' => 'ID cannot be zero.')
            );
        }
    }

    private function validate($customer): bool
    {
        if ($customer->first_name == "") {
            return true;
        }
        if ($customer->last_name == "") {
            return true;
        }
        if ($customer->country == "") {
            return true;
        }
        return false;
    }
    private function convertObj($obj): Customer
    {
        $customer = new Customer();
        $customer->first_name = $obj->first_name;
        $customer->last_name = $obj->last_name;
        $customer->phone = $obj->phone;
        $customer->country = $obj->country;
        return $customer;
    }
}
