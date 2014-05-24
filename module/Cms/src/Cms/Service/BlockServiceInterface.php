<?php
namespace Cms\Service;

interface BlockServiceInterface
{
    /**
     * Should return all the records 
     *
     * @return array|\Traversable
     */
    public function findAll();

    /**
     * Should return a single record
     *
     * @param  int $id Identifier of the Record that should be returned
     * @return \Cms\Entity\Block
     */
    public function find($id);
    
    /**
     * Should return a single record
     *
     * @param  string $var Identifier of the Record that should be returned
     * @return \Cms\Entity\Block
     */
    public function findByPlaceholder($var);
    
    /**
     * Should delete a single record
     *
     * @param  int $id Identifier of the Record that should be deleted
     * @return \Cms\Entity\Block
     */
    public function delete($id);
    
    /**
     * Should save a single record
     *
     * @param  \Cms\Model\Block $record object that should be saved
     * @return \Cms\Entity\Block
     */
    public function save(\Cms\Entity\Block $record);
}