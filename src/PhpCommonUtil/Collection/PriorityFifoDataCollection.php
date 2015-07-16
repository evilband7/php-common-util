<?php
namespace PhpCommonUtil\Collection;


/**
 * store data as a key=>value pair
 * but looping on priority and first in first out.
 */
class PriorityFifoDataCollection implements \IteratorAggregate
{
    
    /**
     * if false, delete existing one then add a new one
     * otherwise update data on a current one
     * @var unknown
     */
    private $updateExistingOnPut = false;
    
    private $datas = array();
    
    /**
     * @param integer $id
     * @return integer|NULL
    */
    public function getPriority($id){
        foreach ($this->datas as $dataInfo){
            if($dataInfo['id'] === $id){
                return $dataInfo['priority'];
            }
        }
        return null;
    }
    
    /**
     * 
     * @param unknown $id
     */
    public function has($id){
        foreach ($this->datas as $dataInfo){
            if($dataInfo['id'] === $id){
                return true;
            }
        }
        return false;
    }
    
    /**
     * @param integer $id
     * @return mixed|NULL
     */
    public function get($id) {
        foreach ($this->datas as $dataInfo){
            if($dataInfo['id'] === $id){
                return $dataInfo['wrappedData'];
            }
        }
        return null;
    }
    
    public function put($id, $data, $priority = 1){
    
        foreach ($this->datas as $key=>$dataInfo){
            if($dataInfo['id'] === $id){
                unset($this->datas[$key]);
                $this->datas = array_values($this->datas);
                break;
            }
        }
    
        $this->datas[] = array(
            'id' => $id,
            'priority' => intval($priority),
            'wrappedData' => $data,
        );
    }
    
    /**
     * return original key=>value data (ignoring priority)
     * @return array()
     */
    public function getKeyValueMap(){
        
        $resultArray = array();
        foreach ($this->datas as $dataInfo){
            $id = $dataInfo['id'];
            $wrappedData = $dataInfo['wrappedData'];
            $resultArray[$id] = $wrappedData;
        }
        return $resultArray;
    }
    
    public function getIterator(){
    
        $priorityArray = array();
        $resultArray = array();
    
        foreach ($this->datas as $dataInfo){
            $priority = $dataInfo['priority'];
            $wrappedData = $dataInfo['wrappedData'];
    
            if( !array_key_exists($priority, $priorityArray)){
                $priorityArray[$priority] = array();
            }
            $priorityArray[$priority][] = $wrappedData;
        }
    
        ksort($priorityArray);
        foreach (array_reverse($priorityArray) as $buttons){
            foreach ($buttons as $data){
                $resultArray[] = $data;
            }
        }
        return new \ArrayObject($resultArray);
    }
    

    /**
     * @param boolean $updateExistingOnPut
     */
    public function setUpdateExistingOnPut($updateExistingOnPut)
    {
        $this->updateExistingOnPut = $updateExistingOnPut;
    }

    
    
}

?>