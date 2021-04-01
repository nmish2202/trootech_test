<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    //<----check parent category --->
    public function checkCategory($category_id) {
        $user = $this->db->where('id', $category_id)
                ->get('categories')
                ->num_rows();
        if ($user>0) {
            return true;
        } else {
            return false;
        }
    }
    //<----check parent category --->
    
    //<----check Product --->
    public function checkProduct($product_id) {
        $user = $this->db->where('product_id', $product_id)
                ->get('products')
                ->num_rows();
        if ($user>0) {
            return true;
        } else {
            return false;
        }
    }
    //<----check Product --->
    
    //<-----Create Category-->
    public function createCategory($req) {
            $insertData['category_name'] = $req['category_name'];
            $insertData['parent_id'] = $req['parent_id'] ;
            $insertData['status'] = 1;
            $insertData['created_at'] = date('Y-m-d H:i:s');
            $insertData['updated_at'] = null;
            $insert = $this->db->insert('categories' , $insertData);
        return $insert == true ? true : false;
    }
    //<-----Create Category-->
    
    //<-----Category List-->
    public function getCategories($req) {
        $returnData=[];
        $this->db->select('*');
        $this->db->where('parent_id', $req['parent_id']);
        $this->db->where('status', 1);
        $categories = $this->db->get('categories')->result_array();
        //print_r($categories);exit;
        foreach($categories as $cat):
            $cat['sub_cat']=$this->getSubCategories($cat['id']);
            array_push($returnData, $cat);
        endforeach;
        //print_r($returnData);exit;
        return $returnData == true ? $returnData : false;
    }
    //<-----Category List-->
    
    //<-----Get Sub Category List-->
    public function getSubCategories($parent_id) {
        $returnData=[];
        $this->db->select('*');
        $this->db->where('parent_id', $parent_id);
        $this->db->where('status', 1);
        $subCategories = $this->db->get('categories')->result_array();
        foreach($subCategories as $cat):
            $cat['sub_cat']=$this->getSubCategories($cat['id']);
            array_push($returnData, $cat);
        endforeach;
        return $returnData;
    }
    //<-----Get Sub Category List-->
    
    //<-----Create Category-->
    public function updateCategory($req) {
        $updateData['category_name'] = $req['category_name'];
        $updateData['updated_at'] = date('Y-m-d H:i:s');
        $update = $this->db->where('id' , $req['category_id'])->update('categories' , $updateData);
        return $update == true ? true : false;
    }
    //<-----Create Category-->
    
    //<-----Delete Category-->
    public function deleteCategory($req) {
        $updateData['status'] = 3;
        $updateData['updated_at'] = date('Y-m-d H:i:s');
        $update = $this->db->where('id' , $req['category_id'])->update('categories' , $updateData);
        if($update):
            $where="parent_cat_id=".$req['category_id']." OR sub_cat_id=".$req['category_id'];
            $productUpdate = $this->db->where($where)->update('products' , $updateData);
        endif;
        return $update == true ? true : false;
    }
    //<-----Delete Category-->
    
    //<-----Add Product-->
    public function addProduct($req) {
        $insertData['product_name']     = $req['product_name'];
        $insertData['price']            = $req['price'];
        $insertData['parent_cat_id']    = $req['parent_cat_id'] ;
        $insertData['sub_cat_id']       = $req['sub_cat_id'] ;
        $insertData['created_at']       = date('Y-m-d H:i:s');

        $insert = $this->db->insert('products' , $insertData);
        return $insert == true ? true : false;
    }
    //<-----Add Product-->
    
    //<-----Product List-->
    public function getProducts() {
        $returnData=[];
        $this->db->select('*');
        $this->db->where('status', 1);
        $products = $this->db->get('products')->result_array();
        foreach($products as $product):
            $product['parent_cat_id']=$this->db->where('id', $product['parent_cat_id'])->get('categories')->row_array();
            $product['sub_cat_id']=$this->db->where('id', $product['sub_cat_id'])->get('categories')->row_array();
            array_push($returnData, $product);
        endforeach;
        //print_r($returnData);exit;
        return $returnData == true ? $returnData : false;
    }
    //<-----Product List-->
    
     //<-----Update Category-->
    public function updateProduct($req) {
        $updateData['product_name'] = $req['product_name'];
        $updateData['price']        = $req['price'];
        $updateData['updated_at']   = date('Y-m-d H:i:s');
        $update = $this->db->where('product_id' , $req['product_id'])->update('products' , $updateData);
        return $update == true ? true : false;
    }
    //<-----Update Category-->
    
    //<-----Delete Product-->
    public function deleteProduct($req) {
        $updateData['status'] = 3;
        $updateData['updated_at'] = date('Y-m-d H:i:s');
        $update = $this->db->where('product_id' , $req['product_id'])->update('products' , $updateData);
        return $update == true ? true : false;
    }
    //<-----Delete Product-->
   
}

?>