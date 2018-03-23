<?php
/**
 * Created by PhpStorm.
 * User: houss
 * Date: 23/03/2018
 * Time: 20:25
 */

namespace App\Repository;


use App\Entity\Story;
use Doctrine\Common\Persistence\ManagerRegistry;

class StoryRepository extends MainRepository {

	public function __construct(ManagerRegistry $registry) {
		parent::__construct($registry, Story::class);
	}

}