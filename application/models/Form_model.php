<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form_model extends ci_model
{
    // Start of script untuk admin

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
}
