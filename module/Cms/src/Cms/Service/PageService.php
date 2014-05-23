<?php
namespace Cms\Service;

use Cms\Model\Page;

class PageService implements PageServiceInterface
{
    /**
     * @inheritDoc
     */
    public function findAll()
    {
    	$records = new Page();
    }

    /**
     * @inheritDoc
     */
    public function find($id)
    {
    }

    /**
     * @inheritDoc
     */
    public function findByUri($slug)
    {
    }

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
    }

    /**
     * @inheritDoc
     */
    public function save(\Cms\Model\Page $record)
    {
    }
}