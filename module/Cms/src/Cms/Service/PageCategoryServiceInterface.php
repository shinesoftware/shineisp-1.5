<?php
namespace Cms\Service;

interface PageCategoryServiceInterface
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
     * @return \Cms\Model\PageCategory
     */
    public function find($id);
    
    /**
     * Should return a single record
     *
     * @param  int $name Identifier of the Record that should be returned
     * @return \Cms\Model\PageCategory
     */
    public function findByName($name);
    
    /**
     * Should delete a single record
     *
     * @param  int $id Identifier of the Record that should be deleted
     * @return \Cms\Model\Page
     */
    public function delete($id);
    
    /**
     * Should save a single record
     *
     * @param  \Cms\Model\PageCategory $record object that should be saved
     * @return \Cms\Model\PageCategory
     */
    public function save(\Cms\Model\PageCategory $record);
}