<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class search extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
		permission_view();
	}

	public function index(){
		$data = array(
			"accounts" => $account = $this->model->fetch("*", INSTAGRAM_ACCOUNTS, getDatabyUser(0))
		);
		$this->template->title(l('Instagram search'));
		$this->template->build('index', $data);
	}

	public function ajax_search(){
		$id      = (int)post("account");
		$account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$id."'".getDatabyUser());
		if(!empty($account)){
			//Add Proxy
			$proxy_item = $this->model->get("*", PROXY, "id = '".$account->proxy."'");
			if(!empty($proxy_item)){
				$proxy = $proxy_item->proxy;
			}else{
				$proxy = "";
			}

			$i = Instagram_Loader($account->username, $account->password, $proxy);

			if(post("keyword")){

                    switch (post("type")) {
                        case 'tag':
                            $result = Instagram_Get_Feed($i, 'search_tags', post("keyword"));
                            ms(array(
                                "st" => "success",
                                "label" => "bg-green",
                                "txt" => l('Successfully'),
                                "result" => json_encode($this->load->view("ajax_search_tags", array("result" => $result), true))
                            ));
                            break;

                        case 'followers':
                            $result = Instagram_Get_Follow($i, 'followers', (int)post("limit"));

                            ms(array(
                                "st" => "success",
                                "label" => "bg-green",
                                "txt" => l('Successfully'),
                                "result" => json_encode($this->load->view("ajax_search_tags", array("result" => $result), true))
                            ));
                            break;

                        case 'following':
                            $result = Instagram_Get_Follow($i, 'following', (int)post("limit"));

                            ms(array(
                                "st" => "success",
                                "label" => "bg-green",
                                "txt" => l('Successfully'),
                                "result" => json_encode($this->load->view("ajax_search_tags", array("result" => $result), true))
                            ));
                            break;

                        default:
                            $result = Instagram_Get_Feed($i, 'search_users', post("keyword"));

                            ms(array(
                                "st" => "success",
                                "label" => "bg-green",
                                "txt" => l('Successfully'),
                                "result" => json_encode($this->load->view("ajax_search_usernames", array("result" => $result), true))
                            ));
                            break;
                    }

			}else{
				ms(array(
					"st"  => "error",
					"label" => "bg-red",
					"txt" => l('Keyword is required'),
				));
			}
		}else{
			ms(array(
				"st"  => "error",
				"label" => "bg-red",
				"txt" => l('Instagram account not exist'),
			));
		}
	}

	public function ajax_open_search_tags(){
        $accid = $this->input->get_post('newid');
		$accounts = $this->model->fetch("*", INSTAGRAM_ACCOUNTS, "uid = '".session("uid")."'");
		print_r($this->load->view("ajax_open_search_tags", array("accounts" => $accounts, "accid" => $accid), true));
	}
	
	public function search_tag(){
		if(post("tag") != ""){
			$account = (int)post("account");
			$IG = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$account."'".getDatabyUser());
			if(!empty($IG)){
				//Add Proxy
				$proxy_item = $this->model->get("*", PROXY, "id = '".$IG->proxy."'");
				if(!empty($proxy_item)){
					$proxy = $proxy_item->proxy;
				}else{
					$proxy = "";
				}

				$result = Instagram_Search_Hashtags($IG, post("tag"), $proxy);
//				var_dump(is_object($result));die();
				if(is_object($result)){
					if(null !== $result->getStatus() && $result->getStatus() == "ok"){
						ms(array(
							"st"  => "success",
							"label" => "bg-green",
							"txt" => l('Successfully'),
							"result" => json_encode($this->load->view("ajax_tags", array("result" => $result->getResults()), true))
						));
					}
					
				}else{
					ms(array(
						"st"  => "error",
						"label" => "bg-red",
						"txt" => $result
					));
				}
			}else{
				ms(array(
					"st"  => "error",
					"label" => "bg-red",
					"txt" => l('Instagram account does not exist')
				));
			}
		}else{
			ms(array(
				"st"  => "error",
				"label" => "bg-red",
				"txt" => l('Please enter hashtag')
			));
		}	
	}

	public function ajax_open_add_comments(){
		print_r($this->load->view("ajax_open_add_comments", array(), true));
	}

	public function ajax_open_add_messages(){
		print_r($this->load->view("ajax_open_add_messages", array(), true));
	}

	public function ajax_open_search_locations(){

        $accid = $this->input->get_post('newid');
		$accounts = $this->model->fetch("*", INSTAGRAM_ACCOUNTS, "uid = '".session("uid")."'");
		print_r($this->load->view("ajax_open_search_locations", array("accounts" => $accounts, "accid" => $accid), true));
	}

	public function search_location(){
		if(post("lat") != "" && post("lng") != "" && post("keyword") != ""){
			$account = (int)post("account");
			$IG = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$account."'".getDatabyUser());
			if(!empty($IG)){
				//Add Proxy
				$proxy_item = $this->model->get("*", PROXY, "id = '".$IG->proxy."'");
				if(!empty($proxy_item)){
					$proxy = $proxy_item->proxy;
				}else{
					$proxy = "";
				}

				$result = Instagram_Search_Locations($IG, post("lat"), post("lng"), post("keyword"), $proxy);

				if(is_object($result)){
					if(null !== $result->getStatus() && $result->getStatus() == "ok"){
						ms(array(
							"st"  => "success",
							"label" => "bg-green",
							"txt" => l('Successfully'),
							"result" => json_encode($this->load->view("ajax_locations", array("result" => $result->getVenues()), true))
						));
					}
					
				}else{
					ms(array(
						"st"  => "error",
						"label" => "bg-red",
						"txt" => $result
					));
				}
			}else{
				ms(array(
					"st"  => "error",
					"label" => "bg-red",
					"txt" => l('Instagram account does not exist')
				));
			}
		}else{
			ms(array(
				"st"  => "error",
				"label" => "bg-red",
				"txt" => l('Please enter location')
			));
		}	
	}

	public function ajax_open_search_usernames(){
        $accid = $this->input->get_post('newid');
		$accounts = $this->model->fetch("*", INSTAGRAM_ACCOUNTS, "uid = '".session("uid")."'");
		print_r($this->load->view("ajax_open_search_usernames", array("accounts" => $accounts, "accid" => $accid), true));
	}

	public function search_username(){
		if(post("username") != ""){
			$account = (int)post("account");
			$IG = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$account."'".getDatabyUser());
			if(!empty($IG)){
				//Add Proxy
				$proxy_item = $this->model->get("*", PROXY, "id = '".$IG->proxy."'");
				if(!empty($proxy_item)){
					$proxy = $proxy_item->proxy;
				}else{
					$proxy = "";
				}

				$result = Instagram_Search_Usernames($IG, post("username"), $proxy);
				if(is_object($result)){
					if(null !== $result->getStatus() && $result->getStatus() == "ok"){
						ms(array(
							"st"  => "success",
							"label" => "bg-green",
							"txt" => l('Successfully'),
							"result" => json_encode($this->load->view("ajax_usernames", array("result" => $result->getUsers()), true))
						));
					}
					
				}else{
					ms(array(
						"st"  => "error",
						"label" => "bg-red",
						"txt" => $result
					));
				}
			}else{
				ms(array(
					"st"  => "error",
					"label" => "bg-red",
					"txt" => l('Instagram account does not exist')
				));
			}
		}else{
			ms(array(
				"st"  => "error",
				"label" => "bg-red",
				"txt" => l('Please enter username')
			));
		}	
	}




	// Add blacklist-tags
	public function ajax_open_blacklist_tags(){
		$accounts = $this->model->fetch("*", INSTAGRAM_ACCOUNTS, "uid = '".session("uid")."'");
		print_r($this->load->view("ajax_open_blacklist_tags", array("accounts" => $accounts), true));
	}

	// Add blacklist-usernames
	public function ajax_open_blacklist_usernames(){
		$accounts = $this->model->fetch("*", INSTAGRAM_ACCOUNTS, "uid = '".session("uid")."'");
		print_r($this->load->view("ajax_open_blacklist_usernames", array("accounts" => $accounts), true));
	}
	
	// Add blacklist-keywords
	public function ajax_open_blacklist_keywords(){
		$accounts = $this->model->fetch("*", INSTAGRAM_ACCOUNTS, "uid = '".session("uid")."'");
		print_r($this->load->view("ajax_open_blacklist_keywords", array("accounts" => $accounts), true));
	}

    public function save_tags(){
        $id = (int)post('id');
        $data = post('indata');
        $accounts = $this->db->get_where(INSTAGRAM_ACTIVITY, array( "id" => $id ));
        $resp = $accounts->num_rows()>0?$accounts->result_array():"";
        if($resp != ''){

            $newdata = $resp[0]['data'];
            $schedule = json_decode($newdata);

            if($schedule->comments == "null"){

                $tags = array($data);

            }else{
                $tags = json_decode($schedule->tags);
                array_push($tags,$data);
            }

            $newarray = [
                "todo" => $schedule->todo,
                "targets" => $schedule->targets,
                "speed" => $schedule->speed,
                "tags" => json_encode($tags),
                "usernames" => $schedule->usernames,
                "locations" => $schedule->locations,
                "comments" => $schedule->comments,
                "messages" => $schedule->messages,
                "filter" => $schedule->filter
            ];

            $inarray = json_encode($newarray);

            $this->db->where('id',$id);
            $updata= $this->db->update(INSTAGRAM_ACTIVITY, array( "data" => $inarray ));

            if($updata){
                ms(array(
                    "st"  => "success",
                    "label" => "bg-green",
                    "txt" => l('Success'),
                    "intag" => $data
//                    "result" => json_encode($this->load->view("ajax_usernames", array("result" => $result->getUsers()), true))
                ));
            }else{
                ms(array(
                    "st"  => "error",
                    "label" => "bg-red",
                    "txt" => l('Something Went Wrong!')
                ));
            }



        }else{
            ms(array(
                "st"  => "error",
                "label" => "bg-red",
                "txt" => l('Data Not Found!')
            ));
        }

    }

    public function getactivity(){
        $id = (int)post('id');
        $accounts = $this->db->get_where(INSTAGRAM_ACCOUNTS, array( "id" => $id ));
        $resp = $accounts->num_rows()>0?$accounts->result_array():"";

        if($resp != ''){

            $newdata = $resp[0]['logs_counter'];
            $schedule = json_decode($newdata);
            $like = $schedule->like;
            $follow = $schedule->follow;
            $unfollow = $schedule->unfollow;
            $comment = $schedule->comment;

            ms(array(
                "st"  => "success",
                "label" => "bg-green",
                "txt" => l('Success'),
                "like" => $like,
                "comment" => $comment,
                "unfollow" => $unfollow,
                "follow" => $follow,
//                    "result" => json_encode($this->load->view("ajax_usernames", array("result" => $result->getUsers()), true))
            ));

        }else{
            ms(array(
                "st"  => "error",
                "label" => "bg-red",
                "txt" => l('Something Went Wrong!')
            ));
        }
    }

    public function save_comments(){
        $id = (int)post('id');
        $data = post('indata');
        $accounts = $this->db->get_where(INSTAGRAM_ACTIVITY, array( "id" => $id ));
        $resp = $accounts->num_rows()>0?$accounts->result_array():"";
        if($resp != ''){

            $newdata = $resp[0]['data'];
            $schedule = json_decode($newdata);


            if($schedule->comments == "null"){

                $comments = array($data);

            }else{
                $comments = json_decode($schedule->comments);
                array_push($comments,$data);
            }

            $newarray = [
                "todo" => $schedule->todo,
                "targets" => $schedule->targets,
                "speed" => $schedule->speed,
                "tags" => $schedule->tags,
                "usernames" => $schedule->usernames,
                "locations" => $schedule->locations,
                "comments" => json_encode($comments),
                "messages" => $schedule->messages,
                "filter" => $schedule->filter
            ];

            $inarray = json_encode($newarray);

            $this->db->where('id',$id);
            $updata= $this->db->update(INSTAGRAM_ACTIVITY, array( "data" => $inarray ));

            if($updata){
                ms(array(
                    "st"  => "success",
                    "label" => "bg-green",
                    "txt" => l('Success'),
                    "incomments" => $data
//                    "result" => json_encode($this->load->view("ajax_usernames", array("result" => $result->getUsers()), true))
                ));
            }else{
                ms(array(
                    "st"  => "error",
                    "label" => "bg-red",
                    "txt" => l('Something Went Wrong!')
                ));
            }



        }else{
            ms(array(
                "st"  => "error",
                "label" => "bg-red",
                "txt" => l('Data Not Found!')
            ));
        }

    }

    public function save_location(){
        $id = (int)post('id');
        $data = post('indata');
        $accounts = $this->db->get_where(INSTAGRAM_ACTIVITY, array( "id" => $id ));
        $resp = $accounts->num_rows()>0?$accounts->result_array():"";
        if($resp != ''){

            $newdata = $resp[0]['data'];
            $schedule = json_decode($newdata);


            if($schedule->locations == "null"){

                $locations = array($data);

            }else{
                $locations = json_decode($schedule->locations);
                array_push($locations,$data);
            }

            $newarray = [
                "todo" => $schedule->todo,
                "targets" => $schedule->targets,
                "speed" => $schedule->speed,
                "tags" => $schedule->tags,
                "usernames" => $schedule->usernames,
                "locations" => json_encode($locations),
                "comments" => $schedule->comments,
                "messages" => $schedule->messages,
                "filter" => $schedule->filter
            ];

            $inarray = json_encode($newarray);

            $this->db->where('id',$id);
            $updata= $this->db->update(INSTAGRAM_ACTIVITY, array( "data" => $inarray ));

            if($updata){

                $name = explode('|',$data);

                ms(array(
                    "st"  => "success",
                    "label" => "bg-green",
                    "txt" => l('Success'),
                    "inloc" => $data,
                    "inname" => $name[0]
//                    "result" => json_encode($this->load->view("ajax_usernames", array("result" => $result->getUsers()), true))
                ));
            }else{
                ms(array(
                    "st"  => "error",
                    "label" => "bg-red",
                    "txt" => l('Something Went Wrong!')
                ));
            }



        }else{
            ms(array(
                "st"  => "error",
                "label" => "bg-red",
                "txt" => l('Data Not Found!')
            ));
        }

    }

    public function save_usernames(){
        $id = (int)post('id');
        $data = post('indata');
        $inid = post('inid');
        $accounts = $this->db->get_where(INSTAGRAM_ACTIVITY, array( "id" => $id ));
        $resp = $accounts->num_rows()>0?$accounts->result_array():"";
        if($resp != ''){

            $newdata = $resp[0]['data'];
            $newin = $inid.'|'.$data;
            $schedule = json_decode($newdata);
            if($schedule->usernames == "null"){

                $usernames = array($newin);

            }else{
                $usernames = json_decode($schedule->usernames);
                array_push($usernames,$newin);
            }
            $newarray = [
                "todo" => $schedule->todo,
                "targets" => $schedule->targets,
                "speed" => $schedule->speed,
                "tags" => $schedule->tags,
                "usernames" => json_encode($usernames),
                "locations" => $schedule->locations,
                "comments" => $schedule->comments,
                "messages" => $schedule->messages,
                "filter" => $schedule->filter
            ];

            $inarray = json_encode($newarray);

            $this->db->where('id',$id);
            $updata= $this->db->update(INSTAGRAM_ACTIVITY, array( "data" => $inarray ));

            if($updata){
                ms(array(
                    "st"  => "success",
                    "label" => "bg-green",
                    "txt" => l('Success'),
                    "inid" => $inid ,
                    "inuser" => $data
//                    "result" => json_encode($this->load->view("ajax_usernames", array("result" => $result->getUsers()), true))
                ));
            }else{
                ms(array(
                    "st"  => "error",
                    "label" => "bg-red",
                    "txt" => l('Something Went Wrong!')
                ));
            }



        }else{
            ms(array(
                "st"  => "error",
                "label" => "bg-red",
                "txt" => l('Data Not Found!')
            ));
        }

    }

    public function save_message(){
        $id = (int)post('id');
        $data = post('indata');
        $accounts = $this->db->get_where(INSTAGRAM_ACTIVITY, array( "id" => $id ));
        $resp = $accounts->num_rows()>0?$accounts->result_array():"";
        if($resp != ''){

            $newdata = $resp[0]['data'];
            $schedule = json_decode($newdata);
            if($schedule->usernames == "null"){

                $messages = array($data);

            }else{
                $messages = json_decode($schedule->messages);
                array_push($messages,$data);
            }
            $newarray = [
                "todo" => $schedule->todo,
                "targets" => $schedule->targets,
                "speed" => $schedule->speed,
                "tags" => $schedule->tags,
                "usernames" => $schedule->usernames,
                "locations" => $schedule->locations,
                "comments" => $schedule->comments,
                "messages" => json_encode($messages),
                "filter" => $schedule->filter
            ];

            $inarray = json_encode($newarray);

            $this->db->where('id',$id);
            $updata= $this->db->update(INSTAGRAM_ACTIVITY, array( "data" => $inarray ));

            if($updata){
                ms(array(
                    "st"  => "success",
                    "label" => "bg-green",
                    "txt" => l('Success'),
                    "inmes" => $data
//                    "result" => json_encode($this->load->view("ajax_usernames", array("result" => $result->getUsers()), true))
                ));
            }else{
                ms(array(
                    "st"  => "error",
                    "label" => "bg-red",
                    "txt" => l('Something Went Wrong!')
                ));
            }



        }else{
            ms(array(
                "st"  => "error",
                "label" => "bg-red",
                "txt" => l('Data Not Found!')
            ));
        }

    }

    public function save_blacktag(){
        $id = (int)post('id');
        $data = post('indata');
        $accounts = $this->db->get_where(INSTAGRAM_ACTIVITY, array( "id" => $id ));
        $resp = $accounts->num_rows()>0?$accounts->result_array():"";
        if($resp != ''){

            $newdata = $resp[0]['blacklists'];
            $schedule = json_decode($newdata);
            if($schedule->bl_tags == "null"){

                $bl_tags = array($data);

            }else{
                $bl_tags = json_decode($schedule->bl_tags);
                array_push($bl_tags,$data);
            }
            $newarray = [
                "bl_tags" => json_encode($bl_tags),
                "bl_usernames" => $schedule->bl_usernames,
                "bl_keywords" => $schedule->bl_keywords
            ];

            $inarray = json_encode($newarray);

            $this->db->where('id',$id);
            $updata= $this->db->update(INSTAGRAM_ACTIVITY, array( "blacklists" => $inarray ));

            if($updata){
                ms(array(
                    "st"  => "success",
                    "label" => "bg-green",
                    "txt" => l('Success'),
                    "intag" => $data
//                    "result" => json_encode($this->load->view("ajax_usernames", array("result" => $result->getUsers()), true))
                ));
            }else{
                ms(array(
                    "st"  => "error",
                    "label" => "bg-red",
                    "txt" => l('Something Went Wrong!')
                ));
            }



        }else{
            ms(array(
                "st"  => "error",
                "label" => "bg-red",
                "txt" => l('Data Not Found!')
            ));
        }

    }

    public function save_blackuser(){

        $id = (int)post('id');
        $data = post('indata');
        $accounts = $this->db->get_where(INSTAGRAM_ACTIVITY, array( "id" => $id ));
        $resp = $accounts->num_rows()>0?$accounts->result_array():"";
        if($resp != ''){

            $newdata = $resp[0]['blacklists'];
            $schedule = json_decode($newdata);
            if($schedule->bl_usernames == "null"){

                $bl_usernames = array($data);

            }else{
                $bl_usernames = json_decode($schedule->bl_usernames);
                array_push($bl_usernames,$data);
            }
            $newarray = [
                "bl_tags" => $schedule->bl_tags,
                "bl_usernames" => json_encode($bl_usernames),
                "bl_keywords" => $schedule->bl_keywords
            ];

            $inarray = json_encode($newarray);

            $this->db->where('id',$id);
            $updata= $this->db->update(INSTAGRAM_ACTIVITY, array( "blacklists" => $inarray ));

            if($updata){
                ms(array(
                    "st"  => "success",
                    "label" => "bg-green",
                    "txt" => l('Success'),
                    "inuser" => $data
//                    "result" => json_encode($this->load->view("ajax_usernames", array("result" => $result->getUsers()), true))
                ));
            }else{
                ms(array(
                    "st"  => "error",
                    "label" => "bg-red",
                    "txt" => l('Something Went Wrong!')
                ));
            }



        }else{
            ms(array(
                "st"  => "error",
                "label" => "bg-red",
                "txt" => l('Data Not Found!')
            ));
        }

    }

    public function save_blackkey(){

        $id = (int)post('id');
        $data = post('indata');
        $accounts = $this->db->get_where(INSTAGRAM_ACTIVITY, array( "id" => $id ));
        $resp = $accounts->num_rows()>0?$accounts->result_array():"";
        if($resp != ''){

            $newdata = $resp[0]['blacklists'];
            $schedule = json_decode($newdata);
            if($schedule->bl_keywords == "null"){

                $bl_keywords = array($data);

            }else{
                $bl_keywords = json_decode($schedule->bl_keywords);
                array_push($bl_keywords,$data);
            }
            $newarray = [
                "bl_tags" => $schedule->bl_tags,
                "bl_usernames" => $schedule->bl_usernames,
                "bl_keywords" => json_encode($bl_keywords)
            ];

            $inarray = json_encode($newarray);

            $this->db->where('id',$id);
            $updata= $this->db->update(INSTAGRAM_ACTIVITY, array( "blacklists" => $inarray ));

            if($updata){
                ms(array(
                    "st"  => "success",
                    "label" => "bg-green",
                    "txt" => l('Success'),
                    "inkey" => $data
//                    "result" => json_encode($this->load->view("ajax_usernames", array("result" => $result->getUsers()), true))
                ));
            }else{
                ms(array(
                    "st"  => "error",
                    "label" => "bg-red",
                    "txt" => l('Something Went Wrong!')
                ));
            }



        }else{
            ms(array(
                "st"  => "error",
                "label" => "bg-red",
                "txt" => l('Data Not Found!')
            ));
        }

    }

    public function ajax_add_email(){
        $id = (int)post('id');
        $email = post('email');

        if($email == ''){
            ms(array(
                "st"  => "error",
                "label" => "bg-red",
                "txt" => l('Please enter an email id.')
            ));
        }

        $uid = session('uid');
        $accounts = $this->db->get_where('emailalert', array( "account_id" => $id , 'uid' => $uid ));
        $resp = $accounts->num_rows()>0?$accounts->result_array():"";
        if($resp != ''){



            $this->db->where('account_id',$id);
            $this->db->where('uid',$uid);
            $updata= $this->db->update('emailalert', array( "email" => $email ));

            if($updata){
                ms(array(
                    "st"  => "success",
                    "label" => "bg-green",
                    "txt" => l('Successfully Updated'),
//                    "result" => json_encode($this->load->view("ajax_usernames", array("result" => $result->getUsers()), true))
                ));
            }else{
                ms(array(
                    "st"  => "error",
                    "label" => "bg-red",
                    "txt" => l('Something Went Wrong! Please try again.')
                ));
            }

        }else{

            $updata= $this->db->insert('emailalert', array( "uid"=>$uid,"account_id"=> $id,"email" => $email ));
            if($updata){
                ms(array(
                    "st"  => "success",
                    "label" => "bg-green",
                    "txt" => l('Successfully Added'),
//                    "result" => json_encode($this->load->view("ajax_usernames", array("result" => $result->getUsers()), true))
                ));
            }else{
                ms(array(
                    "st"  => "error",
                    "label" => "bg-red",
                    "txt" => l('Something Went Wrong! Please try again.')
                ));
            }

        }

    }

    public function ajax_delete_email(){
        $id = (int)post('id');
//        $email = post('email');
        $uid = session('uid');
        $accounts = $this->db->get_where('emailalert', array( "account_id" => $id , 'uid' => $uid ));
        $resp = $accounts->num_rows()>0?$accounts->result_array():"";
        if($resp != ''){



            $this->db->where('account_id',$id);
            $this->db->where('uid',$uid);
            $updata= $this->db->delete('emailalert');

            if($updata){
                ms(array(
                    "st"  => "success",
                    "label" => "bg-green",
                    "txt" => l('Successfully Removed'),
//                    "result" => json_encode($this->load->view("ajax_usernames", array("result" => $result->getUsers()), true))
                ));
            }else{
                ms(array(
                    "st"  => "error",
                    "label" => "bg-red",
                    "txt" => l('Something Went Wrong! Please try again.')
                ));
            }

        }else{


                ms(array(
                    "st"  => "error",
                    "label" => "bg-red",
                    "txt" => l("You haven't added any email.")
                ));


        }

    }

}