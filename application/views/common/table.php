<?php
  $header_array = '';
  $table_data =  '';
  $table_action = '';
  $table_id_column = '';
  $template = array(
    'table_open'            => '<table class="w3-table w3-bordered">',

    'thead_open'            => '<thead>',
    'thead_close'           => '</thead>',

    'heading_row_start'     => '<tr>',
    'heading_row_end'       => '<td></td><td></td></tr>',
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
   //total_rows
  // Add pagination
  $config['base_url'] = base_url();
  $config['total_rows'] = 20;
  $config['per_page'] = 10;
  $this->pagination->initialize($config);
  echo $this->pagination->create_links();

  // Build Table
  $this->table->set_template($template);
  echo $this->table->generate($this->format_data->format_table_data($tabel_data, $table_operator, $key_field));
?>