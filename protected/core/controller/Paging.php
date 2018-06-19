<?php
class Paging{

	public $nlinks=2;
	public $currentPage;
	public $totalPage;
	public $lastPage;
	public $firstPage;
	public $hasNext=true;
	public $hasPre=true;
	public $pageSize;
	public $totalItems;
	public $items;
	public $pageRange;

	function __construct($currentPage, $nlinks, $pageSize, $totalItems){
		$this->nlinks=$nlinks;
		$this->pageSize=$pageSize;
		$this->totalItems=$totalItems;
		$this->currentPage=$currentPage;

		if($this->currentPage==0)$this->currentPage=1;

		$this->totalPage=floor($this->totalItems/$this->pageSize);

		if($this->totalItems % $this->pageSize!=0)
			$this->totalPage= $this->totalPage+1;

		if($this->currentPage>=$this->totalPage){
			$this->currentPage=$this->totalPage;
			$this->hasNext=false;
			$this->lastPage=$this->totalPage;
		}else{
			$this->hasNext=true;
			$this->lastPage=$this->currentPage+$this->nlinks;
			if($this->lastPage>=$this->totalPage){
				$this->lastPage=$this->totalPage;
			}
		}
		if($this->currentPage<=1){
			$this->currentPage=1;
			$this->hasPre=false;
			$this->firstPage=1;
		}else{
			$this->hasPre=true;
			$this->firstPage=$this->currentPage-$this->nlinks;
			if($this->firstPage<=1){
				$this->firstPage=1;
			}
		}

		$this->pageRange=array();
		for($i=$this->firstPage;$i<=$this->lastPage;$i++)
			$this->pageRange[]=$i;
	}

	function __destruct(){
	}

}