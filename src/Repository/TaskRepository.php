<?php
/**
 * Created by PhpStorm.
 * User: houss
 * Date: 23/03/2018
 * Time: 18:35
 */

namespace App\Repository;


use App\Entity\Task;
use Doctrine\Common\Persistence\ManagerRegistry;

class TaskRepository extends MainRepository {

	public function __construct( ManagerRegistry $registry) {
		parent::__construct( $registry, Task::class );
	}

}