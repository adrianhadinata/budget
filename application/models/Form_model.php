<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form_model extends ci_model
{
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

    //

    public function loadDataApp()
    {
        $data = "SELECT
        mform.id,
        mform.`month`,
        mform.idDept,
        mform.nf,
        mform.category,
        mform.detail_created,
        mform.date_modified,
        mform.appMan,
        mform.appAccp,
        mform.appGm,
        mform.app1,
        mform.app2,
        mform.app3,
        mform.active,
        total.noPo
        FROM
            mform
            LEFT JOIN (
            SELECT
                vform_app.id_mform,
                mform.active,
                COUNT( vform_app.id ) totItem,
                SUM( IF ( vform_app.po_added IS NULL, 1, 0 ) ) noPo,
                SUM( IF ( vform_app.po_added IS NULL, 0, 1 ) ) yesPo 
            FROM
                vform_app
                LEFT JOIN mform ON mform.id = vform_app.id_mform 
            WHERE
                mform.active = 2 
            GROUP BY
                vform_app.id_mform 
            ORDER BY
                vform_app.id_mform ASC 
            ) total ON total.id_mform = mform.id
        WHERE
            mform.appMan = 2 
            AND mform.appAccp = 2 
            AND mform.appGm = 2 
            AND mform.active = 2
        ORDER BY total.noPo DESC
            ";
        $query = $this->db->query($data);
        return $query->result();
    }

    public function loadDataM($d)
    {
        $data = "SELECT
        mform.id,
        mform.`month`,
        mform.idDept,
        mform.nf,
        mform.category,
        mform.detail_created,
        mform.date_modified,
        mform.appMan,
        mform.appAccp,
        mform.appGm,
        mform.active
        FROM
        mform
        WHERE mform.appMan = 1
        AND mform.idDept = $d
        AND mform.appAccp = 1
        AND mform.appGm = 1
        AND mform.active = 1";
        $query = $this->db->query($data);
        return $query->result();
    }

    public function loadDataAc()
    {
        $data = "SELECT
        mform.id,
        mform.`month`,
        mform.idDept,
        mform.nf,
        mform.category,
        mform.detail_created,
        mform.date_modified,
        mform.appMan,
        mform.app1,
        mform.appAccp,
        mform.appGm,
        mform.active
        FROM
        mform
        WHERE mform.appMan = 2
        AND mform.appAccp = 1
        AND mform.appGm = 1
        AND mform.active = 1";
        $query = $this->db->query($data);
        return $query->result();
    }

    public function loadDataGm()
    {
        $data = "SELECT
        mform.id,
        mform.`month`,
        mform.idDept,
        mform.nf,
        mform.category,
        mform.detail_created,
        mform.date_modified,
        mform.appMan,
        mform.appAccp,
        mform.appGm,
        mform.app1,
        mform.app2,
        mform.active
        FROM
        mform
        WHERE mform.appMan = 2
        AND mform.appAccp = 2
        AND mform.appGm = 1
        AND mform.active = 1";
        $query = $this->db->query($data);
        return $query->result();
    }

    public function loadDDc($id_mform)
    {
        $data = "SELECT
        mitem.`name` description,
        vform_app.id,
        vform_app.id_mform,
        vform_app.no_po,
        vform_app.stok,
        vform_app.`order`,
        vform_app.unit,
        vform_app.price,
        vform_app.payment,
        vform_app.remarks,
        vform_app.detail_created,
        vform_app.date_modified,
        vform_app.sub_date,
        vform_app.app_sub_date,
        mcur.currency
        FROM
        vform_app
        LEFT JOIN mitem ON mitem.id = vform_app.description
        LEFT JOIN mcur ON mcur.id = mitem.id_cur
        WHERE
        vform_app.id_mform = $id_mform
        ";
        $query = $this->db->query($data);
        return $query->result();
    }

    public function loadDept()
    {
        $data = "SELECT
        mdept.id,
        mdept.`name`
        FROM
        mdept";
        $query = $this->db->query($data);
        return $query->result();
    }

    public function inputDataSave($data)
    {
        $this->db->insert('mform', $data);
        return $this->db->insert_id();
    }

    public function inputDataSaveClone($data)
    {
        $this->db->insert('vform_app', $data);
        return $this->db->insert_id();
    }

    public function insert_count($data)
    {
        $this->db->insert('counting', $data);
        return $this->db->insert_id();
    }

    public function del_data($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('mform');
    }

    public function del_counting($id_mform)
    {
        $this->db->where('id_mform', $id_mform);
        $this->db->delete('counting');
    }

    public function loadItem()
    {
        $query = "SELECT
        mitem.id,
        mitem.`name`,
        mitem.unit,
        mitem.price,
        mitem.stok
        FROM
        mitem
        ORDER BY 
        mitem.`name`
        ";
        return $this->db->query($query);
    }

    public function loadItemById($id)
    {
        $sql = "SELECT
        mitem.`name`,
        mitem.unit,
        mitem.price,
        mitem.id_supp,
        mitem.stok,
        mcur.currency
        FROM
        mitem
        LEFT JOIN mcur ON mcur.id = mitem.id_cur
        WHERE mitem.id = $id
        ";
        $query = $this->db->query($sql);

        return $query->result_array();
    }

    public function resetCountingWhatsapp($idMform)
    {
        $query = "DELETE FROM `counting` WHERE id_mform = $idMform";
        $this->db->query($query);
    }

    public function add_remarks($data)
    {
        $this->db->insert('remarks', $data);
    }

    public function updateDataSaveClone1($id)
    {
        $data = "UPDATE
        vform_app 
        SET vform_app.app_sub_date = '',
        vform_app.deliv_status = NULL 
        WHERE vform_app.id = $id";
        $this->db->query($data);
    }


    public function cek_vformapp_creceipt_s($id)
    {
        $data = "SELECT
        vform_app.cash_receipt_status,
        mvoc.no_voc
        FROM
        vform_app
        LEFT JOIN vocd ON vform_app.id = vocd.id_vformapp
        LEFT JOIN mvoc ON vocd.id_mvoc = mvoc.id
        WHERE vform_app.id = $id";
        $query = $this->db->query($data);
        return $query->result();
    }

    public function updateDataSaveModal($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('vform', $data);
    }

    public function updateDataSaveClone($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('vform_app', $data);
    }

    public function updateDataPO($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('vform_app', $data);
    }

    public function updateStatusC($data1, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('vform_app', $data1);
    }

    public function set_null($id)
    {
        $this->db->set('cash_receipt_status', null);
        $this->db->where('id', $id);
        $this->db->update('vform_app');
    }

    public function mform_by_id($id)
    {
        $data = "SELECT
        mitem.`name` descr,
        mcur.currency,
        vform.`order`,
        vform.unit,
        vform.price,
        vform.payment,
        vform.remarks,
        vform.id_mform,
        vform.stok,
        vform_app.price final_price,
        mform.nf,
        CASE
		    WHEN vform_app.payment LIKE '%T%' 
            THEN 'PO' ELSE 'CASH' 
	    END final_p,
        vform_app.`order`final_o,
        vform_app.no_po final_no_po,
        vform.`order` * vform.price tfi,
        vform_app.`order` * vform_app.price tf
        FROM
        vform
        LEFT JOIN mitem ON mitem.id = vform.description
        LEFT JOIN mcur ON mcur.id = mitem.id_cur
        LEFT JOIN vform_app ON vform_app.description = vform.description
        LEFT JOIN mform ON mform.id = vform.id_mform
        WHERE
        vform.id_mform = $id AND vform_app.id_mform = $id
        GROUP BY vform.description       
        ";
        $query = $this->db->query($data);
        return $query->result();
    }

    public function up_or_no()
    {
        $data = 'SELECT
        Count( vform_app.no_po ) AS total,
        Sum( IF ( vform_app.no_po = "" AND vform_app.payment = "T", 1, 0 ) ) AS not_updated,
        Sum( IF ( vform_app.no_po != "", 1, 0 ) ) AS updated,
        Sum( IF ( vform_app.payment = "C", 1, 0 ) ) AS cash,
        Sum( IF ( vform_app.payment = "C" AND vform_app.sub_date = "", 1, 0 ) ) AS cash_nu,
	    Sum( IF ( vform_app.payment = "C" AND vform_app.sub_date != "", 1, 0 ) ) AS cash_up,
        Sum( IF ( vform_app.payment = "C" AND vform_app.app_sub_date != "", 1, 0 ) ) AS cashier_ok,
        mform.active 
        FROM
        vform_app
        LEFT JOIN mform ON mform.id = vform_app.id_mform 
        WHERE
        mform.active = 2 
        ';
        $query = $this->db->query($data);
        return $query->result();
    }

    public function list_123()
    {
        $data = 'SELECT
        mform.active,
        mform.nf,
        mdept.`name` de,
        vform_app.remarks,
        vform_app.detail_created,
        vform_app.date_modified,
        vform_app.payment,
        mitem.`name` item,
        mform.category
        FROM
        vform_app
        LEFT JOIN mform ON mform.id = vform_app.id_mform
        LEFT JOIN mdept ON mdept.id = mform.idDept
        LEFT JOIN mitem ON mitem.id = vform_app.description
        WHERE
        mform.active = 2 AND
        vform_app.no_po = "" AND
        vform_app.payment = "T"
        ORDER BY mform.category DESC';
        $query = $this->db->query($data);
        return $query->result();
    }

    public function list_456()
    {
        $data = 'SELECT
        mform.active,
        mform.nf,
        mdept.`name` de,
        vform_app.remarks,
        vform_app.detail_created,
        vform_app.date_modified,
        vform_app.payment,
        mitem.`name` item,
        mform.category
        FROM
        vform_app
        LEFT JOIN mform ON mform.id = vform_app.id_mform
        LEFT JOIN mdept ON mdept.id = mform.idDept
        LEFT JOIN mitem ON mitem.id = vform_app.description
        WHERE
        mform.active = 2 AND
        vform_app.sub_date = "" AND
        vform_app.payment = "C"
        ORDER BY mform.category DESC';
        $query = $this->db->query($data);
        return $query->result();
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

    public function v_payment($id)
    {
        $data = "SELECT
        COUNT(vform_app.id) total
        FROM
        vform_app
        WHERE
        vform_app.id_mform = $id
        AND (vform_app.payment = '' OR vform_app.payment IS NULL)";
        $query = $this->db->query($data);
        return $query->result();
    }

    public function get_sub()
    {
        $data = "SELECT
        mitem.`name`,
        vform_app.`order`,
        vform_app.unit,
        vform_app.price,
        vform_app.sub_date,
        vform_app.app_sub_date,
        mform.detail_created,
        mform.date_modified dateAcc,
        mform.nf,
        vform_app.id,
        vform_app.cash_remarks,
        mdept.name deptname
        FROM
        vform_app
        LEFT JOIN mform ON mform.id = vform_app.id_mform
        LEFT JOIN mitem ON mitem.id = vform_app.description
        LEFT JOIN mdept ON mdept.id = mform.idDept
        WHERE
        vform_app.app_sub_date = '' AND
        vform_app.sub_date != '' AND
        mform.active = 2";
        $query = $this->db->query($data);
        return $query->result();
    }

    public function get_cum()
    {
        $data = "SELECT
        mitem.`name`,
        vform_app.`order`,
        vform_app.unit,
        vform_app.price,
        vform_app.sub_date,
        vform_app.app_sub_date,
        mform.detail_created,
        mform.date_modified AS dateAcc,
        mform.nf,
        vform_app.id,
        vform_app.cash_remarks,
        mdept.name deptname
        FROM
        vform_app
        LEFT JOIN mform ON mform.id = vform_app.id_mform
        LEFT JOIN mitem ON mitem.id = vform_app.description
        LEFT JOIN mdept ON mdept.id = mform.idDept
        WHERE
        vform_app.app_sub_date != '' AND
        vform_app.payment = 'C' AND
        vform_app.sub_date != '' AND
        mform.active = 2 AND
        vform_app.deliv_status = 0";
        $query = $this->db->query($data);
        return $query->result();
    }

    public function get_dtl()
    {
        $data = "SELECT
        mitem.`name`,
        vform_app.`order`,
        vform_app.unit,
        vform_app.price,
        vform_app.sub_date,
        vform_app.app_sub_date,
        mform.detail_created,
        mform.date_modified AS dateAcc,
        mform.nf,
        vform_app.id,
        vform_app.cash_remarks,
        mdept.`name` AS deptname,
        vocd.date_modified AS item_received
        FROM
        vform_app
        LEFT JOIN mform ON mform.id = vform_app.id_mform
        LEFT JOIN mitem ON mitem.id = vform_app.description
        LEFT JOIN mdept ON mdept.id = mform.idDept
        LEFT JOIN vocd ON vocd.id_vformapp = vform_app.id
        WHERE
        vform_app.app_sub_date != '' AND
        vform_app.payment = 'C' AND
        vform_app.sub_date != '' AND
        mform.active = 2 AND
        vform_app.deliv_status = 1
        ";
        $query = $this->db->query($data);
        return $query->result();
    }

    public function get_app_c_by_y($m, $y)
    {
        $data = "SELECT
        vform_app.id,
        mform.nf,
        mitem.`name`,
        vform_app.`order`,
        vform_app.unit,
        vform_app.price,
        vform_app.`order` * vform_app.price AS total,
        vform_app.app_sub_date,
        mdept.`name` AS dept,
        vocd.`status` AS deliv_sts
        FROM
        vform_app
        LEFT JOIN mitem ON mitem.id = vform_app.description
        LEFT JOIN mform ON mform.id = vform_app.id_mform
        LEFT JOIN mdept ON mdept.id = mform.idDept
        LEFT JOIN vocd ON vocd.id_vformapp = vform_app.id
        WHERE
        vform_app.app_sub_date != ''
        AND vform_app.sub_date != ''
        AND vform_app.payment = 'C'
        AND vform_app.app_sub_date BETWEEN '$m' AND '$y'";
        $query = $this->db->query($data);
        return $query->result();
    }

    public function total_app($m, $y)
    {
        $data = "SELECT
        SUM( vform_app.`order` * vform_app.price ) AS total,
        mcur.currency
        FROM
        vform_app
        LEFT JOIN vocd ON vocd.id_vformapp = vform_app.id AND vocd.`status` != 2 AND vocd.`status` != 3
        LEFT JOIN mitem ON mitem.id = vform_app.description
		LEFT JOIN mcur ON mcur.id = mitem.id_cur
        WHERE
        vform_app.app_sub_date != ''
        AND vform_app.sub_date != ''
        AND vform_app.app_sub_date BETWEEN '$m' AND '$y'";
        $query = $this->db->query($data);
        return $query->result();
    }

    public function get_app_tf_by_y($m, $y)
    {
        $data = "SELECT
        mform.nf,
        mitem.`name`,
        vform_app.`order`,
        vform_app.no_po,
        vform_app.unit,
        vform_app.price,
        vform_app.`order` * vform_app.price AS total,
        vform_app.app_sub_date,
        mdept.`name` dept
        FROM
            vform_app
            LEFT JOIN mitem ON mitem.id = vform_app.description
            LEFT JOIN mform ON mform.id = vform_app.id_mform
            LEFT JOIN mdept ON mdept.id = mform.idDept 
        WHERE
            vform_app.po_added IS NOT NULL 
            AND vform_app.no_po != ''
            AND vform_app.payment = 'T' 
            AND DATE ( vform_app.po_added ) BETWEEN '$m' AND '$y'";
        $query = $this->db->query($data);
        return $query->result();
    }

    public function total_tf($m, $y)
    {
        $data = "SELECT
        SUM(vform_app.`order` * vform_app.price) AS total 
        FROM
        vform_app
        WHERE
        vform_app.po_added IS NOT NULL 
        AND vform_app.no_po != ''
        AND vform_app.payment = 'T' 
        AND DATE ( vform_app.po_added ) BETWEEN '$m' AND '$y'";
        $query = $this->db->query($data);
        return $query->result();
    }

    public function dashboard_c($idDept)
    {
        $data = "SELECT
        COUNT( mform.id ) total_all,
        SUM( IF ( mform.active = 2, 1, 0 ) ) total_acc,
        SUM( IF ( mform.active = 1, 1, 0 ) ) wait_for_approval,
        SUM( IF ( mform.active = 3, 1, 0 ) ) declined 
        FROM
        mform
        WHERE
        mform.idDept = $idDept";
        $query = $this->db->query($data);
        return $query->result();
    }

    public function dashboard_nc()
    {
        $data = "SELECT
        COUNT( mform.id ) total_all,
        SUM( IF ( mform.active = 2, 1, 0 ) ) total_acc,
        SUM( IF ( mform.active = 1, 1, 0 ) ) wait_for_approval,
        SUM( IF ( mform.active = 3, 1, 0 ) ) declined 
        FROM
        mform";
        $query = $this->db->query($data);
        return $query->result();
    }

    public function dashboard()
    {
        $data = "SELECT
        mform.id,
        mform.nf,
        mform.detail_created,
        mform.active,
        mform.category,
        mform.`month`,
        mdept.`name`
        FROM
        mform
        INNER JOIN mdept ON mdept.id = mform.idDept";
        $query = $this->db->query($data);
        return $query->result();
    }

    public function dasboard_2($idDept)
    {
        $data = "SELECT
        t2.id,
        t2.`month`,
        T1.m_only,
        T1.tl,
	    T3.tl usd
        FROM
            months AS t2
            LEFT JOIN (
            SELECT
                uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) m_only,
                CONCAT( '20', uExtractNumberFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) ) y_only,
                SUM( vform_app.`order` * vform_app.price ) tl,
            CASE
                    
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%January%' THEN
                    1 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%February%' THEN
                    2 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%March%' THEN
                    3 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%April%' THEN
                    4 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%May%' THEN
                    5 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%June%' THEN
                    6 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%July%' THEN
                    7 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%August%' THEN
                    8 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%September%' THEN
                    9 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%October%' THEN
                    10 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%November%' THEN
                    11 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%December%' THEN
                    12
                END AS cob 
            FROM
                vform_app
                LEFT JOIN mform ON mform.id = vform_app.id_mform
                LEFT JOIN mdept ON mdept.id = mform.idDept
                LEFT JOIN mitem ON mitem.id = vform_app.description 
            WHERE
                mform.active != 3 
                AND mitem.id_cur = 1 
                AND mdept.id = $idDept
            GROUP BY
            mform.`month` 
            ) AS T1 ON T1.m_only LIKE concat( '%', t2.`month`, '%' )
						LEFT JOIN (
            SELECT
                uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) m_only,
                CONCAT( '20', uExtractNumberFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) ) y_only,
                SUM( vform_app.`order` * vform_app.price ) tl,
            CASE
                    
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%January%' THEN
                    1 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%February%' THEN
                    2 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%March%' THEN
                    3 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%April%' THEN
                    4 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%May%' THEN
                    5 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%June%' THEN
                    6 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%July%' THEN
                    7 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%August%' THEN
                    8 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%September%' THEN
                    9 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%October%' THEN
                    10 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%November%' THEN
                    11 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%December%' THEN
                    12
                END AS cob 
            FROM
                vform_app
                LEFT JOIN mform ON mform.id = vform_app.id_mform
                LEFT JOIN mdept ON mdept.id = mform.idDept
                LEFT JOIN mitem ON mitem.id = vform_app.description 
            WHERE
                mform.active != 3 
                AND mitem.id_cur = 2 
                AND mdept.id = $idDept
            GROUP BY
            mform.`month` 
            ) AS T3 ON T3.m_only LIKE concat( '%', t2.`month`, '%' )
            ORDER BY t2.id";
        $query = $this->db->query($data);
        return $query->result();
    }

    public function dasboard_3()
    {
        $data = "SELECT
        t2.id,
        t2.`month`,
        T1.m_only,
        T1.tl,
				T3.tl usd
        FROM
            months AS t2
            LEFT JOIN (
            SELECT
                uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) m_only,
                CONCAT( '20', uExtractNumberFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) ) y_only,
                SUM( vform_app.`order` * vform_app.price ) tl,
            CASE
                    
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%January%' THEN
                    1 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%February%' THEN
                    2 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%March%' THEN
                    3 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%April%' THEN
                    4 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%May%' THEN
                    5 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%June%' THEN
                    6 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%July%' THEN
                    7 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%August%' THEN
                    8 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%September%' THEN
                    9 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%October%' THEN
                    10 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%November%' THEN
                    11 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%December%' THEN
                    12
                END AS cob 
            FROM
                vform_app
                LEFT JOIN mform ON mform.id = vform_app.id_mform
                LEFT JOIN mdept ON mdept.id = mform.idDept
                LEFT JOIN mitem ON mitem.id = vform_app.description 
            WHERE
                mform.active != 3 
                AND mitem.id_cur = 1 
            GROUP BY
            mform.`month` 
            ) AS T1 ON T1.m_only LIKE concat( '%', t2.`month`, '%' )
						LEFT JOIN (
            SELECT
                uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) m_only,
                CONCAT( '20', uExtractNumberFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) ) y_only,
                SUM( vform_app.`order` * vform_app.price ) tl,
            CASE
                    
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%January%' THEN
                    1 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%February%' THEN
                    2 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%March%' THEN
                    3 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%April%' THEN
                    4 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%May%' THEN
                    5 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%June%' THEN
                    6 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%July%' THEN
                    7 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%August%' THEN
                    8 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%September%' THEN
                    9 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%October%' THEN
                    10 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%November%' THEN
                    11 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%December%' THEN
                    12
                END AS cob 
            FROM
                vform_app
                LEFT JOIN mform ON mform.id = vform_app.id_mform
                LEFT JOIN mdept ON mdept.id = mform.idDept
                LEFT JOIN mitem ON mitem.id = vform_app.description 
            WHERE
                mform.active != 3 
                AND mitem.id_cur = 2 
            GROUP BY
            mform.`month` 
            ) AS T3 ON T3.m_only LIKE concat( '%', t2.`month`, '%' )
            ORDER BY t2.id";
        $query = $this->db->query($data);
        return $query->result();
    }

    public function get_data_per_dept($id_dept, $month, $year)
    {
        $data = "SELECT
        t1.id,
        t1.`month`,
        t1.idDept,
        t1.nf,
        t1.detail_created,
        t1.date_modified,
        t1.category,
        t1.appMan,
        t1.appAccp,
        (
        SELECT
            SUM( vform_app.`order` * vform_app.price ) AS total 
        FROM
            vform_app
            LEFT JOIN mform ON mform.id = vform_app.id_mform
            LEFT JOIN mitem ON vform_app.description = mitem.id 
        WHERE
            vform_app.id_mform = t1.id 
            AND mitem.id_cur = 1 
        ) total,
        (
        SELECT
            SUM( vform_app.`order` * vform_app.price ) AS total 
        FROM
            vform_app
            LEFT JOIN mform ON mform.id = vform_app.id_mform
            LEFT JOIN mitem ON vform_app.description = mitem.id 
        WHERE
            vform_app.id_mform = t1.id 
            AND mitem.id_cur = 2 
        ) usd  
        FROM
        mform t1 
        WHERE
        t1.active != 3 
        AND uExtractNonNumbersFromString ( REPLACE ( t1.`month`, \"'\", '' ) ) LIKE '%$month%' 
        AND CONCAT( '20', uExtractNumberFromString ( REPLACE ( t1.`month`, \"'\", '' ) ) ) LIKE '%$year%' 
        AND t1.idDept = $id_dept
        
        ";
        $query = $this->db->query($data);
        return $query->result();
    }

    public function load_list_mvoc()
    {
        $data = "SELECT
        a.id,
        a.no_voc,
        a.date_created,
        a.date_delivered,
        a.`status`,
        b.s 
        FROM
        mvoc AS a
        LEFT JOIN vocd ON vocd.id_mvoc = a.id,
        (
        SELECT
            mvoc.id,
            MIN( vocd.STATUS ) s 
        FROM
            mvoc
            LEFT JOIN vocd ON vocd.id_mvoc = mvoc.id 
        WHERE
            mvoc.`status` = 1 
            AND mvoc.pj_status IS NULL 
            GROUP BY mvoc.id
        ) AS b 
        WHERE
        a.`status` = 1 
        AND a.pj_status IS NULL 
        AND b.s = 2
        GROUP BY
        a.id";
        return $this->db->query($data);
    }

    public function load_list_po()
    {
        $data = "SELECT * FROM mpo ORDER BY mpo.po_number";
        return $this->db->query($data);
    }

    public function load_list_store()
    {
        $data = "SELECT
        mstore.id,
        mstore.store_name
        FROM
        mstore
        ";
        return $this->db->query($data);
    }

    public function del_vform_vformapp($id)
    {
        $query = "DELETE vform, vform_app
        FROM vform, vform_app
        WHERE vform.id = vform_app.id AND vform.id = $id";
        $this->db->query($query);
    }

    public function sum_per_dept($label, $year, $id_cur, $id_dept)
    {
        if ($id_dept == "16") {
            $data = "SELECT
            SUM( vform_app.`order` * vform_app.price ) tl,
            CASE
                    
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%January%' THEN
                    1 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%February%' THEN
                    2
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%March%' THEN
                    3
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%April%' THEN
                    4
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%May%' THEN
                    5
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%June%' THEN
                    6
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%July%' THEN
                    7
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%August%' THEN
                    8
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%October%' THEN
                    9
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%October%' THEN
                    10
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%November%' THEN
                    11
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%December%' THEN
                    12
                END AS cob,
                mdept.`name`,
                mdept.id,
                CONCAT( '20', uExtractNumberFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) ) AS yer,
                uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) AS mon
            FROM
                vform_app
                LEFT JOIN mform ON mform.id = vform_app.id_mform
                LEFT JOIN mdept ON mdept.id = mform.idDept 
                LEFT JOIN mitem ON mitem.id = vform_app.description
            WHERE
                mform.active != 3 
                AND uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%$label%'
                AND CONCAT( '20', uExtractNumberFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) ) LIKE '%$year%'
                AND mitem.id_cur = $id_cur
                GROUP BY mform.idDept
                ORDER BY tl DESC";
        } else {
            $data = "SELECT
            SUM( vform_app.`order` * vform_app.price ) tl,
            CASE
                    
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%January%' THEN
                    1 
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%February%' THEN
                    2
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%March%' THEN
                    3
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%April%' THEN
                    4
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%May%' THEN
                    5
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%June%' THEN
                    6
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%July%' THEN
                    7
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%August%' THEN
                    8
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%October%' THEN
                    9
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%October%' THEN
                    10
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%November%' THEN
                    11
                    WHEN uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%December%' THEN
                    12
                END AS cob,
                mdept.`name`,
                mdept.id,
                CONCAT( '20', uExtractNumberFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) ) AS yer,
                uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) AS mon
            FROM
                vform_app
                LEFT JOIN mform ON mform.id = vform_app.id_mform
                LEFT JOIN mdept ON mdept.id = mform.idDept 
                LEFT JOIN mitem ON mitem.id = vform_app.description
            WHERE
                mform.active != 3 
                AND uExtractNonNumbersFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) LIKE '%$label%'
                AND CONCAT( '20', uExtractNumberFromString ( REPLACE ( mform.`month`, \"'\", '' ) ) ) LIKE '%$year%'
                AND mitem.id_cur = $id_cur
                AND mdept.id = $id_dept
                GROUP BY mform.idDept
                ORDER BY tl DESC";
        }

        $query = $this->db->query($data);
        return $query->result();
    }

    public function get_count($id)
    {
        $data = "SELECT
        counting.id,
        counting.id_mform,
        counting.`first`,
        counting.`second`,
        counting.final
        FROM
        counting
        WHERE
        counting.id_mform = $id";
        $query = $this->db->query($data);
        return $query->result();
    }

    public function get_record($id)
    {
        $data = "SELECT
        SUM(counting.`first`) total,
        SUM(counting.`second`) purchasing,
        SUM(counting.`final`) general
        FROM
        counting
        WHERE
        counting.id_mform = $id";
        $query = $this->db->query($data);
        return $query->result();
    }
}
