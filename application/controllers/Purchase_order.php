<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_order extends CI_Controller {

	public function index($status = '')
    {
        if($status == '') {
            $status = $this->input->get('status');
        }
        if( $status == 'success'){
            $data['status']['color'] = 'success';            
            $data['status']['text'] = 'เพิ่มสำเร็จ';
        }
        else if($status == 'error_input'){
            $data['status']['color'] = 'warning';            
            $data['status']['text'] = 'เพิ่มไม่สำเร็จ';

        }
        else if($status == 'delete_success'){
            $data['status']['color'] = 'danger';            
            $data['status']['text'] = 'ลบสำเร็จ';

        }
        else if($status == 'edit_success'){
            $data['status']['color'] = 'success';            
            $data['status']['text'] = 'แก้ไขสำเร็จ';

        }
        else if($status == 'edit_error'){
            $data['status']['color'] = 'warning';            
            $data['status']['text'] = 'แก้ไขไม่สำเร็จ';

        }
        
        else {
            $data['status'] = '';
        }
        $data['purchase_order'] = $this->Purchase_order->gets();
        $data['company_by_customer'] = $this->Quotation->company_by_customer(); 
        $data['quotation'] = $this->Purchase_order->customer_by_qoutation(); 

        
        // print_r($data);
        // die();
        $this->template->view('admin/purchase_order_view', $data);
    }
    public function add_purchase_order()
    {
        // print_r($_POST);
        $array['Purchase_Order_person'] = $this->input->post('person');//คน
        $array['Purchase_Order_num'] = $this->input->post('po'); //ใบPO
        $array['Purchase_Order_company'] = $this->input->post('company'); //บริษัท
        $array['Purchase_Order_tax'] = $this->input->post('tax'); //เลขประจำตัวคนเสียภาษี
        $array['Purchase_Order_date_create'] = date('Y-m-d');//เวลาที่สร้าง
        $array['Purchase_Order_date_delivery'] = $this->input->post('date');//เวลาที่ส่ง

        // print_r($array);
        // die();

        $this->Purchase_order->insert($array);
        redirect('Purchase_order/index?status=success', 'refresh');

    }
}
