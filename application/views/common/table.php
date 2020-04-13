<?php
  // Build Table
  if(isset($tabel_data)){
    if(isset($table_operator))
      echo $this->html_builders->build_table($this->format_data->format_table_data($tabel_data, $table_operator));
    else
      echo $this->html_builders->build_table($this->format_data->format_table_data($tabel_data, null));
  }
?>