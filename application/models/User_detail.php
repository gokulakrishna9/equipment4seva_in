<?php
class User_detail extends CI_Model {
  // field => label, html_element, {type | master_value_field, master label field}, ...
  // user_id 	first_name 	last_name 	user_name 	password
  private $user_detail_form = array(
    'user_id' => array(),
    'first_name' => array(),
    'last_name' => array(),
    'user_name' => array(),
    'password' => array()
  );

  function get_user_detail_form_fields() {
    return $user_detail_form;
  }

  function authenticate_user() {
    // First, delete old captchas
    $expiration = time() - 240; // Two hour limit
    $this->db->where('captcha_time < ', $expiration)
            ->delete('captcha');
    // Then see if a captcha exists:
    echo $this->input->post('captcha');
    $sql = 'SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?';
    $binds = array($this->input->post('captcha'), $this->input->ip_address(), $expiration);
    $query = $this->db->query($sql, $binds);
    $row = $query->row();
    echo $this->db->last_query();
    if ($row->count == 0)
    {
      return false;
    }

    $user_name = $this->input->post('user_name');
    $password = $this->input->post('password');
    $this->db->select('*');
    $this->db->from('user_detail');
    $this->db->where('user_name', $user_name);
    $this->db->where('password', MD5($password));
    $query = $this->db->get();
    if($query->num_rows() > 0)
    {
      return $query->result();
    }
    else
    {
      return false;
    }
  }

  function set_captcha() {
    $captcha_word = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
		$captcha_config = array(
			'word'          => $captcha_word,
			'img_path'	=> './assets/captcha/',
      'font_path' => './assets/fonts/extraBoldItalic.ttf',
      'img_url'	=> base_url().'assets/captcha/',
			'img_width'     => '150',
			'img_height'    => 40,
			'expiration'    => 240,
			'word_length'   => 8,
			'font_size'     => 20,
			'img_id'        => 'captcha',
			// White background and border, black text and red grid
			'colors'        => array(
				'background' => array(255, 255, 255),
				'border' => array(255, 255, 255),
				'text' => array(0, 0, 0),
				'grid' => array(255, 40, 40)
			)
    );
    $captcha = create_captcha($captcha_config);
    $data = array(
      'captcha_time' => $captcha['time'],
      'ip_address' => $this->input->ip_address(),
      'word' => $captcha['word']
    );
    $query = $this->db->insert_string('captcha', $data);
    $this->db->query($query);
		return $captcha['image'];
	}
}