<?php
class Equipment_type extends CI_Model {
  function get_equipment(){
    $this->db->select("*")
      ->from('equipment');
    $qry = $this->db->get();
    $rslts = $qry->result();
    return $rslts;
  }
  function add_update_equipment(){
    $equipment_id = $this->input->post('equipment_id');
    $equipment_type_id = $this->input->post('equipment_type_id');
    $equipment_procurement_type_id = $this->input->post('equipment_procurement_type_id');
    $manufacturer_id = $this->input->post('manufacturer_id');
    $eq_name = $this->input->post('eq_name');
    $model = $this->input->post('model');
    $serial_number = $this->input->post('serial_number');
    $mac_address = $this->input->post('mac_address');
    $asset_number = $this->input->post('asset_number');
    $donor_id = $this->input->post('donor_id');
    $procured_by_id = $this->input->post('procured_by_id');
    $map = $this->input->post('map');
    $purchase_order_date = $this->input->post('purchase_order_date');
    $cost = $this->input->post('cost');
    $supplier_id = $this->input->post('supplier_id');
    $invoice_number = $this->input->post('invoice_number');
    $invoice_date = $this->input->post('invoice_date');
    $supply_date = $this->input->post('supply_date');
    $installation_date = $this->input->post('installation_date');
    $warranty_start_date = $this->input->post('warranty_start_date');
    $warranty_end_date = $this->input->post('warranty_end_date');
    $equipment_status_id = $this->input->post('equipment_status_id');
    /*
      created_by,
      updated_by,
      created_datetime,
      updated_datetime 
    */
    $post_data = array(
      'equipment_id' => $equipment_id,
      'equipment_type_id' => $equipment_type_id,
      'equipment_procurement_type_id' => $equipment_procurement_type_id,
      'manufacturer_id' => $manufacturer_id,
      'eq_name' => $eq_name,
      'model' => $model,
      'serial_number' => $serial_number,
      'mac_address' => $mac_address,
      'asset_number' => $asset_number,
      'donor_id' => $donor_id,
      'procured_by_id' => $procured_by_id,
      'map' => $map,
      'purchase_order_date' => $purchase_order_date,
      'cost' => $cost,
      'supplier_id' => $supplier_id,
      'invoice_number' => $invoice_number,
      'invoice_date' => $invoice_date,
      'supply_date' => $supply_date,
      'installation_date' => $installation_date,
      'warranty_start_date' => $warranty_start_date,
      'warranty_end_date' => $warranty_end_date,
      'equipment_status_id' => $equipment_status_id
    );
    $this->db->replace('equipment', $post_data);
    $insert_id = $this->db->insert_id();
  }
}