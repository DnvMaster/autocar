<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\CustomerDocument;
use Illuminate\Database\Seeder;

class CustomerDocumentSeeder extends Seeder
{
  public function run(): void
    {
        $documents = [
            [
                'email' => 'office@autotech.example',
                'type' => 'company_registration',
                'document_number' => 'HRB-45821',
                'issued_at' => '2019-03-12',
                'expires_at' => null,
            ],[
                'email' => 'contact@rheinmain-logistics.example',
                'type' => 'company_registration',
                'document_number' => 'HRB-51284',
                'issued_at' => '2020-06-18',
                'expires_at' => null,
            ],[
                'email' => 'office@frankfurt-consulting.example',
                'type' => 'company_registration',
                'document_number' => 'HRB-60317',
                'issued_at' => '2018-09-22',
                'expires_at' => null,
            ],[
                'email' => 'fleet@eurotech.example',
                'type' => 'company_registration',
                'document_number' => 'HRB-74129',
                'issued_at' => '2021-01-14',
                'expires_at' => null,
            ],[
                'email' => 'booking@gbt.example',
                'type' => 'company_registration',
                'document_number' => 'HRB-38451',
                'issued_at' => '2017-11-03',
                'expires_at' => null,
            ],[
                'email' => 'events@rhein-event.example',
                'type' => 'company_registration',
                'document_number' => 'HRB-92145',
                'issued_at' => '2022-04-27',
                'expires_at' => null,
            ],[
                'email' => 'mobility@main-finance.example',
                'type' => 'company_registration',
                'document_number' => 'HRB-28763',
                'issued_at' => '2016-08-11',
                'expires_at' => null,
            ],[
                'email' => 'office@german-trade.example',
                'type' => 'company_registration',
                'document_number' => 'HRB-56328',
                'issued_at' => '2020-02-19',
                'expires_at' => null,
            ],[
                'email' => 'admin@dce.example',
                'type' => 'company_registration',
                'document_number' => 'HRB-81247',
                'issued_at' => '2021-07-05',
                'expires_at' => null,
            ],[
                'email' => 'fleet@premium-mobility.example',
                'type' => 'company_registration',
                'document_number' => 'HRB-39472',
                'issued_at' => '2019-12-16',
                'expires_at' => null,
            ],[
                'email' => 'thomas.mueller@example',
                'type' => 'driving_license',
                'document_number' => 'F-DE-100011',
                'issued_at' => '2021-05-10',
                'expires_at' => '2036-05-10',
            ],[
                'email' => 'anna.schneider@example',
                'type' => 'driving_license',
                'document_number' => 'F-DE-100012',
                'issued_at' => '2020-08-14',
                'expires_at' => '2035-08-14',
            ],[
                'email' => 'michael.weber@example',
                'type' => 'driving_license',
                'document_number' => 'F-DE-100013',
                'issued_at' => '2019-11-20',
                'expires_at' => '2034-11-20',
            ],[
                'email' => 'laura.fischer@example',
                'type' => 'driving_license',
                'document_number' => 'F-DE-100014',
                'issued_at' => '2022-02-18',
                'expires_at' => '2037-02-18',
            ],[
                'email' => 'daniel.klein@example',
                'type' => 'driving_license',
                'document_number' => 'F-DE-100015',
                'issued_at' => '2021-09-07',
                'expires_at' => '2036-09-07',
            ],
        ];
        foreach ($documents as $document) {
            $customer = Customer::where('email', $document['email'])->first();
            if(!$customer) {
                continue;
            }
            CustomerDocument::updateOrCreate(
                [
                    'customer_id' => $customer->id,
                    'document_number' => $document['document_number'],
                ],
                [
                    'type' => $document['type'],
                    'issued_at' => $document['issued_at'],
                    'expires_at' => $document['expires_at'],
                ]
            );
        }
    }
}
