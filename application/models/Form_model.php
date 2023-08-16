<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form_model extends ci_model
{
    // Start of script untuk admin
    public function insert($data)
    {
        $this->db->insert("mform", $data);
        return $this->db->insert_id();
    }
    public function loadData()
    {
        $data = "SELECT
        mform.id,
        mform.nf,
        mform.detail_created,
        mform.date_modified,
        mform.app,
        mform.app1
        FROM
        mform";
        $query = $this->db->query($data);
        return $query->result();
    }

    public function loadDD($id_mform)
    {
        $data = "SELECT
        vform.id,
        vform.id_mform,
        vform.description,
        vform.budget,
        vform.detail_created,
        vform.date_modified
        FROM
        vform
        WHERE
        vform.id_mform = $id_mform";
        $query = $this->db->query($data);
        return $query->result();
    }

    public function ttl($id)
    {
        $data = "SELECT
        SUM( vform.budget) total_budget
        FROM
        vform
        WHERE
        vform.id_mform = $id";
        $query = $this->db->query($data);
        return $query->result();
    }

    public function inputDataDetail($data)
    {
        $this->db->insert('vform', $data);
    }

    public function changeStatusBudget($data2, $id_mform)
    {
        $this->db->where('id', $id_mform);
        $this->db->update('mform', $data2);
    }

    public function del_vform_vformapp($id)
    {
        $query = "DELETE vform FROM vform WHERE vform.id = $id";
        $this->db->query($query);
    }

    public function delete($id_mform)
    {
        $query = "DELETE mform FROM mform WHERE mform.id = $id_mform";
        $this->db->query($query);
    }

    public function sum_mform_by_id()
    {
        $data = "SELECT
        count( mform.id ) total 
        FROM
        mform 
        WHERE
        MONTH ( mform.detail_created ) = MONTH ( CURDATE( ) ) ";
        $query = $this->db->query($data);
        return $query->result();
    }

    public function updateDataSaveModal($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('vform', $data);
    }

    // End of script untuk admin

    // Start of script untuk approval

    public function loadDataM()
    {
        $data = "SELECT
        mform.id,
        mform.nf,
        mform.detail_created,
        mform.date_modified,
        mform.app,
        mform.app1
        FROM
        mform
        WHERE mform.app = 0 OR mform.app IS NULL";
        $query = $this->db->query($data);
        return $query->result();
    }

    public function loadDDc($id_mform)
    {
        $data = "SELECT
        vform.id,
        vform.id_mform,
        vform.description,
        vform.budget,
        vform.detail_created,
        vform.date_modified
        FROM
        vform
        WHERE vform.id_mform = $id_mform";
        $query = $this->db->query($data);
        return $query->result();
    }

    // End of script untuk approval

    // Start of script untuk report

    public function loadFormAcc()
    {
        $data = "SELECT
        SUM( vform.budget) total,
        mform.id,
        mform.nf,
        mform.detail_created,
        mform.date_modified,
        mform.app,
        mform.app1
        FROM
        vform
        LEFT JOIN mform ON mform.id = vform.id_mform
        WHERE mform.app = 1
        GROUP BY mform.id";

        $query = $this->db->query($data);
        return $query->result();
    }

    // End of script untuk report
}
