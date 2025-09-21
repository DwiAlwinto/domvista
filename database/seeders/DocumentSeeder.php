<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Document;

class DocumentSeeder extends Seeder
{
    public function run()
    {
        $owner = \App\Models\Resident::where('full_name', 'Erwin Wiriadi')->first();
        $leasee = \App\Models\Resident::where('full_name', 'William T')->first();
        $unit = \App\Models\Unit::where('unit_code', 'T1101')->first();

        $docs = [
            'SURAT PEMESANAN APARTEMENT',
            'FORM BERITA ACARA SERAH TERIMA',
            'KTP/PASSPORT OWNER',
            'KTP FAMILY MEMBERS',
            'FORM REGISTRATION',
            'FORM MAID & DRIVER',
            'UTILITY READING RECORD',
            'EBILLING REGISTRATION',
        ];

        foreach ($docs as $doc) {
            Document::create([
                'resident_id' => $owner->id,
                'unit_id' => $unit?->id,
                'document_type' => $doc,
                'file_path' => 'documents/sample.pdf',
                'file_name' => $doc . '.pdf',
                'mime_type' => 'application/pdf',
                'is_required' => true,
            ]);
        }

        $leaseeDocs = [
            'KTP OWNER/PENYEWA',
            'KTP FAMILY MEMBERS',
            'FORM REGISTRATION',
            'FORM MAID & DRIVER',
            'UTILITY READING RECORD',
            'EBILLING REGISTRATION',
            'LEASEE AGREEMENT',
        ];

        foreach ($leaseeDocs as $doc) {
            Document::create([
                'resident_id' => $leasee->id,
                'unit_id' => $unit?->id,
                'document_type' => $doc,
                'file_path' => 'documents/sample.pdf',
                'file_name' => $doc . '.pdf',
                'mime_type' => 'application/pdf',
                'is_required' => true,
            ]);
        }
    }
}
