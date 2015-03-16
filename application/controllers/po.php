<?php defined('BASEPATH') OR exit('No direct script access allowed');

// po.php Chris Dart Mar 6, 2015 7:12:38 PM chrisdart@cerebratorium.com

class PO extends MY_Controller{


    function __construct(){
        parent::__construct();
        $this->load->model("po_model","po");
        $this->load->model("item_model","item");
    }

    function index(){

    }

    function view($po){
        $order = $this->po->get_by_po($po);
        $po->items = $this->item->get_by_po($order->id);
    }

}