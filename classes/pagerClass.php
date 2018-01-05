<? 
//====================================
// Author: FSI
// Date-written = Dec 6, 2004
// Filename: pagerClass.php
// Maintains the class for paging
// Revision: v1.0
//====================================

   class Pager 
   { 
       function getPagerData($numHits, $limit, $page) 
       { 
           $numHits  = (int) $numHits; 
           $limit    = max((int) $limit, 1); 
           $page     = (int) $page; 
           $numPages = ceil($numHits / $limit); 

           $page = max($page, 1); 
           $page = min($page, $numPages); 

           $offset = ($page - 1) * $limit; 

           $ret = new stdClass; 

           $ret->offset   = $offset; 
           $ret->limit    = $limit; 
           $ret->numPages = $numPages; 
           $ret->page     = $page; 

           return $ret; 
       } 
   } 
?>  
