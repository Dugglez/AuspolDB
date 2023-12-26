<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Candidates Model
 *
 * @property \App\Model\Table\CandidatesPartiesElectionsTable&\Cake\ORM\Association\HasMany $CandidatesPartiesElections
 * @property \App\Model\Table\ElectionsElectoratesTable&\Cake\ORM\Association\BelongsToMany $ElectionsElectorates
 * @property \App\Model\Table\ElectionsStatesTable&\Cake\ORM\Association\BelongsToMany $ElectionsStates
 *
 * @method \App\Model\Entity\Candidate newEmptyEntity()
 * @method \App\Model\Entity\Candidate newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Candidate[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Candidate get($primaryKey, $options = [])
 * @method \App\Model\Entity\Candidate findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Candidate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Candidate[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Candidate|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Candidate saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Candidate[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Candidate[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Candidate[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Candidate[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CandidatesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('candidates');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('CandidatesPartiesElections', [
            'foreignKey' => 'candidate_id',
        ]);
        $this->belongsToMany('ElectionsElectorates', [
            'foreignKey' => 'candidate_id',
            'targetForeignKey' => 'id',
            'joinTable' => 'candidates_elections_electorates',
        ]);
        $this->belongsToMany('ElectionsStates', [
            'foreignKey' => 'candidate_id',
            'targetForeignKey' => 'id',
            'joinTable' => 'candidates_elections_states',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        return $validator;
    }
}
