<?php

class Paginate{
	public $current_page;
	public $item_per_page;
	public $item_total_count;

	function __construct($p=1,$itp=5,$itc=0){
		$this->current_page = (int)$p;
		$this->item_per_page = (int)$itp;
		$this->item_total_count = (int)$itc;
	}

	public function next(){
		return $this->current_page+1;
	}

	public function prev(){
		return $this->current_page-1;	
	}

	public function page_total(){
		return ceil($this->item_total_count/$this->item_per_page);
	}

	public function has_prev(){
		return (($this->current_page) >1);
	}

	public function has_next(){
		return ($this->current_page < $this->page_total());
	}

	public function offset(){
		return ($this->current_page-1)*$this->item_per_page;
	}
};



?>