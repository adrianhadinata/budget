<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Log_model extends ci_model
{
    public function step($insert)
    {
        $this->db->insert('log', $insert);
    }

    public function session_data($id_dept)
    {
        $data = "SELECT DISTINCT
        T1.`name` name,
        T1.id,
        ( SELECT muser.name AS manager FROM muser WHERE muser.id_dept = T1.id AND muser.id_role = 2 ) manager_name,
        ( SELECT muser.phone_number AS manager FROM muser WHERE muser.id_dept = T1.id AND muser.id_role = 2 ) manager_phone,
        ( SELECT muser.name AS manager FROM muser WHERE muser.id_dept = T1.id AND muser.id_role = 1 ) input_name,
        ( SELECT muser.phone_number AS manager FROM muser WHERE muser.id_dept = T1.id AND muser.id_role = 1 ) input_phone,
		( SELECT muser.name AS purchasing FROM muser WHERE muser.id_role = 3 ) purc_name,
		( SELECT muser.phone_number AS purchasing FROM muser WHERE muser.id_role = 3 ) purc_number,
		( SELECT muser.name AS purchasing FROM muser WHERE muser.id_role = 4 ) gm_name,
		( SELECT muser.phone_number AS purchasing FROM muser WHERE muser.id_role = 4 ) gm_number 
        FROM
            mdept T1
            INNER JOIN muser ON T1.id = muser.id_dept 
        WHERE
            T1.id = $id_dept";

        return $this->db->query($data);
    }
}
