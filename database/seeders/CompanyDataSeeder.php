<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding Companies and Related Data...');

        // Seed companies
        $this->seedCompanies();
        
        // Seed employees
        $this->seedEmployees();
        
        // Seed civil defense licenses
        $this->seedCivilDefenseLicenses();
        
        // Seed municipality licenses
        $this->seedMunicipalityLicenses();
        
        // Seed branch commercial registrations
        $this->seedBranchCommercialRegistrations();

        $this->command->info('Companies and Related Data seeded successfully!');
    }

    private function seedCompanies()
    {
        $companies = [
            [
                'id' => 1, 'company_name_ar' => 'Coleman and Weeks Co', 'company_name_en' => 'Mccall Clarke LLC',
                'cr_number' => '711', 'establishment_number' => null, 'license_number' => null, 'tax_number' => '221',
                'company_type' => 'Sole Proprietorship', 'isic_code' => 'Eius aut cum soluta',
                'phone' => '+1 (724) 615-4806', 'email' => 'lypidypy@mailinator.com', 'website' => 'https://www.robygyx.me.uk',
                'region' => 'Najran', 'city' => 'Et maxime deserunt b', 'district' => 'Eiusmod quas illo as',
                'street' => 'Nam deserunt dolor n', 'building_number' => '787', 'postal_code' => 'Cum ea est ipsam fac',
                'additional_location' => 'Facere eius eveniet', 'owner_name' => 'Aretha Bradshaw', 'owner_id_number' => '369',
                'owner_nationality' => 'Voluptatem nulla et', 'legal_status' => 'Under Formation',
                'establishment_date' => '1979-10-11', 'capital_amount' => 90.00, 'status' => 'active',
                'created_at' => '2025-08-29 17:21:01', 'updated_at' => '2025-08-29 17:21:01'
            ],
            [
                'id' => 2, 'company_name_ar' => 'Ross Waters Inc', 'company_name_en' => 'Hubbard Dotson Plc',
                'cr_number' => '369', 'establishment_number' => null, 'license_number' => null, 'tax_number' => '59',
                'company_type' => 'LLC', 'isic_code' => 'Consequatur nulla eu',
                'phone' => '+1 (319) 471-9392', 'email' => 'xoboboz@mailinator.com', 'website' => 'https://www.vyfyditydamad.ca',
                'region' => 'Tabuk', 'city' => 'Vel illum accusanti', 'district' => 'Modi et omnis volupt',
                'street' => 'Exercitation qui lab', 'building_number' => '403', 'postal_code' => 'Fuga Culpa ipsa e',
                'additional_location' => 'Obcaecati sint nemo', 'owner_name' => 'Kenneth Hatfield', 'owner_id_number' => '82',
                'owner_nationality' => 'Rerum adipisicing ac', 'legal_status' => 'Under Formation',
                'establishment_date' => '2011-02-16', 'capital_amount' => 30.00, 'status' => 'inactive',
                'created_at' => '2025-08-29 17:33:13', 'updated_at' => '2025-08-30 01:54:43'
            ],
            [
                'id' => 3, 'company_name_ar' => 'Alvarez Bush Trading', 'company_name_en' => 'Tanner and Knapp Traders',
                'cr_number' => '236', 'establishment_number' => null, 'license_number' => null, 'tax_number' => '452',
                'company_type' => 'Sole Proprietorship', 'isic_code' => 'Est autem ea in eius',
                'phone' => '+1 (689) 362-3113', 'email' => 'wohisyr@mailinator.com', 'website' => 'https://www.qecydaratawaf.org',
                'region' => 'Najran', 'city' => 'Dolor aut sint ab re', 'district' => 'Nulla rem ut ad in i',
                'street' => 'Voluptatem atque be', 'building_number' => '549', 'postal_code' => 'Vel pariatur Quia q',
                'additional_location' => 'Ex in expedita illo', 'owner_name' => 'Kelly Soto', 'owner_id_number' => '398',
                'owner_nationality' => 'Omnis voluptates qui', 'legal_status' => 'Suspended',
                'establishment_date' => '1972-08-18', 'capital_amount' => 56.00, 'status' => 'active',
                'created_at' => '2025-08-30 08:57:25', 'updated_at' => '2025-08-30 08:57:25'
            ],
            [
                'id' => 4, 'company_name_ar' => 'Carney and Hurst Inc', 'company_name_en' => 'Rojas Bean Trading',
                'cr_number' => '194', 'establishment_number' => null, 'license_number' => null, 'tax_number' => '18',
                'company_type' => 'Sole Proprietorship', 'isic_code' => 'Magni magnam libero',
                'phone' => '+1 (393) 167-4845', 'email' => 'myqyvoc@mailinator.com', 'website' => 'https://www.bitydozajyximy.me',
                'region' => 'Najran', 'city' => 'Dolores cupiditate c', 'district' => 'Rem deserunt volupta',
                'street' => 'Voluptatibus sed est', 'building_number' => '709', 'postal_code' => 'Ex laboriosam ipsam',
                'additional_location' => 'Incididunt illum mo', 'owner_name' => 'Lavinia Nash', 'owner_id_number' => '736',
                'owner_nationality' => 'Repudiandae cupidita', 'legal_status' => 'Suspended',
                'establishment_date' => '2001-08-07', 'capital_amount' => 63.00, 'status' => 'active',
                'created_at' => '2025-08-30 11:24:15', 'updated_at' => '2025-08-30 11:24:15'
            ],
            [
                'id' => 5, 'company_name_ar' => 'Batz Group', 'company_name_en' => 'Lowe Ltd',
                'cr_number' => '9076080004', 'establishment_number' => '05933155', 'license_number' => '75843088', 'tax_number' => '2536449885',
                'company_type' => 'Partnership', 'isic_code' => '7217',
                'phone' => '352.913.4317', 'email' => 'klein.dawn@bogan.info', 'website' => null,
                'region' => 'Blickburgh', 'city' => 'West Damianberg', 'district' => 'Sincere Bypass',
                'street' => '2518 Nola Corner Apt. 925', 'building_number' => '853', 'postal_code' => '03543',
                'additional_location' => "40346 Mosciski Trafficway Apt. 564\nSouth Bonnie, MT 68781", 'owner_name' => 'Miss Aubrey Kilback PhD', 'owner_id_number' => '3016971156',
                'owner_nationality' => 'Kazakhstan', 'legal_status' => 'Active',
                'establishment_date' => '2021-09-24', 'capital_amount' => 286044.23, 'status' => 'active',
                'created_at' => '2025-09-07 11:53:32', 'updated_at' => '2025-09-07 11:53:32'
            ],
            [
                'id' => 6, 'company_name_ar' => 'Herman and Sons', 'company_name_en' => 'Fadel-Heaney',
                'cr_number' => '5097659668', 'establishment_number' => '59525222', 'license_number' => '64826625', 'tax_number' => '2501597727',
                'company_type' => 'LLC', 'isic_code' => '1268',
                'phone' => '+1-947-570-9019', 'email' => 'yschiller@boyer.biz', 'website' => null,
                'region' => 'New Federicoland', 'city' => 'North Urban', 'district' => 'Ortiz Street',
                'street' => '4476 Gaylord Lodge Apt. 340', 'building_number' => '2780', 'postal_code' => '39862-2589',
                'additional_location' => "4402 Jameson Plains Apt. 972\nWest Stacey, IA 14332-6058", 'owner_name' => 'Elinor Littel', 'owner_id_number' => '1427231443',
                'owner_nationality' => 'Burundi', 'legal_status' => 'Suspended',
                'establishment_date' => '2020-05-14', 'capital_amount' => 156898.05, 'status' => 'active',
                'created_at' => '2025-09-07 11:53:33', 'updated_at' => '2025-09-07 11:53:33'
            ],
            [
                'id' => 7, 'company_name_ar' => 'Graham, Ebert and Littel', 'company_name_en' => 'Dickinson, Emmerich and Daniel',
                'cr_number' => '9331674778', 'establishment_number' => '48834175', 'license_number' => '86431898', 'tax_number' => '5866844434',
                'company_type' => 'Corporation', 'isic_code' => '7080',
                'phone' => '+1 (562) 322-7044', 'email' => 'ltromp@lesch.com', 'website' => null,
                'region' => 'Port Howellberg', 'city' => 'East Macey', 'district' => 'Zieme Viaduct',
                'street' => '49470 Carter Route Apt. 300', 'building_number' => '64664', 'postal_code' => '77775',
                'additional_location' => null, 'owner_name' => 'Bud Moen', 'owner_id_number' => '3206995529',
                'owner_nationality' => 'Algeria', 'legal_status' => 'Suspended',
                'establishment_date' => '2017-06-14', 'capital_amount' => 273363.28, 'status' => 'active',
                'created_at' => '2025-09-07 11:53:35', 'updated_at' => '2025-09-07 11:53:35'
            ],
        ];

        foreach ($companies as $company) {
            DB::table('companies')->updateOrInsert(
                ['id' => $company['id']],
                $company
            );
        }
    }

    private function seedEmployees()
    {
        $employees = [
            [
                'id' => 1, 'company_id' => 2, 'full_name_ar' => 'Laura Skinner', 'full_name_en' => 'Yetta Lyons',
                'type' => 'saudi', 'nationality' => 'Atque dolore elit h', 'dob_hijri' => null, 'dob_greg' => '2008-03-18',
                'pob' => 'Reprehenderit deseru', 'gender' => 'male', 'marital_status' => 'divorced', 'religion' => null,
                'education' => null, 'specialization' => null, 'national_id' => '12431243', 'national_id_issue_date' => '2025-08-30',
                'national_id_expiry_date' => '2025-09-13', 'national_id_issue_place' => '12341234', 'iqama_number' => null,
                'iqama_issue_date' => null, 'iqama_expiry_date' => null, 'border_number' => null, 'passport_number' => null,
                'passport_issue_date' => null, 'passport_expiry_date' => null, 'passport_issue_place' => null,
                'primary_mobile' => 'Commodo pariatur Ma', 'secondary_mobile' => 'Commodo pariatur Ma', 'email' => 'migely@mailinator.com',
                'region' => 'Nulla aliquid est d', 'city' => 'Dolores ipsum alias', 'district' => 'Aliquam est eu adipi',
                'street' => 'Dolores quos id sae', 'building_number' => '152', 'postal_code' => 'Deserunt porro nihil',
                'pobox' => 'P.O. Box 32445', 'job_title' => 'Eius nihil mollit ut', 'hire_date' => '2007-08-27',
                'contract_type' => 'temporary', 'basic_salary' => 25.00, 'allowances' => 51.00, 'gosi_number' => '399',
                'medical_insurance_number' => '458', 'saned_number' => '634', 'status' => 'active',
                'created_at' => '2025-08-30 05:06:06', 'updated_at' => '2025-09-05 20:13:44'
            ],
            [
                'id' => 2, 'company_id' => 3, 'full_name_ar' => 'Aladdin Bell', 'full_name_en' => 'Craig Sullivan',
                'type' => 'expat', 'nationality' => 'Beatae obcaecati vol', 'dob_hijri' => null, 'dob_greg' => '1979-01-20',
                'pob' => 'Cum ut vitae facilis', 'gender' => 'male', 'marital_status' => 'married', 'religion' => null,
                'education' => null, 'specialization' => null, 'national_id' => null, 'national_id_issue_date' => null,
                'national_id_expiry_date' => null, 'national_id_issue_place' => null, 'iqama_number' => 'xavasdsv',
                'iqama_issue_date' => '2025-08-30', 'iqama_expiry_date' => '2025-08-31', 'border_number' => 'asdvsdvvasdvv',
                'passport_number' => 'asdvsdvvasdvv', 'passport_issue_date' => '2025-08-14', 'passport_expiry_date' => '2025-08-31',
                'passport_issue_place' => 'savdasdvsdadsfv', 'primary_mobile' => 'Deserunt iste at pro',
                'secondary_mobile' => 'Deserunt iste at pro', 'email' => 'hatok@mailinator.com',
                'region' => 'Consectetur commodo', 'city' => 'Aute sit perferendi', 'district' => 'Non placeat quasi s',
                'street' => 'Dolores numquam dolo', 'building_number' => '126', 'postal_code' => 'Rem adipisicing cons',
                'pobox' => 'PO Box 80', 'job_title' => 'Dolor ipsam qui aliq', 'hire_date' => '1997-03-11',
                'contract_type' => 'temporary', 'basic_salary' => 89.00, 'allowances' => 45.00, 'gosi_number' => '685',
                'medical_insurance_number' => '683', 'saned_number' => '916', 'status' => 'active',
                'created_at' => '2025-08-30 09:01:18', 'updated_at' => '2025-08-30 09:01:18'
            ],
            [
                'id' => 3, 'company_id' => 4, 'full_name_ar' => 'Adria Cox', 'full_name_en' => 'Sydnee Rodgers',
                'type' => 'expat', 'nationality' => 'Sequi assumenda dolo', 'dob_hijri' => null, 'dob_greg' => '1982-07-13',
                'pob' => 'Iure odio qui obcaec', 'gender' => 'male', 'marital_status' => 'single', 'religion' => null,
                'education' => null, 'specialization' => null, 'national_id' => null, 'national_id_issue_date' => null,
                'national_id_expiry_date' => null, 'national_id_issue_place' => null, 'iqama_number' => '341',
                'iqama_issue_date' => '1998-06-07', 'iqama_expiry_date' => '2028-10-16', 'border_number' => '851',
                'passport_number' => '703', 'passport_issue_date' => '1997-09-16', 'passport_expiry_date' => '2026-06-29',
                'passport_issue_place' => 'Accusantium ut facer', 'primary_mobile' => '12341243',
                'secondary_mobile' => '123412341234', 'email' => 'tibi@mailinator.com',
                'region' => 'Quam id nesciunt en', 'city' => 'Dolor vel quaerat do', 'district' => 'Iure est aspernatur',
                'street' => 'Aperiam consectetur', 'building_number' => '527', 'postal_code' => 'Veritatis illum lau',
                'pobox' => 'P.O. Box 5263', 'job_title' => 'Rem aperiam ipsum es', 'hire_date' => '1977-03-14',
                'contract_type' => 'part_time', 'basic_salary' => 39.00, 'allowances' => 9.00, 'gosi_number' => '383',
                'medical_insurance_number' => '720', 'saned_number' => '807', 'status' => 'active',
                'created_at' => '2025-08-30 11:32:46', 'updated_at' => '2025-09-16 20:38:19'
            ],
            [
                'id' => 4, 'company_id' => 2, 'full_name_ar' => 'asdf', 'full_name_en' => 'asdf',
                'type' => 'saudi', 'nationality' => 'asdf', 'dob_hijri' => null, 'dob_greg' => '2025-09-17',
                'pob' => 'asdf', 'gender' => 'male', 'marital_status' => 'single', 'religion' => null,
                'education' => null, 'specialization' => null, 'national_id' => 'asdf', 'national_id_issue_date' => '2025-09-16',
                'national_id_expiry_date' => '2025-09-17', 'national_id_issue_place' => 'asdf', 'iqama_number' => null,
                'iqama_issue_date' => null, 'iqama_expiry_date' => null, 'border_number' => null, 'passport_number' => null,
                'passport_issue_date' => null, 'passport_expiry_date' => null, 'passport_issue_place' => null,
                'primary_mobile' => 'asdf', 'secondary_mobile' => null, 'email' => null,
                'region' => 'asdf', 'city' => 'asdf', 'district' => 'asdfd',
                'street' => 'asdf', 'building_number' => null, 'postal_code' => null,
                'pobox' => null, 'job_title' => 'sadf', 'hire_date' => '2025-09-17',
                'contract_type' => 'permanent', 'basic_salary' => 1234.00, 'allowances' => 0.00, 'gosi_number' => null,
                'medical_insurance_number' => null, 'saned_number' => null, 'status' => 'active',
                'created_at' => '2025-09-16 19:00:58', 'updated_at' => '2025-09-16 19:00:58'
            ],
        ];

        foreach ($employees as $employee) {
            DB::table('employees')->updateOrInsert(
                ['id' => $employee['id']],
                $employee
            );
        }
    }

    private function seedCivilDefenseLicenses()
    {
        $licenses = [
            [
                'id' => 1, 'company_id' => 2, 'license_number' => '546', 'issue_date' => '2021-07-04', 'expiry_date' => '2022-03-11',
                'authority' => 'Aliquip laudantium', 'activity_classification' => 'Pariatur Dolor dolo', 'total_area' => 30.00,
                'floors' => 20, 'facility_type' => 'other', 'safety_status' => 'compliant', 'inspection_status' => 'pending',
                'last_inspection_date' => '2000-03-16', 'next_inspection_date' => '2000-12-14', 'notes' => 'Velit consequatur d',
                'certificate_file_path' => null, 'status' => 'active', 'enable_reminder' => 1, 'reminder_days' => 30,
                'created_at' => '2025-08-30 02:20:48', 'updated_at' => '2025-09-16 22:00:03'
            ],
            [
                'id' => 2, 'company_id' => 3, 'license_number' => '435', 'issue_date' => '1972-04-27', 'expiry_date' => '2017-06-01',
                'authority' => 'Est commodi consequa', 'activity_classification' => 'Nihil voluptas adipi', 'total_area' => 66.00,
                'floors' => 71, 'facility_type' => 'residential', 'safety_status' => 'compliant', 'inspection_status' => 'failed',
                'last_inspection_date' => '1985-09-22', 'next_inspection_date' => '2022-01-14', 'notes' => 'Asperiores ipsam lab',
                'certificate_file_path' => null, 'status' => 'active', 'enable_reminder' => 1, 'reminder_days' => 22,
                'created_at' => '2025-08-30 08:58:49', 'updated_at' => '2025-09-16 21:58:51'
            ],
            [
                'id' => 3, 'company_id' => 4, 'license_number' => '123412', 'issue_date' => '1973-09-26', 'expiry_date' => '1981-01-21',
                'authority' => 'Exercitation quo nob', 'activity_classification' => 'Omnis fugit lorem o', 'total_area' => 58.00,
                'floors' => 25, 'facility_type' => 'office', 'safety_status' => 'non_compliant', 'inspection_status' => 'passed',
                'last_inspection_date' => '2017-11-19', 'next_inspection_date' => '2018-06-13', 'notes' => 'Ipsum non sequi id',
                'certificate_file_path' => null, 'status' => 'active', 'enable_reminder' => 1, 'reminder_days' => 15,
                'created_at' => '2025-08-30 11:29:27', 'updated_at' => '2025-09-16 21:57:14'
            ],
            [
                'id' => 4, 'company_id' => 7, 'license_number' => '347', 'issue_date' => '2013-01-11', 'expiry_date' => '2014-06-18',
                'authority' => 'Ut aute iusto ration', 'activity_classification' => 'Aut officia quisquam', 'total_area' => 19.00,
                'floors' => 58, 'facility_type' => 'restaurant', 'safety_status' => 'non_compliant', 'inspection_status' => 'failed',
                'last_inspection_date' => '2008-03-11', 'next_inspection_date' => '2013-11-07', 'notes' => 'Rem voluptatem nisi',
                'certificate_file_path' => null, 'status' => 'active', 'enable_reminder' => 1, 'reminder_days' => 18,
                'created_at' => '2025-09-12 20:40:45', 'updated_at' => '2025-09-16 21:58:24'
            ],
            [
                'id' => 5, 'company_id' => 4, 'license_number' => '45', 'issue_date' => '2009-03-12', 'expiry_date' => '2010-07-14',
                'authority' => 'Totam aut dolor offi', 'activity_classification' => 'Dicta tempora impedi', 'total_area' => 23.00,
                'floors' => 94, 'facility_type' => 'office', 'safety_status' => 'under_review', 'inspection_status' => 'pending',
                'last_inspection_date' => '1990-09-26', 'next_inspection_date' => '2017-06-06', 'notes' => 'Quidem ex voluptatem',
                'certificate_file_path' => null, 'status' => 'active', 'enable_reminder' => 1, 'reminder_days' => 25,
                'created_at' => '2025-09-12 21:06:18', 'updated_at' => '2025-09-16 21:57:31'
            ],
        ];

        foreach ($licenses as $license) {
            DB::table('civil_defense_licenses')->updateOrInsert(
                ['id' => $license['id']],
                $license
            );
        }
    }

    private function seedMunicipalityLicenses()
    {
        $licenses = [
            [
                'id' => 1, 'company_id' => 2, 'license_number' => '445', 'municipality_name' => 'Shay Suarez',
                'license_type' => 'industrial', 'activity_desc' => 'Doloribus qui aut ni', 'location_code' => 'Vel ullamco ratione',
                'area' => 30.00, 'zone_classification' => 'Aspernatur vel optio', 'building_permit_number' => '677',
                'land_use_type' => 'health', 'issue_date' => '1990-10-10', 'expiry_date' => '2004-02-04',
                'conditions' => 'Voluptas ea libero f', 'license_fees' => 41.00, 'notes' => 'Sit eos voluptatem',
                'certificate_file_path' => 'company_documents/2/municipality/1756499686_municipality_laravel.jpg',
                'status' => 'active', 'enable_reminder' => 1, 'reminder_days' => 30,
                'created_at' => '2025-08-29 17:33:53', 'updated_at' => '2025-09-16 22:00:20'
            ],
        ];

        foreach ($licenses as $license) {
            DB::table('municipality_licenses')->updateOrInsert(
                ['id' => $license['id']],
                $license
            );
        }
    }

    private function seedBranchCommercialRegistrations()
    {
        $registrations = [
            [
                'id' => 1, 'company_id' => 2, 'branch_reg_number' => '962', 'parent_cr_number' => '928',
                'branch_type' => 'regional_office', 'authorized_capital' => 30.00, 'manager_name' => 'Kyra Cote',
                'manager_id_number' => '358', 'manager_nationality' => 'Id et omnis unde con', 'manager_position' => 'Autem facilis dolore',
                'branch_activity' => 'Magna rerum ipsam fu', 'registration_date' => '1976-11-23', 'legal_form' => 'LLC',
                'issuing_authority' => 'Consequat Culpa id', 'issue_date' => '1973-11-01', 'expiry_date' => '1994-07-02',
                'activities_list' => 'Officia hic elit et', 'notes' => 'Dolor veniam at lab', 'certificate_file_path' => null,
                'status' => 'active', 'enable_reminder' => 1, 'reminder_days' => 30,
                'created_at' => '2025-08-30 02:38:09', 'updated_at' => '2025-09-16 22:00:29'
            ],
            [
                'id' => 2, 'company_id' => 4, 'branch_reg_number' => '770', 'parent_cr_number' => '41',
                'branch_type' => 'regional_office', 'authorized_capital' => 54.00, 'manager_name' => 'Lana Peck',
                'manager_id_number' => '227', 'manager_nationality' => 'Eaque ut in architec', 'manager_position' => 'Quo id quia optio a',
                'branch_activity' => 'Culpa impedit reru', 'registration_date' => '1995-10-23', 'legal_form' => 'LLC',
                'issuing_authority' => 'Aut proident exerci', 'issue_date' => '1988-11-02', 'expiry_date' => '2029-10-30',
                'activities_list' => 'Eu consequatur do d', 'notes' => 'Quis ut amet offici',
                'certificate_file_path' => 'company_documents/4/branch_registration/1756565403_branch_reg_laravel.jpg',
                'status' => 'active', 'enable_reminder' => 1, 'reminder_days' => 12,
                'created_at' => '2025-08-30 11:50:03', 'updated_at' => '2025-09-16 21:56:28'
            ],
        ];

        foreach ($registrations as $registration) {
            DB::table('branch_commercial_registrations')->updateOrInsert(
                ['id' => $registration['id']],
                $registration
            );
        }
    }
}
