<?php

/**
 *
 */
class All_model extends CI_Model {

  public function get_data($where, $table, $order = 0) {
    $this->db->from($table);
    $this->db->where($where);
    if ($order) {
      $this->db->order_by('created_on','DESC');
    }
    return $this->db->get()->result();
  }

  public function get_data_all($where, $table) {
    $this->db->from($table);
    $this->db->where($where);
    return $this->db->get()->result();
  }

  public function get_data_all_order($where, $table) {
    $this->db->from($table);
    $this->db->where($where);
    $this->db->order_by('created_on','DESC');
    return $this->db->get()->result();
  }

  public function get_data_by_like($where, $table, $order = 0) {
    $this->db->from($table);
    $this->db->like($where);
    return $this->db->get()->row();
  }

  public function get_data_by_where_like($where, $where_like, $table, $order = 0) {
   $this->db->from($table);
   $this->db->where($where);
   $this->db->like($where_like);
   return $this->db->get()->row();
 }

  public function get_data_like_limit($where_1, $where, $table, $offset, $rows) {
    $this->db->from($table);
    $this->db->where($where_1);
    $this->db->or_like($where);
    $this->db->order_by($table.'.created_on','DESC');
    $this->db->limit($rows, $offset);
    return $this->db->get()->result();
  }

  public function get_data_like_limit_fillter($where_1, $where, $table, $return = 'result', $page = 0, $perpage = 0) {
    $this->db->from($table);
    $this->db->where($where_1);
    $this->db->or_like($where);
    $this->db->order_by($table.'.created_on','DESC');
    if ($perpage) {
      $this->db->limit($perpage, $page);
    }
    return $this->db->get()->$return();
  }

  public function get_data_by($where, $table, $order = 0) {
    $this->db->from($table);
    $this->db->where($where);
    if ($order) {
      $this->db->order_by('created_on','DESC');
    }
    return $this->db->get()->row();
  }

  public function get_data_by_order($where, $table, $order = 0) {
    $this->db->from($table);
    $this->db->where($where);
    if ($order) {
      $this->db->order_by($order);
    }
    return $this->db->get()->row();
  }

  public function get_data_all_where_like($where, $table, $wheres = array(), $return = 'result', $page = 0, $perpage = 0) {
    $this->db->from($table);
    $this->db->where($wheres);
    if (!empty($where)) {
      $output = implode(', ', array_map(
          function ($v, $k) {
              if(is_array($v)){
                  return $k.'[]='.implode('&'.$k.'[]=', $v);
              }else{
                  return $k.' LIKE "%'.$v.'%"';
              }
          },
          $where,
          array_keys($where)
      ));
      $this->db->where('('.str_replace(',', ' OR ', $output).')');
    }
    if ($perpage) {
      $this->db->limit($perpage, $page);
    }
    $this->db->order_by('created_on','DESC');
    return $this->db->get()->$return();
  }

  public function get_data_join_like($where, $select, $table, $key, $array_join, $wheres = array(), $return = 'result', $page = 0, $perpage = 0, $order = '') {
    $this->db->from($table);
    if (is_array($array_join)) {
      foreach ($array_join as $table1 => $key1) {
        $this->db->join($table1, $table.'.'.$key.' = '.$table1.'.'.$key1, 'LEFT');
      }
    }
    $this->db->select($select);
    $this->db->where($wheres);
    if (!empty($where)) {
      $output = implode(', ', array_map(
          function ($v, $k) {
              if(is_array($v)){
                  return $k.'[]='.implode('&'.$k.'[]=', $v);
              }else{
                  return $k.' LIKE "%'.$v.'%"';
              }
          },
          $where,
          array_keys($where)
      ));
      $this->db->where('('.str_replace(',', ' OR ', $output).')');
    }
    if ($perpage) {
      $this->db->limit($perpage, $page);
    }
    $this->db->order_by($order);
    $this->db->group_by($table.'.'.$key);
    return $this->db->get()->$return();
  }

  public function find_all_by_order_by($where_like, $table_1, $table_2, $join, $select, $where, $return = 'result', $page = 0, $perpage = 0) {
    $this->db->from($table_1);
    $this->db->join($table_2, $join, 'LEFT');
    $this->db->select($select);
    $this->db->where($where);
    if (!empty($where_like)) {
      $output = implode(', ', array_map(
          function ($v, $k) {
              if(is_array($v)){
                  return $k.'[]='.implode('&'.$k.'[]=', $v);
              }else{
                  return $k.' LIKE "%'.$v.'%"';
              }
          },
          $where_like,
          array_keys($where_like)
      ));
      $this->db->where('('.str_replace(',', ' OR ', $output).')');
    }
    $this->db->order_by('created_on DESC');
    if ($perpage) {
      $this->db->limit($perpage, $page);
    }
    return $this->db->get()->$return();
  }

  public function find_all_join($where_like, $table_1, $table_2, $table_3, $join_1, $join_2, $select, $where, $return = 'result', $page = 0, $perpage = 0) {
    $this->db->from($table_1);
    $this->db->join($table_2, $join_1, 'LEFT');
    $this->db->join($table_3, $join_2, 'LEFT');
    $this->db->select($select);
    $this->db->where($where);
    if (!empty($where_like)) {
      $output = implode(', ', array_map(
          function ($v, $k) {
              if(is_array($v)){
                  return $k.'[]='.implode('&'.$k.'[]=', $v);
              }else{
                  return $k.' LIKE "%'.$v.'%"';
              }
          },
          $where_like,
          array_keys($where_like)
      ));
      $this->db->where('('.str_replace(',', ' OR ', $output).')');
    }
    $this->db->order_by('created_on DESC');
    if ($perpage) {
      $this->db->limit($perpage, $page);
    }
    return $this->db->get()->$return();
  }

  public function get_data_count_by($where, $table) {
    $this->db->from($table);
    $this->db->where($where);
    // $this->db->order_by('created_on','DESC');
    return $this->db->get()->num_rows();
  }

  public function get_by($table, $where) {
    return $this->db->from($table)->where($where)->get()->row();
  }

  public function c_insert($table, $data) {
    $this->db->insert($table, $data);
    $insert_id = $this->db->insert_id();
    return  $insert_id;
  }

  public function c_update($table, $data, $where) {
    $this->db->where($where);
    return $this->db->update($table, $data);
  }

  public function c_find_by($table, $where) {
    $this->db->from($table);
    $this->db->where($where);
    return $this->db->get()->row();
  }

  public function c_find_all_by($table, $where) {
    $this->db->from($table);
    $this->db->where($where);
    return $this->db->get()->result();
  }

  public function get_by_result($table, $where) {
    return $this->db->from($table)->where($where)->get()->result();
  }

  public function update($where, $data, $table) {
    $this->db->where($where);
    return $this->db->update($table, $data);
  }

  public function insert($data, $table) {
    return $this->db->insert($table, $data);
  }

  public function insert_notif($table, $data) {
    return $this->db->insert($table, $data);
  }

  public function c_insert_batch($table, $data) {
    return $this->db->insert_batch($table, $data);
  }

  public function delete($where, $table) {
    $this->db->where($where);
    return $this->db->delete($table);
  }

	public function get_id($table){
		$result   = $this->db->get($table)->num_rows();
		$result += 1;

		return $result ;
	}

  public function get_all_by($table, $where, $order = null) {
    $this->db->from($table);
    $this->db->where($where);
    if ($order) {
      $this->db->order_by($order);
    }
    return $this->db->get()->result();
  }

  public function get_all_by_group($table, $where, $group = null) {
    $this->db->from($table);
    $this->db->where($where);
    if ($group) {
    $this->db->group_by($group);
    }
    return $this->db->get()->result();
  }

}

 ?>
