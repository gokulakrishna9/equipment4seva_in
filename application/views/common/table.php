<?php
  $header_array = '';
  $table_data =  '';
  $table_action = '';
  $table_id_column = '';
  $template = array(
    'table_open'            => '<table class="w3-table w3-striped w3-bordered">',

    'thead_open'            => '<thead class="w3-pale-yellow">',
    'thead_close'           => '</thead>',

    'heading_row_start'     => '<tr>',
    'heading_row_end'       => '</tr>',
    'heading_cell_start'    => '<th>',
    'heading_cell_end'      => '</th>',

    'tbody_open'            => '<tbody>',
    'tbody_close'           => '</tbody>',

    'row_start'             => '<tr>',
    'row_end'               => '</tr>',
    'cell_start'            => '<td>',
    'cell_end'              => '</td>',

    'row_alt_start'         => '<tr>',
    'row_alt_end'           => '</tr>',
    'cell_alt_start'        => '<td>',
    'cell_alt_end'          => '</td>',

    'table_close'           => '</table>'
  );
  
  // Build Table
  $this->table->set_template($template);
  if(isset($table_data)){
    if(isset($table_operator))
      echo $this->table->generate($this->format_data->format_table_data($tabel_data, $table_operator));
    else
      echo $this->table->generate($this->format_data->format_table_data($tabel_data, null));
  }
?>