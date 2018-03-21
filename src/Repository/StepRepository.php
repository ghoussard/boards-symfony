<?php

namespace App\Repository;

use App\Entity\Step;
use Doctrine\Common\Persistence\ManagerRegistry;

class StepRepository extends MainRepository {

	public function __construct( ManagerRegistry $registry) {
		parent::__construct( $registry, Step::class);
	}

}