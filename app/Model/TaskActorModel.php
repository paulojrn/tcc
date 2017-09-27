<?php

namespace Kanboard\Model;

use Kanboard\Core\Base;

/**
 * Class TaskActorModel
 *
 * @package Kanboard\Model
 * @author  Paulo
 */
class TaskActorModel extends Base
{
    /**
     * SQL table name
     *
     * @var string
     */
    const TABLE = 'task_has_actors';
    
    /**
     * Get all actors not available in a project
     *
     * @access public
     * @param  integer $actor_id
     * @param  integer $project_id
     * @return array
     */
    public function getActorIdsByTaskNotAvailableInProject($actor_id, $project_id)
    {
        return $this->db->table(ActorModel::TABLE)
        ->eq(self::TABLE.'.task_id', $task_id)
        ->notIn(ActorModel::TABLE.'.project_id', array(0, $project_id))
        ->join(self::TABLE, 'actor_id', 'id')
        ->findAllByColumn(ActorModel::TABLE.'.id');
    }
    
    /**
     * Get all actors associated to a task
     *
     * @access public
     * @param  integer $actor_id
     * @return array
     */
    public function getActorsByTask($task_id)
    {
        return $this->db->table(ActorModel::TABLE)
        ->columns(ActorModel::TABLE.'.id', ActorModel::TABLE.'.name')
        ->eq(self::TABLE.'.task_id', $task_id)
        ->join(self::TABLE, 'actor_id', 'id')
        ->findAll();
    }
    
    /**
     * Get all actors associated to a list of tasks
     *
     * @access public
     * @param  integer[] $task_ids
     * @return array
     */
    public function getActorsByTaskIds($task_ids)
    {
        if (empty($task_ids)) {
            return array();
        }
        
        $actors = $this->db->table(ActorModel::TABLE)
        ->columns(ActorModel::TABLE.'.id', ActorModel::TABLE.'.name', self::TABLE.'.task_id')
        ->in(self::TABLE.'.task_id', $task_ids)
        ->join(self::TABLE, 'actor_id', 'id')
        ->asc(ActorModel::TABLE.'.name')
        ->findAll();
        
        return array_column_index($actors, 'task_id');
    }
    
    /**
     * Get dictionary of actor
     *
     * @access public
     * @param  integer $task_id
     * @return array
     */
    public function getList($task_id)
    {
        $actors = $this->getActorsByTask($task_id);
        return array_column($actors, 'name', 'id');
    }
    
    /**
     * Add or update a list of actors to a task
     *
     * @access public
     * @param  integer  $project_id
     * @param  integer  $actor_id
     * @param  string[] $actors
     * @return boolean
     */
    public function save($project_id, $task_id, array $actors)
    {
        $task_actors = $this->getList($task_id);
        $actors = array_filter($actors);
        
        return $this->associateActors($project_id, $task_id, $task_actors, $actors) &&
        $this->dissociateActors($task_id, $task_actors, $actors);
    }
    
    /**
     * Associate a actor to a task
     *
     * @access public
     * @param  integer  $task_id
     * @param  integer  $actor_id
     * @return boolean
     */
    public function associateActor($task_id, $actor_id)
    {
        return $this->db->table(self::TABLE)->insert(array(
            'task_id' => $task_id,
            'actor_id' => $actor_id,
        ));
    }
    
    /**
     * Dissociate a actor from a task
     *
     * @access public
     * @param  integer  $task_id
     * @param  integer  $actor_id
     * @return boolean
     */
    public function dissociateActor($task_id, $actor_id)
    {
        return $this->db->table(self::TABLE)
        ->eq('task_id', $task_id)
        ->eq('actor_id', $actor_id)
        ->remove();
    }
    
    /**
     * Associate missing actors
     *
     * @access protected
     * @param  integer  $project_id
     * @param  integer  $task_id
     * @param  array    $task_actors
     * @param  string[] $actors
     * @return bool
     */
    protected function associateActors($project_id, $task_id, $task_actors, $actors)
    {
        foreach ($actors as $actor) {
            $actor_id = $this->actorModel->findOrCreateActor($project_id, $actor);
            
            if (! isset($task_actors[$actor_id]) && ! $this->associateActor($task_id, $actor_id)) {
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * Dissociate removed actors
     *
     * @access protected
     * @param  integer  $task_id
     * @param  array    $task_actors
     * @param  string[] $actors
     * @return bool
     */
    protected function dissociateActors($task_id, $task_actors, $actors)
    {
        foreach ($task_actors as $actor_id => $actor) {
            if (! in_array($actor, $actors)) {
                if (! $this->dissociateActor($task_id, $actor_id)) {
                    return false;
                }
            }
        }
        
        return true;
    }
}
