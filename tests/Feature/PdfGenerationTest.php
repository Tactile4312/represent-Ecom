<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade as PDF;

class PdfGenerationTest extends TestCase
{
    /** @test */
    public function it_generates_hello_world_pdf()
    {
        // Create a temporary disk for testing
        Storage::fake('local');

        // Perform the request to generate the PDF
        $response = $this->get(route('test.pdf'));

        // Check the response
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');

        // Save the PDF to a temporary file
        $filePath = storage_path('app/test-hello-world.pdf');
        file_put_contents($filePath, $response->getContent());

        // Assert that the file exists
        $this->assertFileExists($filePath);

        // Optional: Check the content of the PDF
        // Note: You will need a PDF parser library to check the content
        // For example, using `smalot/pdfparser` library:
        // composer require smalot/pdfparser

        $parser = new \Smalot\PdfParser\Parser();
        $pdf = $parser->parseFile($filePath);
        $text = $pdf->getText();
        $this->assertStringContainsString('Hello, World!', $text);

        // Clean up: Delete the temporary file
        //unlink($filePath);
    }
}
