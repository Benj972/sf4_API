<?php

namespace App\Repository;

use App\Entity\Product;

class ProductRepository extends AbstractRepository
{
    public function search($term, $order = 'asc', $limit = 20, $offset = 0)
    {
        $qb = $this
            ->createQueryBuilder('p')
            ->select('p')
            ->orderBy('p.name', $order)
        ;
        
        if ($term) {
            $qb
                ->where('p.name LIKE ?1')
                ->setParameter(1, '%'.$term.'%')
            ;
        }
        
        return $this->paginate($qb, $limit, $offset);
    }
}
