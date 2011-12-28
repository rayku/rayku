<?php

class UserActivityFilter extends sfFilter
{
	public function execute($filterChain)
	{
    	// Execute this filter only once
		if ($this->isFirstCall())
		{
			$user = $this->getContext()->getUser()->updateLastActivity();
		}
 
		// Execute next filter
		$filterChain->execute();
	}
}