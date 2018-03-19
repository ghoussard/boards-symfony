<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

abstract class MainRepository extends ServiceEntityRepository{
 
	public function get($id){
		return $this->find($id);
	}
	
	public function getAll(){
		return $this->findAll();
	}
	/**
	 * Affects member to member the values of the associative array $values to the members of the object $object
	 * Used for example to retrieve the variables posted and assign them to the members of an object
	 * @param object $object
	 * @param associative array $values
	 */
	public static function setValuesToObject($object, $values=null) {
		foreach ( $values as $key => $value ) {
			$accessor="set" . ucfirst($key);
			if (method_exists($object, $accessor)) {
				$object->$accessor($value);
				$object->_rest[$key]=$value;
			}
		}
	}
	
    /**
     * Adds or Updates $object in the database
     * @param object $object
     * @return boolean
     */
    public function update($object){
    	$result=true;
    	try{
    		$this->_em->persist($object);
    		$this->_em->flush();
    	}catch (\Exception $e){
    		echo $e->getMessage();
    		$result=false;
    	}
    	return $result;
    }
    
    /**
     * Deletes object from the database 
     * @param object $object
     * @return boolean
     */
    public function delete($object){
    	$result=true;
    	try{
    		$this->_em->remove($object);
    		$this->_em->flush();
    	}catch (\Exception $e){
    		$result=false;
    	}
    	return $result;
    }
}
