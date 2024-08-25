<?php

namespace Tests\Unit;

use App\Models\PatientDemographic;
use Mockery;
use Tests\TestCase;
use Illuminate\Http\Request;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Contracts\Debug\ExceptionHandler;
use App\Exceptions\Handler;
use Mockery\MockInterface;

class PatientDemographicControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    
    public function testIndex()
    {
        $patientDemographicMock = Mockery::mock(PatientDemographic::class);
        $patientDemographicMock->shouldReceive('all')->andReturn([]);

        $this->app->instance(PatientDemographic::class, $patientDemographicMock);

        $response = $this->get('/patient-demographics');

        $response->assertStatus(200);
        $response->assertJson([]);
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testShow()
    {
        $region = 'Conakry';

        $patientDemographicMock = Mockery::mock(PatientDemographic::class);
        $patientDemographicMock->shouldReceive('where')->with('town', $region)->andReturnSelf();
        $patientDemographicMock->shouldReceive('get')->with(['town', 'quartier'])->andReturn([]);

        $this->app->instance(PatientDemographic::class, $patientDemographicMock);

        $response = $this->get("/patient-demographics/{$region}");

        $response->assertStatus(200);
        $response->assertJson([]);
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testGetArea()
    {
        $prefecture = 'Conakry';

        $patientDemographicMock = Mockery::mock(PatientDemographic::class);
        $patientDemographicMock->shouldReceive('where')->with('town', $prefecture)->andReturnSelf();
        $patientDemographicMock->shouldReceive('distinct')->andReturnSelf();
        $patientDemographicMock->shouldReceive('get')->with(['quartier'])->andReturn([]);

        $this->app->instance(PatientDemographic::class, $patientDemographicMock);

        $response = $this->get("/location/quartiers/{$prefecture}");

        $response->assertStatus(200);
        $response->assertJson([]);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

}