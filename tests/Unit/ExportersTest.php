<?php

namespace Tests\Unit;

use App\Exporters\Pdf;
use App\Exporters\Csv;
use App\Exporters\Word;
use App\Models\Resource;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExportersTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    public function testPdfExport()
    {
        $resource = Resource::factory()->create(['content' => 'PDF content', 'name' => 'test_pdf']);
        $exporter = new Pdf($resource);
        $response = $exporter->download();

        $this->assertEquals(200, $response->status());
        $this->assertEquals('application/pdf', $response->headers->get('Content-Type'));
        $this->assertEquals('attachment; filename="test_pdf.pdf"', $response->headers->get('Content-Disposition'));
    }

    public function testCsvExport()
    {
        $resource = Resource::factory()->create(['content' => 'CSV content', 'name' => 'test_csv']);
        $exporter = new Csv($resource);
        $response = $exporter->download();

        $this->assertEquals(200, $response->status());
        $this->assertEquals('text/csv', $response->headers->get('Content-Type'));
        $this->assertEquals('attachment; filename="test_csv.csv"', $response->headers->get('Content-Disposition'));
    }

    public function testWordExport()
    {
        $resource = Resource::factory()->create(['content' => 'Word content', 'name' => 'test_word']);
        $exporter = new Word($resource);
        $response = $exporter->download();

        $this->assertEquals(200, $response->status());
        $this->assertEquals('application/vnd.ms-word', $response->headers->get('Content-Type'));
        $this->assertEquals('attachment; filename="test_word.doc"', $response->headers->get('Content-Disposition'));
    }
}
