<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CandidatesPartiesElections Model
 *
 * @property \App\Model\Table\CandidatesTable&\Cake\ORM\Association\BelongsTo $Candidates
 * @property \App\Model\Table\PartiesTable&\Cake\ORM\Association\BelongsTo $Parties
 * @property \App\Model\Table\ElectionsTable&\Cake\ORM\Association\BelongsTo $Elections
 *
 * @method \App\Model\Entity\CandidatesPartiesElection newEmptyEntity()
 * @method \App\Model\Entity\CandidatesPartiesElection newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\CandidatesPartiesElection[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CandidatesPartiesElection get($primaryKey, $options = [])
 * @method \App\Model\Entity\CandidatesPartiesElection findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\CandidatesPartiesElection patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CandidatesPartiesElection[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CandidatesPartiesElection|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CandidatesPartiesElection saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CandidatesPartiesElection[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CandidatesPartiesElection[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\CandidatesPartiesElection[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CandidatesPartiesElection[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CandidatesPartiesElectionsTable extends Table
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

        $this->setTable('candidates_parties_elections');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Candidates', [
            'foreignKey' => 'candidate_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Parties', [
            'foreignKey' => 'party_id',
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
            ->integer('party_id')
            ->notEmptyString('party_id');

        $validator
            ->integer('election_id')
            ->notEmptyString('election_id');

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
        $rules->add($rules->existsIn('party_id', 'Parties'), ['errorField' => 'party_id']);
        $rules->add($rules->existsIn('election_id', 'Elections'), ['errorField' => 'election_id']);

        return $rules;
    }
}
