<?php

namespace Tests\Feature;

use App\Person;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PersonTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_will_show_all_persons()
    {
        $persons = factory(Person::class, 10)->create();

        $response = $this->get(route('persons.index'));

        $response->assertStatus(200);

        $response->assertJson($persons->toArray());
    }

    /** @test */
    public function it_will_get_persons_type()
    {
        $persons = factory(Person::class, 10)->create();
    }

    /** @test */
    public function it_will_create_persons()
    {
        $response = $this->post(route('persons.store'), [
            'firstName' => 'John',
            'middleName' => 'Kamau',            
            'lastName' => 'Mwangi',
            'dob' => '2019-01-01',
            'sex' => 'm',
            'registrationDate' => '2019-01-01',
            'user_id' => 67737
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('people', [
            'firstName' => 'John'
        ]);

        $response->assertJsonStructure([
            'message',
            'person' => [
                'firstName',
                'middleName',    
                'lastName',
                'dob',
                'sex',
                'registrationDate',
                'user_id',
                'updated_at',
                'created_at',
                'id'
            ]
        ]);
    }

    /** @test */
    public function it_will_show_a_person()
    {
        $this->post(route('persons.store'), [
            'firstName' => 'John',
            'middleName' => 'Kamau',            
            'lastName' => 'Mwangi',
            'dob' => '2019-01-01',
            'sex' => 'm',
            'registrationDate' => '2019-01-01',
            'user_id' => 67737
        ]);

        $person = Person::all()->first();

        $response = $this->get(route('persons.show', $person->id));

        $response->assertStatus(200);

        $response->assertJson($person->toArray());
    }

    /** @test */
    public function it_will_update_a_person()
    {
        $this->post(route('persons.store'), [
            'firstName' => 'John',
            'middleName' => 'Kamau',            
            'lastName' => 'Mwangi',
            'dob' => '2019-01-01',
            'sex' => 'm',
            'registrationDate' => '2019-01-01',
            'user_id' => 67737
        ]);

        $person = Person::all()->first();

        $response = $this->put(route('persons.update', $person->id), [
            'firstName' => 'Mary'
        ]);

        $response->assertStatus(200);

        $person = $person->fresh();

        $this->assertEquals($person->firstName, 'Mary');

        $response->assertJsonStructure([
           'message',
           'person' => [
                'firstName',
                'middleName',    
                'lastName',
                'dob',
                'sex',
                'registrationDate',
                'user_id',
                'updated_at',
                'created_at',
                'id'
           ]
       ]);
    }

    /** @test */
    /*public function it_will_delete_a_person()
    {
        $this->post(route('persons.store'), [
            'firstName' => 'John',
            'middleName' => 'Kamau',            
            'lastName' => 'Mwangi',
            'dob' => '2019-01-01',
            'sex' => 'm',
            'registrationDate' => '2019-01-01',
            'user_id' => 66774
        ]);

        $person = Person::all()->first();

        $response = $this->delete(route('persons.destroy', $person->id));

        $person = $person->fresh();

        $this->assertNull($person);

        $response->assertJsonStructure([
            'message'
        ]);
    }*/
}
