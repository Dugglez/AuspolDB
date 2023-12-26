<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CandidatesElectionsStates Model
 *
 * @property \App\Model\Table\CandidatesTable&\Cake\ORM\Association\BelongsTo $Candidates
 * @property \App\Model\Table\ElectionsTable&\Cake\ORM\Association\BelongsTo $Elections
 *
 * @method \App\Model\Entity\CandidatesElectionsState newEmptyEntity()
 * @method \App\Model\Entity\CandidatesElectionsState newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\CandidatesElectionsState[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CandidatesElectionsState get($primaryKey, $options = [])
 * @method \App\Model\Entity\CandidatesElectionsState findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\CandidatesElectionsState patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CandidatesElectionsState[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CandidatesElectionsState|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CandidatesElectionsState saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CandidatesElectionsState[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CandidatesElectionsState[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\CandidatesElectionsState[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CandidatesElectionsState[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CandidatesElectionsStatesTable extends Table
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

        $this->setTable('candidates_elections_states');
        $this->setDisplayField('state');
        $this->setPrimaryKey('id');

        $this->belongsTo('Candidates', [
            'foreignKey' => 'candidate_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Elections', [
            'foreignKey' => 'election_id',
            'joinType' => 'INNER',
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
            ->integer('candidate_id')
            ->notEmptyString('candidate_id');

        $validator
            ->integer('election_id')
            ->notEmptyString('election_id');

        $validator
            ->scalar('state')
            ->requirePresence('state', 'create')
            ->notEmptyString('state');

        $validator
            ->integer('votes')
            ->allowEmptyString('votes');

        $validator
            ->decimal('swing')
            ->allowEmptyString('swing');

        $validator
            ->boolean('winner')
            ->allowEmptyString('winner');

        $validator
            ->integer('position')
            ->allowEmptyString('position');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('candidate_id', 'Candidates'), ['errorField' => 'candidate_id']);
        $rules->add($rules->existsIn('election_id', 'Elections'), ['errorField' => 'election_id']);

        return $rules;
    }
}
