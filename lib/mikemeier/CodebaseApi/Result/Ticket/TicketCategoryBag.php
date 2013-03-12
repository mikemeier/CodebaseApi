<?php

namespace mikemeier\CodebaseApi\Result\Ticket;

use mikemeier\CodebaseApi\Result\AbstractResult;

class TicketCategoryBag extends AbstractResult
{
    /**
     * @var TicketCategory[]
     */
    protected $categories = array();

    /**
     * @param array $json
     */
    protected function process(array $json)
    {
        foreach($json as $category){
            $category = $category['ticketing_category'];

            $this->categories[] = new TicketCategory(
                (int)$category['id'],
                $category['name']
            );
        }
    }

    /**
     * @return TicketCategory[]
     */
    public function getCategories()
    {
        return $this->categories;
    }
}