<?php
namespace PhpCommonUtil\Collection;

class PriorityFifoDataCollection
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
    
        $priorityArray = array_reverse($priorityArray);
        foreach ($priorityArray as $buttons){
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