<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MX_Controller {

    private $userModel;

    function __construct() {
        parent::__construct();
            $this->load->model('user_model');
            $this->error = true;
            $this->error_code = 101;
            $this->message = "Invalid request format";
            $this->result=new stdClass();
            $this->requestParams = $_REQUEST;
            $this->headersParams = $this->input->request_headers();
            $this->userModel=new user_model;
    }
    
    
    //<--Add Category-->
    public function addCategory() {
        $requestParam = $this->requestParams ;
        if ($this->checkRequestFormat()):
            if ($this->required_input($requestParam, ['category_name', 'parent_id'])):
                $checkParentCat =$requestParam['parent_id']>0 ? $this->userModel->checkCategory($requestParam['parent_id']) : true;
                if ($checkParentCat):
                    $createCategory = $this->userModel->createCategory($requestParam);
                    if ($createCategory):
                        $this->error = false;
                        $this->error_code = 200;
                        $this->message = "Category Created";
                    else:
                        $this->error_code = 99;
                        $this->message = "Some Error Found";
                    endif;
                else:
                    $this->error_code = 102;
                    $this->message = "Invalid Parent Category";
                endif;
                
            endif;
        endif;
        $response = $this->makeJson();
        return $response;
    }
    //<--Add Category-->
    
    //<--Get Categories-->
    public function getCategories() {
        $requestParam = $this->requestParams ;
        if ($this->checkRequestFormat()):
            if ($this->required_input($requestParam, ['parent_id'])):
                $checkCategory =$requestParam['parent_id']>0 ? $this->userModel->checkCategory($requestParam['parent_id']) : true;
                if ($checkCategory):
                    $categories = $this->userModel->getCategories($requestParam);
                    if ($categories):
                        $this->error = false;
                        $this->error_code = 200;
                        $this->message = "Categories List";
                        $this->result = ['data'=>$categories];
                    else:
                        $this->error_code = 99;
                        $this->message = "Some Error Found";
                    endif;
                else:
                    $this->error_code = 102;
                    $this->message = "Invalid Parent Category";
                endif;
                
            endif;
        endif;
        $response = $this->makeJson();
        return $response;
    }
    //<--Get Categories-->
    
    //<--Update Category-->
    public function updateCategory() {
        $requestParam = $this->requestParams ;
        if ($this->checkRequestFormat()):
            if ($this->required_input($requestParam, [ 'category_id' ,'category_name'])):
                $checkCat = $this->userModel->checkCategory($requestParam['category_id']);
                if ($checkCat):
                    $updateCategory = $this->userModel->updateCategory($requestParam);
                    if ($updateCategory):
                        $this->error = false;
                        $this->error_code = 200;
                        $this->message = "Category Updated";
                    else:
                        $this->error_code = 99;
                        $this->message = "Some Error Found";
                    endif;
                else:
                    $this->error_code = 102;
                    $this->message = "Invalid Category";
                endif;
                
            endif;
        endif;
        $response = $this->makeJson();
        return $response;
    }
    //<--Update Category-->
    
    //<--Delete Category-->
    public function deleteCategory() {
        $requestParam = $this->requestParams ;
        if ($this->checkRequestFormat()):
            if ($this->required_input($requestParam, [ 'category_id'])):
                $checkCat = $this->userModel->checkCategory($requestParam['category_id']);
                if ($checkCat):
                    $deleteCategory = $this->userModel->deleteCategory($requestParam);
                    if ($deleteCategory):
                        $this->error = false;
                        $this->error_code = 200;
                        $this->message = "Category Deleted";
                    else:
                        $this->error_code = 99;
                        $this->message = "Some Error Found";
                    endif;
                else:
                    $this->error_code = 102;
                    $this->message = "Invalid Category";
                endif;
                
            endif;
        endif;
        $response = $this->makeJson();
        return $response;
    }
    //<--Delete Category-->
    
    
    //<--Add Product-->
    public function addProduct() {
        $requestParam = $this->requestParams ;
        if ($this->checkRequestFormat()):
            if ($this->required_input($requestParam, ['product_name', 'price' , 'parent_cat_id' , 'sub_cat_id'])):
                $addProduct = $this->userModel->addProduct($requestParam);
                if ($addProduct):
                    $this->error = false;
                    $this->error_code = 200;
                    $this->message = "Product Added";
                else:
                    $this->error_code = 99;
                    $this->message = "Some Error Found";
                endif;
            endif;
        endif;
        $response = $this->makeJson();
        return $response;
    }
    //<--Add Product-->
    
    //<--Get Products-->
    public function getProducts() {
        $products = $this->userModel->getProducts();
        if ($products):
            $this->error = false;
            $this->error_code = 200;
            $this->message = "Product List";
            $this->result = ['data'=>$products];
        else:
            $this->error_code = 99;
            $this->message = "Some Error Found";
        endif;  
        $response = $this->makeJson();
        return $response;
    }
    //<--Get Products-->
    
    //<--Update Product-->
    public function updateProduct() {
        $requestParam = $this->requestParams ;
        if ($this->checkRequestFormat()):
            if ($this->required_input($requestParam, [ 'product_id' ,'product_name' , 'price'])):
                $checkProduct = $this->userModel->checkProduct($requestParam['product_id']);
                if ($checkProduct):
                    $updateProduct = $this->userModel->updateProduct($requestParam);
                    if ($updateProduct):
                        $this->error = false;
                        $this->error_code = 200;
                        $this->message = "Product Updated";
                    else:
                        $this->error_code = 99;
                        $this->message = "Some Error Found";
                    endif;
                else:
                    $this->error_code = 102;
                    $this->message = "Invalid Product";
                endif;
                
            endif;
        endif;
        $response = $this->makeJson();
        return $response;
    }
    //<--Update Product-->
    
    //<--Delete Product-->
    public function deleteProduct() {
        $requestParam = $this->requestParams ;
        if ($this->checkRequestFormat()):
            if ($this->required_input($requestParam, [ 'product_id' ])):
                $checkProduct = $this->userModel->checkProduct($requestParam['product_id']);
                if ($checkProduct):
                    $deleteProduct = $this->userModel->deleteProduct($requestParam);
                    if ($deleteProduct):
                        $this->error = false;
                        $this->error_code = 200;
                        $this->message = "Product Deleted";
                    else:
                        $this->error_code = 99;
                        $this->message = "Some Error Found";
                    endif;
                else:
                    $this->error_code = 102;
                    $this->message = "Invalid Product";
                endif;
                
            endif;
        endif;
        $response = $this->makeJson();
        return $response;
    }
    //<--Delete Product-->
    
    
    //Check Request format
    private function checkRequestFormat() {
        if (is_array($this->requestParams) && !empty($this->requestParams)) {
            return true;
        } else {
            return false;
        }
    }
    
    
    //Check Required Input
    private function required_input($data, $check) {
        if (!empty($data)):
            foreach ($check as $c):
                if (isset($data[$c]) && !empty($data[$c]) || isset($data[$c]) && $data[$c] == '0'):
                // return true;
                else:
                    echo json_encode(array("error" => false, "error_code" => 400,
                        "message" => "$c is required field", "result" => array("required_keys" => $check)));
                    die();
                endif;
            endforeach;
            return true;
        else:
            return false;
        endif;
    }
    
    //TO Create JSON Response
    private function makeJson() {
        echo json_encode([
                    'error' => $this->error,
                    'error_code' => $this->error_code,
                    'message' => $this->message,
                    'result' => $this->result
        ]);
    }
   

}

?>