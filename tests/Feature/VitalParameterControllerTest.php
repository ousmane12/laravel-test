<?php

namespace Tests\Feature;

use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class VitalParameterControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    #[Test]
    public function it_returns_all_vital_parameters()
    {
        $vitalParameters = [
            ['id' => 1, 'name' => 'Parameter 1'],
            ['id' => 2, 'name' => 'Parameter 2'],
            ['id' => 3, 'name' => 'Parameter 3'],
        ];
        
        $vitalParameterMock = Mockery::mock('overload:App\Models\VitalParameter');
        $vitalParameterMock->shouldReceive('all')->once()->andReturn($vitalParameters);

        $response = $this->get('/vital-parameters');

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJson($vitalParameters);
    }

    #[Test]
    public function it_returns_a_specific_vital_parameter()
    {
        $vitalParameter = ['id' => 1, 'name' => 'Parameter 1'];
        
        $vitalParameterMock = Mockery::mock('overload:App\Models\VitalParameter');
        $vitalParameterMock->shouldReceive('findOrFail')->with(1)->once()->andReturn($vitalParameter);

        $response = $this->get('/vital-parameters/1');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson($vitalParameter);
    }

    #[Test]
    public function it_returns_404_if_vital_parameter_not_found()
    {
        $vitalParameterMock = Mockery::mock('overload:App\Models\VitalParameter');
        $vitalParameterMock->shouldReceive('findOrFail')->with(999)->once()->andThrow(new \Illuminate\Database\Eloquent\ModelNotFoundException());

        $response = $this->get('/vital-parameters/999');

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
