<?php

namespace Kanboard\Model;

use Kanboard\Core\Base;

/**
 * Class ActorModel
 *
 * @package Kanboard\Model
 * @author  Paulo
 */
class ActorModel extends Base
{
    /**
     * SQL table name
     *
     * @var string
     */
    const TABLE = 'actors';
    
    /**
     * Get all actors
     *
     * @access public
     * @return array
     */
    public function getAll()
    {
        return $this->db->table(self::TABLE)->asc('name')->findAll();
    }
    
    /**
     * Get all actors by project
     *
     * @access public
     * @param  integer $project_id
     * @return array
     */
    public function getAllByProject($project_id)
    {
        return $this->db->table(self::TABLE)->eq('project_id', $project_id)->asc('name')->findAll();
    }
    
    /**
     * Get assignable actors for a project
     *
     * @access public
     * @param  integer $project_id
     * @return array
     */
    public function getAssignableList($project_id)
    {
        return $this->db->hashtable(self::TABLE)
        ->beginOr()
        ->eq('project_id', $project_id)
        ->eq('project_id', 0)
        ->closeOr()
        ->asc('name')
        ->getAll('id', 'name');
    }
    
    /**
     * Get one actor
     *
     * @access public
     * @param  integer $actor_id
     * @return array|null
     */
    public function getById($actor_id)
    {
        return $this->db->table(self::TABLE)->eq('id', $actor_id)->findOne();
    }
    
    /**
     * Get ator id from tag name
     *
     * @access public
     * @param  int    $project_id
     * @param  string $actor
     * @return integer
     */
    public function getIdByName($project_id, $actor)
    {
        return $this->db
        ->table(self::TABLE)
        ->beginOr()
        ->eq('project_id', 0)
        ->eq('project_id', $project_id)
        ->closeOr()
        ->ilike('name', $actor)
        ->asc('project_id')
        ->findOneColumn('id');
    }
    
    /**
     * Return true if the actor exists
     *
     * @access public
     * @param  integer $project_id
     * @param  string  $actor
     * @param  integer $actor_id
     * @return boolean
     */
    public function exists($project_id, $actor, $actor_id = 0)
    {
        return $this->db
        ->table(self::TABLE)
        ->neq('id', $actor_id)
        ->beginOr()
        ->eq('project_id', 0)
        ->eq('project_id', $project_id)
        ->closeOr()
        ->ilike('name', $actor)
        ->asc('project_id')
        ->exists();
    }
    
    /**
     * Return actor id and create a new actor if necessary
     *
     * @access public
     * @param  int    $project_id
     * @param  string $actor
     * @return bool|int
     */
    public function findOrCreateTag($project_id, $actor)
    {
        $actor_id = $this->getIdByName($project_id, $actor);
        
        if (empty($actor_id)) {
            $tag_id = $this->create($project_id, $actor);
        }
        
        return $actor_id;
    }
    
    /**
     * Add a new actor
     *
     * @access public
     * @param  int    $project_id
     * @param  string $tag
     * @return bool|int
     */
    public function create($project_id, $actor)
    {
        return $this->db->table(self::TABLE)->persist(array(
            'project_id' => $project_id,
            'name' => $actor,
        ));
    }
    
    /**
     * Update a tag
     *
     * @access public
     * @param  integer $tag_id
     * @param  string  $tag
     * @return bool
     */
    public function update($actor_id, $actor)
    {
        return $this->db->table(self::TABLE)->eq('id', $actor_id)->update(array(
            'name' => $actor,
        ));
    }
    
    /**
     * Remove a actor
     *
     * @access public
     * @param  integer $tag_id
     * @return bool
     */
    public function remove($actor_id)
    {
        return $this->db->table(self::TABLE)->eq('id', $actor_id)->remove();
    }
}
