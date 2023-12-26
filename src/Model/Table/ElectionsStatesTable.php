<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ElectionsStates Model
 *
 * @property \App\Model\Table\CandidatesTable&\Cake\ORM\Association\BelongsToMany $Candidates
 *
 * @method \App\Model\Entity\ElectionsState newEmptyEntity()
 * @method \App\Model\Entity\ElectionsState newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ElectionsState[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ElectionsState get($primaryKey, $options = [])
 * @method \App\Model\Entity\ElectionsState findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ElectionsState patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ElectionsState[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ElectionsState|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ElectionsState saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ElectionsState[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ElectionsState[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ElectionsState[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ElectionsState[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ElectionsStatesTable extends Table
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

        $this->setTable('elections_states');
        $this->setDisplayField('state');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Candidates', [
            'foreignKey' => 'elections_state_id',
            'targetForeignKey' => 'candidate_id',
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
            ->scalar('state')
            ->requirePresence('state', 'create')
            ->notEmptyString('state');

        $validator
            ->scalar('composition')
            ->allowEmptyString('composition');

        $validator
            ->integer('formal_votes')
            ->allowEmptyString('formal_votes');

        $validator
            ->integer('informal_votes')
            ->allowEmptyString('informal_votes');

        $validator
            ->integer('turnout')
            ->allowEmptyString('turnout');

        return $validator;
    }
}
