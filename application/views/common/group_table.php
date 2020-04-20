<?php 
if(isset($table_operator))
  echo $this->html_builders->build_table($this->format_data->grouping_component($tabel_data, $table_operator));
else
  echo $this->html_builders->build_table($this->format_data->grouping_component($tabel_data, null));
?>