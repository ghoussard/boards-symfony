<?php
/**
 * Created by PhpStorm.
 * User: houss
 * Date: 23/03/2018
 * Time: 20:25
 */

namespace App\Repository;


use App\Entity\Story;
use Symfony\Bridge\Doctrine\RegistryInterface;

class StoryRepository extends MainRepository {

	public function __construct(RegistryInterface $registry) {
		parent::__construct($registry, Story::class);
	}

}