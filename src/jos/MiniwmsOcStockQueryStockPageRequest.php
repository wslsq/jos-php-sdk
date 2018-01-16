<?php

namespace jos;

class MiniwmsOcStockQueryStockPageRequest
{
	private $apiParas = array();
	
	public function getApiMethodName(){
	  return "jingdong.miniwms.oc.stock.queryStockPage";
	}
	
	public function getApiParas(){
		return json_encode($this->apiParas);
	}
	
	public function check(){
		
	}
	
	public function putOtherTextParam($key, $value){
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
                                                        		                                    	                   			private $stationId;
    	                        
	public function setStationId($stationId){
		$this->stationId = $stationId;
         $this->apiParas["stationId"] = $stationId;
	}

	public function getStationId(){
	  return $this->stationId;
	}

                        	                   			private $pageSize;
    	                        
	public function setPageSize($pageSize){
		$this->pageSize = $pageSize;
         $this->apiParas["pageSize"] = $pageSize;
	}

	public function getPageSize(){
	  return $this->pageSize;
	}

                        	                   			private $page;
    	                        
	public function setPage($page){
		$this->page = $page;
         $this->apiParas["page"] = $page;
	}

	public function getPage(){
	  return $this->page;
	}

                            }





        
 

