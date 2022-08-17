<?php

defined('BASEPATH') or exit('no direct script access allowed');

class db_qry extends CI_Model
{
    // table name :- ajaxtb
    public function insert($formArray)
    {
        $this->db->insert('ajax', $formArray);
        return $id = $this->db->insert_id();
    }

    function record_count()
    {
        return $this->db->count_all('ajax');
    }

    //    public function listdata($limit, $start)
    //     {


    //      $this->db->limit($limit, $start);
    //      $result = $this->db->get("ajaxtb");
    //      if ($result->num_rows() > 0) {
    //       foreach ($result->result() as $row) {
    //       $data[] = $row;
    //       }
    //        return $data;
    //      }
    //      return false;


    //     }


    // THIS FUNCTION IS USED TO GET THE DATA ROW USING ITS ID
    public function getrow($id)
    {
        $this->db->where('id', $id);
        $row = $this->db->get('ajax')->row_array();
        return $row;
    }

    // THIS FUNCTION IS USED TO UPDATE THE DATA ENTRED IN EDIT FORM IN DATABSE 
    public function update($id, $formArray)
    {
        $this->db->where('id', $id);
        $this->db->update('ajax', $formArray);
        return $id;
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('ajax');
    }

    public function getdata($limit, $offset, $search, $count)
    {
        $this->db->select('*');
        $this->db->from('ajax');
        if ($search) {
            $keyword = $search['keyword'];
            if ($keyword) {
                $this->db->where("name LIKE '%$keyword%'");
            }
        }
        if ($count) {
            return $this->db->count_all_results();
        } else {
            $this->db->limit($limit, $offset);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->result();
            }
        }

        return array();
    }

    public function checkLogin()
    {
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);
        return $this->db->where('email', $email)->where('password', $password)->get('ajax')->row();
    }
}
?>