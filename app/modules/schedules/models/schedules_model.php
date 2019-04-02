<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class schedules_model extends MY_Model {
	public function __construct(){
		parent::__construct();
	}

	private $cds = INSTAGRAM_SCHEDULES;

	function get_cd_list() {
        /* Array of table columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array(
            'id',
            'account_name',
            'name',
            'group_type',
            'time_post_show',
            'repeat_post',
            'status',
            'created', 
            'message_error'
        );

        if(segment(2) == "repost_pages"){
        	$aColumns = array(
	            'id',
	            'account_name',
	            'name',
	            'group_type',
	            'title',
	            'time_post_show',
	            'status',
	            'created', 
	            'message_error'
	        );
        }

 
        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "id";
 
        /* Total data set length */
        $sQuery = "SELECT COUNT('" . $sIndexColumn . "') AS row_count
            FROM $this->cds";
        $rResultTotal = $this->db->query($sQuery);
        $aResultTotal = $rResultTotal->row();
        $iTotal = $aResultTotal->row_count;
 
        /*
         * Paging
         */
        $sLimit = "";
        $iDisplayStart = $this->input->get_post('start', true);
        $iDisplayLength = $this->input->get_post('length', true);
        if (isset($iDisplayStart) && $iDisplayLength != '-1') {
            $sLimit = "LIMIT " . intval($iDisplayStart) . ", " .
                    intval($iDisplayLength);
        }

        $uri_string = $_SERVER['QUERY_STRING'];
        $uri_string = preg_replace("/%5B/", '[', $uri_string);
        $uri_string = preg_replace("/%5D/", ']', $uri_string);
 
        $get_param_array = explode("&", $uri_string);
        $arr = array();
        if(!empty($get_param_array)){
	        foreach ($get_param_array as $value) {
	            $v = $value;
	            $explode = explode("=", $v);
	            $arr[$explode[0]] = $explode[1];
	        }
	    }
 
        $index_of_columns = strpos($uri_string, "columns", 1);
        $index_of_start = strpos($uri_string, "start");
        $uri_columns = substr($uri_string, 7, ($index_of_start - $index_of_columns - 1));
        $columns_array = explode("&", $uri_columns);
        $arr_columns = array();
        foreach ($columns_array as $value) {
            $v = $value;
            $explode = explode("=", $v);
            if (count($explode) == 2) {
                $arr_columns[$explode[0]] = $explode[1];
            } else {
                $arr_columns[$explode[0]] = '';
            }
        }
 
        /*
         * Ordering
         */
        if(isset($arr['order[0][column]'])){
	        $sOrder = "ORDER BY ";
	        $sOrderIndex = $arr['order[0][column]'];
	        $sOrderDir = $arr['order[0][dir]'];
	        $bSortable_ = $arr_columns['columns[' . $sOrderIndex . '][orderable]'];
	        if ($bSortable_ == "true") {
	            $sOrder .= $aColumns[$sOrderIndex] .
	                    ($sOrderDir === 'asc' ? ' asc' : ' desc');
	        }
	    }else{
	    	$sOrder = "";
	    }
	 
        /*
         * Filtering
         */
        switch (segment(2)) {
			case 'post': 
				$wCate = "category = '".segment(2)."'";
				break;

			case 'friend':
				$wCate = "category = '".segment(2)."'";
				break;

			case 'message':
				$wCate = "category = '".segment(2)."'";
				break;

			case 'join':
				$wCate = "category = '".segment(2)."'";
				break;

			case 'comment':
				$wCate = "category = '".segment(2)."'";
				break;

			case 'like':
				$wCate = "category = '".segment(2)."'";
				break;
			case 'add_friends':
				$wCate = "category = 'add'";
				break;
			case 'unfriends':
				$wCate = "category = '".segment(2)."'";
				break;
			case 'invite_to_groups':
				$wCate = "category = '".segment(2)."'";
				break;
			case 'invite_to_pages':
				$wCate = "category = '".segment(2)."'";
				break;
			case 'accept_friend_request':
				$wCate = "category = '".segment(2)."'";
				break;

			case 'repost_pages':
				$wCate = "category = '".segment(2)."'";
				break;
		}
 	
 		$sWhere = "WHERE {$wCate} ".getDatabyUser()." ";
        $sSearchVal = $arr['search[value]'];
        if (isset($sSearchVal) && $sSearchVal != '') {
            $sWhere = $sWhere."AND (";
            for ($i = 0; $i < count($aColumns); $i++) {
                $sWhere .= $aColumns[$i] . " LIKE '%" . $this->db->escape_like_str($sSearchVal) . "%' OR ";
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
        }

        /* Individual column filtering */
        $sSearchReg = $arr['search[regex]'];
        for ($i = 0; $i < count($aColumns); $i++) {
        	if(isset($arr['columns[' . $i . '][searchable]'])){
	            $bSearchable_ = $arr['columns[' . $i . '][searchable]'];
	            if (isset($bSearchable_) && $bSearchable_ == "true" && $sSearchReg != 'false') {
	                $search_val = $arr['columns[' . $i . '][search][value]'];

	                if ($sWhere == "") {
	                    $sWhere = "WHERE category = '".segment(2)."' AND ";
	                } else {
	                    $sWhere .= "AND category = '".segment(2)."' AND ";
	                }
	                $sWhere .= $aColumns[$i] . " LIKE '%" . $this->db->escape_like_str($search_val) . "%' ";
	            }
	        }
        }
 
        /*
         * SQL queries
         * Get data to display
         */
        $sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . "
        FROM $this->cds
        $sWhere
        $sOrder
        $sLimit
        ";
        $rResult = $this->db->query($sQuery);

        /* Data set length after filtering */
        $sQuery = "SELECT FOUND_ROWS() AS length_count";
        $rResultFilterTotal = $this->db->query($sQuery);
        $aResultFilterTotal = $rResultFilterTotal->row();
        $iFilteredTotal = $aResultFilterTotal->length_count;
 
        /*
         * Output
         */
        $sEcho = $this->input->get_post('draw', true);
        $output = array(
            "draw" => intval($sEcho),
            "recordsTotal" => $iTotal,
            "recordsFiltered" => $iFilteredTotal,
            "data" => array()
        );
 
        foreach ($rResult->result_array() as $aRow) {
            $row = array();
            foreach ($aColumns as $col) {
                $row[] = $aRow[$col];
            }
            $row[0] =   '<input type="checkbox" name="id[]" id="md_checkbox_'.$row[0].'" class="filled-in chk-col-red checkItem" value="'.$row[0].'">
                        <label class="p0 m0" for="md_checkbox_'.$row[0].'">&nbsp;</label>';

            $row[6] =   '<span data-toggle="tooltip" title="'.$row[8].'">'.status_post($row[6]).'</span>';
            $output['data'][] = $row;
        }
 
        return $output;
    }

	public function getSchedules($type = ""){
		$this->db->select("*");
		switch ($type) {
			case 'post': 
				if(!permission("post")){
					redirect(PATH);
				}
				$this->db->where("category = '".$type."'");
				break;
		}

		if(IS_ADMIN != 1){
			$this->db->where('uid', session("uid"));
		}
		$this->db->limit(5000, 0);
		$query = $this->db->get(INSTAGRAM_SCHEDULES);
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
}
 