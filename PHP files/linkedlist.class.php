<?php
 
 
class ListNode
{
    /* Data to hold */
    public $ip;
    public $time;
    public $snumber; 
    /* Link to next node */
    public $next;
    /* Node constructor */
    function __construct($ip, $time, $countervar)
    {
        $this->snumber = $countervar;
        $this->ip = $ip;
        $this->time = $time;
        $this->next = NULL;


    }
 
    function readNode()
    {
        return $this->ip;
    }
}
 
 
class LinkList
{
    /* Link to the first node in the list */
    private $firstNode;
 
    /* Link to the last node in the list */
    private $lastNode;
 
    /* Total nodes in the list */
    private $count;
 
    /* List constructor */
    function __construct()
    {
        $this->firstNode = NULL;
        $this->lastNode = NULL;
        $this->count = 0;

        //echo "Hello world";
    }
 
    public function isEmpty()
    {
        return ($this->firstNode == NULL);
    }
 
    public function insertFirst($ip, $time, $countervar)
    {
        $link = new ListNode($ip, $time, $countervar);
        $link->next = $this->firstNode;
        $this->firstNode = &$link;
 
        // If this is the first node inserted in the list then set the lastNode pointer to it.
        
        if($this->lastNode == NULL)
            $this->lastNode = &$link;
 
        $this->count++;
    } 
 
    public function insertLast($ip, $time, $countervar)
    {
        if($this->firstNode != NULL)
        {
            $link = new ListNode($ip, $time, $countervar);
            $this->lastNode->next = $link;
            $link->next = NULL;
            $this->lastNode = &$link;
            $this->count++;
        }
        else
        {
            $this->insertFirst($ip, $time, $countervar);
        }

        echo "Node Added in the last <br />\n";
    }
 
 /*   public function deleteFirstNode()
    {
        $temp = $this->firstNode;
        $this->firstNode = $this->firstNode->next;
        if($this->firstNode != NULL)
            $this->count--;
 
        return $temp;
    }
 
    public function deleteLastNode()
    {
        if($this->firstNode != NULL)
        {
            if($this->firstNode->next == NULL)
            {
                $this->firstNode = NULL;
                $this->count--;
            }
            else
            {
                $previousNode = $this->firstNode;
                $currentNode = $this->firstNode->next;
 
                while($currentNode->next != NULL)
                {
                    $previousNode = $currentNode;
                    $currentNode = $currentNode->next;
                }
 
                $previousNode->next = NULL;
                $this->count--;
            }
        }
    } */
 
    public function deleteNode($key)
    {
        $current = $this->firstNode;
        $previous = $this->firstNode;
 
        while($current->ip != $key)
        {
            if($current->next == NULL)
                return NULL;
            else
            {
                $previous = $current;
                $current = $current->next;
            }
        }
 
        if($current == $this->firstNode)
         {
              if($this->count == 1)
               {
                  $this->lastNode = $this->firstNode;
               }
               $this->firstNode = $this->firstNode->next;
        }
        else
        {
            if($this->lastNode == $current)
            {
                 $this->lastNode = $previous;
             }
            $previous->next = $current->next;
        }
        $this->count--;  
    }
 
    public function find($key, $d)
    {
        $current = $this->firstNode;
        while(($current->ip != $key) || ($current->time != $d))
        {
            if($current->next == NULL)
                return null;
            else
                $current = $current->next;
        }
        return $current->snumber;
    }

 
    public function totalNodes()
    {
        return $this->count;
    }
 
    public function readList()
    {
        $listData = array();
        $current = $this->firstNode;
 
        while($current != NULL)
        {
            array_push($listData, $current->readNode());
            $current = $current->next;
        }
        return $listData;
    }
    
}
 
?>