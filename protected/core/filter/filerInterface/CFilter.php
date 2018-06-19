<?php
interface CFilter
{
	public function init($filterConfig);
	public function doFilter($filterChain);

}